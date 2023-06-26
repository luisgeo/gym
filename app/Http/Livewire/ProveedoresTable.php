<?php

namespace App\Http\Livewire;

use App\Models\Notificacion;
use App\Models\Proveedor;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProveedoresTable extends Component
{
    use WithPagination;

    public Proveedor $proveedor;
    public $buscar;

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $proveedores = Proveedor::where('nombre', 'like', $like)
            ->orWhere('ubicacion', 'like', $like)
            ->orWhere('telefono', 'like', $like)
            ->paginate(50);
        return view('livewire.proveedores-table', [
            'proveedores' => $proveedores
        ]);
    }

    public function quitar($id)
    {
        $proveedor = Proveedor::find($id);
        if ($proveedor->estatus == -1) {
            session()->flash('message', 'El proveedor ya está dado de baja.');
        } else {
            $now = CarbonImmutable::now();
            $notificacion = new Notificacion();
            $notificacion->id_usuario = Auth::id();
            $notificacion->accion = __('messages.pings.proveedores.baja_proveedor', [
                'id'  => $proveedor->id_proveedor
            ]);
            $notificacion->tipo_alerta = 'alerta';
            $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
            $notificacion->save();


            Proveedor::where('id_proveedor', '=', $id)->update([
                'estatus' => '-1'
            ]);
            session()->flash('message', 'Se ha dado de baja al proveedor.');
        }
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
