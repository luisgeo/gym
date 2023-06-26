<?php

namespace App\Http\Livewire;

use App\Models\Notificacion;
use Livewire\Component;
use Livewire\WithPagination;

class NotificacionesTable extends Component
{
    use WithPagination;
    
    public $buscar;

    public function render()
    {
        $like = mb_strtolower('%' . $this->buscar . '%');
        $notificaciones = Notificacion::join('users', 'users.id', 'notificaciones.id_usuario')
            ->orWhere('users.name', 'like', $like)
            ->orWhere('users.phone', 'like', $like)
            ->orWhere('accion', 'like', $like)
            ->orderBy('fecha_registro', 'desc')
            ->paginate(50);

        return view('livewire.notificaciones-table', [
            'notificaciones' => $notificaciones
        ]);
    }
}
