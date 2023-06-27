<?php

namespace App\Http\Livewire;

use App\Models\Antecedente;
use App\Models\Cliente;
use App\Models\Notificacion;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CarteraClientesEdit extends Component
{
    public Cliente $cliente;
    public Antecedente $antecedente;
    public $created;

    public $rules = [
        'cliente.nombre' => 'required',
        'cliente.telefono' => 'required|numeric',
        'cliente.correo' => 'nullable',
        'cliente.estatus' => 'required',

        'antecedente.alergico' => 'required|numeric',
        'antecedente.alergico_expl' => 'nullable',
        'antecedente.lesion' => 'required|numeric',
        'antecedente.lesion_expl' => 'nullable',
        'antecedente.cardiovascular' => 'required|numeric',
        'antecedente.cardiovascular_expl' => 'nullable',
        'antecedente.desmayo' => 'required|numeric',
        'antecedente.desmayo_expl' => 'nullable',
        'antecedente.anemia' => 'required|numeric',
        'antecedente.anemia_expl' => 'nullable',
        'antecedente.pie_plano' => 'required|numeric',
        'antecedente.pie_plano_expl' => 'nullable',
    ];

    public $messages = [
        'cliente.nombre.required' => 'Se requiere un nombre del cliente.',
        'cliente.telefono.required' => 'Se requiere un teléfono.',
        'cliente.telefono.numeric' => 'Ingresa un número teléfono.',
        'cliente.correo.required' => 'Se requiere un correo.',
        'cliente.estatus.required' => 'Se requiere un correo.',

        'antecedente.alergico.required' => 'Se requiere seleccionar una opción.',
        'antecedente.alergico.numeric' => 'Se requiere seleccionar una opción.',
        'antecedente.lesion.required' => 'Se requiere seleccionar una opción.',
        'antecedente.lesion.numeric' => 'Se requiere seleccionar una opción.',
        'antecedente.cardiovascular.required' => 'Se requiere seleccionar una opción.',
        'antecedente.cardiovascular.numeric' => 'Se requiere seleccionar una opción.',
        'antecedente.desmayo.required' => 'Se requiere seleccionar una opción.',
        'antecedente.desmayo.numeric' => 'Se requiere seleccionar una opción.',
        'antecedente.anemia.required' => 'Se requiere seleccionar una opción.',
        'antecedente.anemia.numeric' => 'Se requiere seleccionar una opción.',
        'antecedente.pie_plano.required' => 'Se requiere seleccionar una opción.',
        'antecedente.pie_plano.numeric' => 'Se requiere seleccionar una opción.',
    ];

    public function mount($id = null)
    {
        if ($id == null) {
            $this->cliente = new Cliente();

            $this->created = true;
        } else {
            $this->cliente = Cliente::findOrFail($id);
            $this->created = false;
        }
    }

    public function render()
    {
        return view('livewire.cartera-clientes-edit', [
            'cliente' => $this->cliente
        ]);
    }
    public function save()
    {
        $this->validate();
        $now = CarbonImmutable::now();
        $this->cliente->acumulado = $this->cliente->acumulado ?? 0.00;

        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.clientes.' . ($this->created ? 'crear_cliente' : 'editar_cliente'), [
            'id'  => $this->cliente->id_cliente,
            'nombre' => $this->cliente->nombre,
            'telefono' => $this->cliente->telefono,
            'correo' => $this->cliente->correo ?? 'N/A',
            'acumulado' => $this->cliente->acumulado ?? 0.00,
            'estatus' => $this->cliente->estatus
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $this->cliente->save();
        $this->antecedente->save();

        session()->flash('message', 'Se ha guardado un cliente');
        return redirect('/clientes');
    }
}
