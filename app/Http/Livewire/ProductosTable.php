<?php

namespace App\Http\Livewire;

use App\Models\Notificacion;
use App\Models\Producto;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosTable extends Component
{
    use WithPagination;

    public Producto $producto;
    public $carrito;
    public $buscar;
    public $cantidad;

    public $showNewClientModal;
    public $scan;

    public function mount()
    {
        $this->cantidad = 0;
        $this->showNewClientModal = false;
        $this->scan = false;
    }

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $cant = $this->cantidad;
        $productos = Producto::select(
            'productos.id_producto as id_producto',
            'productos.nombre as nombre',
            'productos.stock as stock',
            DB::raw("SUM(reparto.stock) as stock_suma"),
            'precio',
            'precio_unitario',
            'descuento',
            'descripcion',
            'estatus',
            'almacenes.nombre as nombre_almacen',
            'imagen'
        )
            ->join('almacenes', 'almacenes.id_almacen', '=', 'productos.id_almacen')
            ->join('reparto', 'reparto.id_producto', '=', 'productos.id_producto')
            // ->orWhere('id_marca', 'like', $like)
            ->where(function ($query) use ($like) {
                $query->where('productos.nombre', 'like', $like)
                    ->orWhere('descripcion', 'like', $like)
                    ->orWhere('codigo', 'like', $like)
                    ->orWhere('modelo', 'like', $like)
                    ->orWhere('almacenes.nombre', 'like', $like)
                    ->orWhere('almacenes.ubicacion', 'like', $like);
            })
            // ->where(function ($query) use ($cant) {
            //     if ($cant == 0) {
            //         $query->where('productos.stock', '>=', 0);
            //     } else if ($cant == 5) {
            //         $query->where('productos.stock', '<=', 5);
            //     } else if ($cant == 20) {
            //         $query->where('productos.stock', '<=', 20);
            //     }
            // })
            ->where('estatus', '!=', 0)
            ->distinct()
            ->groupBy([
                'reparto.id_producto', 'productos.id_producto', 'productos.nombre',
                'productos.stock', 'productos.precio', 
                'precio_unitario', 
                'descuento', 'descripcion',
                'estatus', 'almacenes.nombre', 'imagen'
            ])
            ->orderBy('productos.nombre', 'asc');

        $suma = 0;

        foreach ($productos->get() as $prod) {
            $suma += ($prod->stock + $prod->stock_suma) * $prod->precio;
        }

        return view('livewire.productos-table', [
            'productos' => $productos->paginate(50),
            'suma_total' => $suma
        ]);
    }

    public function eliminar($id)
    {
        // $datos = $this->validate();
        $producto = Producto::where('id_producto', '=', $id)->first();
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.productos.baja_producto', [
            'id'  => $producto->id_producto
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $producto->estatus = 0;
        $producto->save();
        session()->flash('message', 'El producto ha sido eliminado.');
    }


    public function cerrarAlerta()
    {
        session()->forget('message');
    }

    public function mostrarMenosDe5()
    {
        $this->cantidad = 5;
    }

    public function mostrarMenosDe20()
    {
        $this->cantidad = 20;
    }

    public function mostrarNormal()
    {
        $this->cantidad = 0;
    }

    public function activateScan()
    {
        $this->buscar = "";
        $this->scan = true;
    }

    public function openNewClientModal()
    {
        $this->showNewClientModal = true;
        $this->scan = true;
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

    public function clearSearch()
    {
        $this->scan = false;
        $this->buscar = "";
    }
}
