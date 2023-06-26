<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Marca;
use App\Models\Notificacion;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Reparto;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductosEdit extends Component
{
    use WithFileUploads;

    public Producto $producto;
    public $proveedores;
    public $almacenes;
    public $marcas;
    public $created;
    public $imagen;

    public $scan;
    public $showNewClientModal;
    public $counter;

    public $listeners = [
        'setProductoCodigo'
    ];

    public $rules = [
        'producto.nombre' => 'required',
        'producto.id_marca' => 'required',
        'producto.modelo' => 'required',
        'producto.precio' => 'required|numeric|gt:0',
        'producto.precio_unitario' => 'required|numeric|gt:0',
        'producto.precio_medio_mayoreo' => 'required|numeric|gt:0',
        'producto.precio_mayoreo' => 'required|numeric|gt:0',
        'producto.precio_super_mayoreo' => 'required|numeric|gt:0',
        'producto.stock' => 'required|numeric|gt:0',
        'producto.descuento' => 'required|numeric',
        'producto.comision' => 'required|numeric',
        'producto.codigo' => 'required',
        'producto.descripcion' => 'required',
        'producto.id_proveedor' => 'required|numeric',
        'imagen' => 'nullable|file|image',

    ];

    public $messages = [
        'producto.nombre.required' => 'Se requiere un nombre.',
        'producto.marca.required' => 'Se requiere una marca.',
        'producto.modelo.required' => 'Se requiere un modelo.',
        'producto.precio.required' => 'Se requiere un precio.',
        'producto.precio.numeric' => 'Precio es un número.',
        'producto.precio.gt' => 'El precio debe ser mayor a 0.',
        'producto.precio_unitario.required' => 'Se requiere un porcentaje para precio unitario.',
        'producto.precio_unitario.numeric' => 'Precio unitario es un número.',
        'producto.precio_unitario.gt' => 'El precio debe ser mayor a 0.',
        'producto.precio_medio_mayoreo.required' => 'Se requiere un porcentaje para precio de medio mayoreo.',
        'producto.precio_medio_mayoreo.numeric' => 'Precio es un número.',
        'producto.precio_medio_mayoreo.gt' => 'El precio debe ser mayor a 0.',
        'producto.precio_mayoreo.required' => 'Se requiere un porcentaje para precio de mayoreo',
        'producto.precio_mayoreo.numeric' => 'Precio es un número.',
        'producto.precio_mayoreo.gt' => 'El precio debe ser mayor a 0.',
        'producto.precio_super_mayoreo.required' => 'Se requiere un porcentaje para precio de súper mayoreo',
        'producto.precio_super_mayoreo.numeric' => 'Precio es un número.',
        'producto.precio_super_mayoreo.gt' => 'El precio debe ser mayor a 0.',
        'producto.descuento.required' => 'Se requiere un descuento, aunque sea 0.',
        'producto.descuento.numeric' => 'Descuento es un número.',
        'producto.comision.required' => 'Se requiere una comisión',
        'producto.comision.numeric' => 'Comisión es un número.',
        'producto.codigo.required' => 'Se requiere un código de producto.',
        'producto.stock.required' => 'Se require stock.',
        'producto.stock.numeric' => 'Stock es un número.',
        'producto.stock.gt' => 'El stock debe ser mayor a 0.',
        'producto.descripcion.required' => 'Se requiere una descripción del producto.',
        'producto.id_proveedor.required' => 'Se requiere un proveedor del producto.',
        'producto.id_proveedor.numeric' => 'Seleccione un proveedor.',
        'imagen.file' => 'Se requiere una imagen.',
        'imagen.image' => 'Se require una imagen.',
    ];

    public function mount($id = null)
    {
        if (is_null($id)) {
            $this->producto = new Producto();
            $this->created = true;
        } else {
            $this->producto = Producto::findOrFail($id);
            $this->created = false;
        }
        $this->scan = false;
        $this->showNewClientModal = false;
        $this->marcas = Marca::where('estatus', '!=', -1)->get();
        $this->proveedores = Proveedor::where('estatus', '!=', -1)->get();
        $this->almacenes = Almacen::where('activo', '!=', 0)->get();

        if (!is_null($this->producto->imagen)) {
            $this->counter = substr($this->producto->imagen, strpos($this->producto->imagen, '_',  strpos($this->producto->imagen, '_') + 1) + 1);
            $this->counter = intval(substr($this->counter, 0,  strpos($this->counter, '.')));
            $this->counter += 1;
        } else {
            $this->counter = 0;
        }
    }

    public function render()
    {
        return view('livewire.productos-edit', [
            'producto' => $this->producto,
            'marcas' => $this->marcas
        ]);
    }

    public function save()
    {
        $datos = $this->validate();
        $now = CarbonImmutable::now();

        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.productos.' . ($this->created ? 'crear_producto' : 'editar_producto'), [
            'id'  => $this->producto->id_producto,
            'nombre' => $this->producto->nombre
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $this->producto->estatus = $this->producto->estatus ?? 1;
        $this->producto->id_almacen = Almacen::where('activo', '!=', 0)
            ->first()
            ->id_almacen;
        $this->producto->save();

        if (!$this->created) {
            session()->flash('message', 'El producto ha sido guardado.');
            return redirect('/producto');
        }

        $alms = Almacen::where('activo', '!=', 0)->get();
        $repartos = [];

        foreach ($alms as $almacen) {
            $repartos[] = [
                'id_producto' => $this->producto->id_producto,
                'id_almacen' => $almacen->id_almacen,
                'stock' => 0
            ];
        }

        Reparto::insert($repartos);

        if (!is_null($this->imagen)) {
            if (Storage::disk('public')->exists($this->producto->imagen))
                Storage::delete("{$this->producto->imagen}.jpeg");

            $this->producto->imagen = $this->imagen->storeAs('imagenes_producto', "{$this->producto->id_producto}_{$this->counter}.jpeg");
        }

        $this->producto->save();

        session()->flash('message', 'El producto ha sido guardado.');
        return redirect('/producto');
    }

    public function activateScan()
    {
        $this->scan = true;
    }

    public function setProductoCodigo($val)
    {
        $this->producto->codigo = $val;
    }

    public function openNewClientModal()
    {
        $this->showNewClientModal = true;
    }
    public function closeNewClientModal()
    {
        $this->showNewClientModal = false;
        $this->scan = false;
    }

    public function closeScanQr()
    {
        $this->showNewClientModal = false;
        $this->scan = false;
    }
}
