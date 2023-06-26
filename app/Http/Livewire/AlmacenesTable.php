<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Notificacion;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AlmacenesTable extends Component
{
    public $buscar;

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $almacenes = Almacen::join('users', 'users.id', '=', 'almacenes.id_administrador')
            ->where('nombre', 'like', $like)
            ->orWhere('ubicacion', 'like', $like)
            ->orWhere('users.name', 'like', $like)
            ->paginate(50);
        return view('livewire.almacenes-table', [
            'almacenes' => $almacenes
        ]);
    }

    public function quitar($id)
    {
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.almacenes.baja_almacen', [
            'id'  => $id,
            'nombre' => Almacen::where('id_almacen', '=', $id)->first()->nombre
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();
        
        Almacen::where('id_almacen', '=', $id)->update([
            'activo' => 0
        ]);
        session()->flash('message', 'Se ha suspendido el almacén');
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
