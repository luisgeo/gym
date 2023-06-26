<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Notificacion;
use App\Models\Producto;
use App\Models\Reparto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AlmacenesEdit extends Component
{

    public Almacen $almacen;
    public $administradores;
    public $created;

    public $rules = [
        'almacen.nombre' => 'required',
        'almacen.ubicacion' => 'required',
        'almacen.capacidad' => 'required|integer',
        'almacen.id_administrador' => 'required|numeric',
        'almacen.activo' => 'required|boolean'
    ];

    public $messages = [
        'almacen.nombre.required' => 'Se requiere un nombre',
        'almacen.ubicacion.required' => 'Se requiere una ubicación',
        'almacen.capacidad.required' => 'Se requiere una capacidad',
        'almacen.capacidad.integer' => 'Capacidad es un número entero',
        'almacen.id_administrador.required' => 'Se requiere un usuario administrador',
        'almacen.id_administrador.numeric' => 'Seleccione un usuario administrador',
        'almacen.activo.required' => 'Se requiere saber si el almacén está activo o no',
        'almacen.activo.boolean' => 'Seleccione un estatus'
    ];

    public function mount($id = null)
    {
        if (is_null($id)) {
            $this->almacen = new Almacen();
            $this->created = true;
        } else {
            $this->almacen = Almacen::findOrFail($id);
            $this->created = false;
        }
        $this->administradores = User::where('rol', '=', '2')->get();
    }

    public function render()
    {
        return view('livewire.almacenes-edit');
    }


    public function save()
    {
        $this->validate();

        $now = Carbon::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.almacenes.' . ($this->created ? 'crear_almacen' : 'editar_almacen'), [
            'id'  => $this->almacen->id_almacen,
            'nombre' => $this->almacen->nombre
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $this->almacen->save();

        if (!$this->created) return redirect('/almacen');

        $prods = Producto::all('id_producto')->toArray();
        // $alms = Almacen::all('id_almacen')->toArray();
        $alms = [
            0 => [
                'id_almacen' => $this->almacen->id_almacen
            ]
        ];

        $inserts = [];

        $inserts = Arr::crossJoin($prods, $alms);

        foreach ($inserts as $row => $rowVal) {

            $inserts[$row] = array_merge($rowVal[0], $rowVal[1]);
            $inserts[$row]['stock'] = 0;
        }

        Reparto::insert($inserts);

        // session()->flash('message', 'El almacén ha sido guardado.');
        return redirect('/almacen');
    }
}
