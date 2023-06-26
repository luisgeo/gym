<?php

namespace App\Http\Livewire;

use App\Models\Notificacion;
use App\Models\Proveedor;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProveedoresEdit extends Component
{

    public Proveedor $proveedor;
    public $created;
    
    public $rules = [
        'proveedor.nombre' => 'required',
        'proveedor.ubicacion' => 'required',
        'proveedor.estatus' => 'required|numeric',
        'proveedor.telefono' => 'required|digits:10'
    ];

    public $messages = [
        'proveedor.nombre.required' => 'Se requiere un nombre de proveedor.',
        'proveedor.ubicacion.required' => 'Se requiere una ubicación.',
        'proveedor.estatus.required' => 'Se requiere un estatus.' ,
        'proveedor.estatus.numeric' => 'Seleccione un estatus.',
        'proveedor.telefono.required' => 'Se requiere un número telefónico.',
        'proveedor.telefono.digits' => 'Debe contener 10 cifras.'
    ];

    public function mount($id = null){
        if($id == null){
            $this->proveedor = new Proveedor();
            $this->created = true;
        } else {
            $this->proveedor = Proveedor::findOrFail($id);
            $this->created->false;
        }
    }

    public function render()
    {
        return view('livewire.proveedores-edit', [
            'proveedor'=> $this->proveedor
        ]);
    }

    public function save(){
        $this->validate();
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.proveedores.' . ($this->created ? 'crear_proveedor' : 'editar_proveedor'), [
            'id'  => $this->proveedor->id_proveedor
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();
        

        $this->proveedor->save();
        session()->flash('message', 'Se ha guardado el proveedor');
        return redirect('/proveedor');
    }
    
}
