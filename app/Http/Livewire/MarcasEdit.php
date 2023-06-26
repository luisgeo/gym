<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Notificacion;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MarcasEdit extends Component
{
    public Marca $marca;
    public $created;

    public $rules = [
        'marca.nombre' => 'required',
        'marca.estatus' => 'required|numeric'
    ];

    public $messages = [
        'marca.nombre.required' => 'Se requiere un nombre de la marca.',
        'marca.estatus.required' => 'Se requiere un estatus.',
        'marca.estatus.numeric' => 'Seleccione un estatus.',
    ];

    public function mount($id = null)
    {
        if ($id == null) {
            $this->marca = new Marca();
            $this->created = true;
        } else {
            $this->marca = Marca::findOrFail($id);
            $this->created = false;
        }
    }

    public function render()
    {
        return view('livewire.marcas-edit', [
            'marca' => $this->marca
        ]);
    }
    public function save()
    {
        $this->validate();
        
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.marcas.' . ($this->created ? 'crear_marca' : 'editar_marca'), [
            'id'  => $this->marca->id_marca,
            'nombre' => $this->marca->nombre,
        ]);
        $notificacion->tipo_alerta = 'info';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $this->marca->save();
        session()->flash('message', 'Se ha guardado la marca');
        return redirect('/marca');
    }
}
