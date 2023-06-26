<?php

namespace App\Http\Livewire;

use App\Models\Notificacion;
use App\Models\User;
use App\Models\Usuario;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosTable extends Component
{
    use WithPagination;

    public $buscar;
    public string $comparacion;
    public $openedModal;
    private $usuarios;

    public $refreshing;

    public function refr()
    {
        $this->refreshing = true;
    }

    public function notRefreshing()
    {
        $this->refreshing = false;
    }


    // protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->comparacion = "!=";
        $this->openedModal = false;
        $this->refreshing = false;
    }

    public function render()
    {
        $like = mb_strtolower('%' . $this->buscar . '%');

        $this->usuarios = User::where('estado_usuario', $this->comparacion, 2)
            ->where('name', '!=', 'Desconocido')
            ->where(function ($query) use ($like) {
                $query->where('phone', 'like', $like)
                    ->orWhere('name', 'like', $like);
            })
            ->paginate(50);

        return view('livewire.usuarios-table', [
            'usuarios' => $this->usuarios,
            'comparacion' => $this->comparacion,
            'openedModal' => $this->openedModal
        ]);
    }

    public function eliminar($id)
    {
        $usuario = User::where('id', '=', $id)->first();

        if ($usuario->estado_usuario == 2) {
            session()->flash('message', 'El usuario ya está dado de baja.');
        } else {
            $now = CarbonImmutable::now();
            $notificacion = new Notificacion();
            $notificacion->id_usuario = Auth::id();
            $notificacion->accion = __('messages.pings.usuarios.baja_usuario', [
                'id'  => $usuario->id,
                'nombre' => $usuario->name,
                'telefono' => $usuario->phone,
                'rol' => $usuario->rol,
            ]);

            $notificacion->tipo_alerta = 'alerta';
            $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");

            $notificacion->save();

            DB::table('users')->where('id', '=', $id)->update([
                'estado_usuario' => '2',
                'old_phone' => $usuario->phone,
                'phone' => null
            ]);

            session()->flash('message', 'El usuario ha sido dado de baja.');
        }
    }

    public function mostrarEliminados()
    {
        $this->comparacion = "=";
    }

    public function mostrarActivos()
    {
        $this->comparacion = "!=";
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }

    public function showModal()
    {
        $this->openedModal = true;
    }
}
