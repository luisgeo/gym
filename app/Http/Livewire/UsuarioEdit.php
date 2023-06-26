<?php

namespace App\Http\Livewire;

use App\Models\Notificacion;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UsuarioEdit extends Component
{
    public User $user;
    public $old_phone;
    public bool $cambiarTelefono;

    public function rules()
    {
        return [
            'user.name' => 'required|string|max:200',
            'user.phone' => ['required', 'integer', 'digits:10', Rule::unique('users', 'phone')->ignore($this->user->id)],
            'user.rol' => 'required|integer',
        ];
    }

    public function messages()
    {
        return __('messages.usuario_edit');
    }

    public function mount($id = null)
    {
        if (is_null($id)) {
            return abort(403);
        } else {
            $this->user = User::findOrFail($id);
        }

        $this->cambiarTelefono = false;
    }

    public function render()
    {
        return view('livewire.usuario-edit', [
            'usuario' => $this->user
        ]);
    }

    public function cambiarTelefonoUsuario()
    {
        $this->cambiarTelefono = !$this->cambiarTelefono;
    }

    public function save()
    {
        $this->validate();

        $this->user->save();
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.usuarios.editar_usuario', [
            'id'  => $this->user->id,
            'nombre' => $this->user->name,
            'telefono' => $this->user->phone,
            'rol' => $this->user->rol,
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        session()->flash('message', 'El usuario ha sido guardado.');
        return redirect('/usuarios');
    }
}
