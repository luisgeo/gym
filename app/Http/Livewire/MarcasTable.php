<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Notificacion;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MarcasTable extends Component
{
    use WithPagination;

    public Marca $marca;
    public $buscar;

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $marcas = Marca::where('nombre', 'like', $like)
            ->paginate(50);
        return view('livewire.marcas-table', [
            'marcas' => $marcas
        ]);
    }

    public function quitar($id)
    {
        $marca = Marca::find($id);
        if ($marca->estatus == -1) {
            session()->flash('message', 'La marca ya está dada de baja.');
        } else {
            $now = CarbonImmutable::now();
            $notificacion = new Notificacion();
            $notificacion->id_usuario = Auth::id();
            $notificacion->accion = __('messages.pings.marcas.baja_marca', [
                'id'  => $marca->id_marca,
                'nombre' => $marca->nombre,
            ]);
            $notificacion->tipo_alerta = 'alerta';
            $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
            $notificacion->save();

            Marca::where('id_marca', '=', $id)->update([
                'estatus' => '-1'
            ]);
            session()->flash('message', 'Se ha dado de baja la marca.');
        }
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
