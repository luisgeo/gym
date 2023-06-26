<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Notificacion;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CarteraClientesTable extends Component
{
    use WithPagination;

    public Cliente $cliente;
    public $buscar;

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $clientes = Cliente::where('nombre', 'like', $like)
            ->paginate(50);
        return view('livewire.cartera-clientes-table', [
            'clientes' => $clientes
        ]);
    }

    public function quitar($id)
    {
        $clientes = Cliente::find($id);
        if ($clientes->estatus == -1) {
            session()->flash('message', 'El cliente esta dado de baja.');
        } else {
            $cliente = Cliente::where('id_cliente', '=', $id)->update([
                'estatus' => '-1'
            ]);
            $now = CarbonImmutable::now();
            $notificacion = new Notificacion();
            $notificacion->id_usuario = Auth::id();
            $notificacion->accion = __('messages.pings.clientes.baja_cliente', [
                'id'  => $cliente->id_cliente,
                'nombre' => $cliente->nombre,
                'telefono' => $cliente->telefono,
                'correo' => $cliente->correo ?? 'N/A',
                'acumulado' => $cliente->acumulado,
                'estatus' => $cliente->estatus
            ]);
            $notificacion->tipo_alerta = 'alerta';
            $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
            $notificacion->save();

            session()->flash('message', 'Se ha dado de baja al cliente.');
        }
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
