<?php

namespace App\Http\Livewire;

use App\Models\Queja;
use Livewire\Component;
use Livewire\WithPagination;

class QuejasTable extends Component
{
    use WithPagination;
    
    public $buscar;

    public function render()
    {
        $like = '%'.$this->buscar.'%';

        $quejas = Queja::join('usuarios', 'usuarios.id_usuario', '=', 'quejas.id_usuario')
        ->join('users', 'users.id', '=', 'usuarios.id_user')
        ->where('users.name', 'ilike', $like)
        ->paginate(50);
        return view('livewire.quejas-table', [
            'quejas' => $quejas
        ]);
    }

    public function cambiar($id){
        $queja = Queja::find($id);
        Queja::where('id_queja', '=', $id)->update([
            'estatus' => $queja->estatus == 2? '0' : $queja->estatus
        ]);
        session()->flash('message', 'La queja ha cambiado de estatus.');
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
