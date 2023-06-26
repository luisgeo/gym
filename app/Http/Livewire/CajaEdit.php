<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Caja;
use App\Models\Notificacion;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CajaEdit extends Component
{
    public $idusuario;
    public $caja;
    public $almacenes;

    public function rules()
    {
        return [
            'caja.id_almacen'           => 'required|integer',
            'caja.abierta'              => 'required|integer'
        ];
    }

    public function messages()
    {
        return __('messages.caja_edit');
    }

    public function mount($id = null)
    {
        $this->idusuario = $id;
        if ($id == null) {
            $this->caja = new Caja();
        } else {
            $this->caja = Caja::where('id_usuario', '=', $id)->first() ?? new Caja();
            if ($this->caja == null) {
                abort(404);
            }

        }
        $this->almacenes = Almacen::all();
        
    }

    public function render()
    {
        return view('livewire.caja-edit', [
            'caja' => $this->caja
        ]);
    }

    public function save()
    {
        $this->validate();
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.cajas.editar_caja', [
            'id'  => $this->caja->id_caja,
            'almacen' => $this->caja->almacen->nombre,
            'abierta' => ($this->caja->abierta ? 'Sí' : 'No')
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $this->caja->id_usuario = $this->idusuario;
        $this->caja->save();

        session()->flash('message', 'Se han guardado los datos de la caja');
        return redirect('/usuarios');
    }
}
