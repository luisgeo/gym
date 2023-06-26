<?php

namespace App\Http\Livewire;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CompletarRegistro extends Component
{
    public $id_usuario;
    public $usuario;

    public $rules = [
        'usuario.cp' => 'required|digits:5',
        'usuario.telefono' => 'required|digits:10'
    ];

    public $messages = [
        'usuario.cp.required' => 'Este campo no puede estar vacío.',
        'usuario.cp.digits' => 'Este campo debe tener 5 cifras.',
        'usuario.telefono.required' => 'Este campo no puede estar vacío.',
        'usuario.telefono.digits' => 'Este campo debe tener 10 cifras.'
    ];

    public function mount()
    {
        $this->usuario = new Usuario();
    }

    public function render()
    {
        $this->id_usuario = Usuario::select('id_usuario')
            ->where('id_user', '=', Auth::id())
            ->get();

        $completo = Usuario::where('id_user', '=', Auth::id())->count();

        return view('livewire.completar-registro', [
            'id_user' => Auth::id(),
            'usuario' => $this->usuario,
            'completado' => $completo == 1
        ]);
    }

    public function save()
    {
        $this->validate();
        $count = count(Usuario::where('id_user', '=', Auth::id())->get());
        if ($count == 0) {
            DB::table('usuarios')
                ->insert([
                    'cp' => $this->usuario->cp,
                    'telefono' => $this->usuario->telefono,
                    'rol' => '1',
                    'membresia' => 'false',
                    'strikes' => '0',
                    'id_user' => Auth::id()
                ]);
        }
        return redirect('/dashboard');
    }
}
