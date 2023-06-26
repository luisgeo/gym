<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Notificacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RegisterUserSinLogin extends Component
{
    use PasswordValidationRules;

    public function render()
    {
        if (User::count() > 0) abort(403);

        return view('livewire.register-user-sin-login');
    }

    public function register(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer', 'digits:10', 'unique:users'],
            'password' => $this->passwordRules(),
            'rol' => ['required', 'integer'],
        ])->validate();

        $now = Carbon::now();

        $user = User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
            'rol' => $input['rol'],
            'estado_usuario' => 0,
            'fecha_ultima_actividad' => $now->format('Y-m-d h:i:s')
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        if (Auth::attempt(array('phone' => $input['phone'], 'password' => $input['password']))) {
            return redirect('/dashboard');
        }

        return redirect('/login')->withErrors([
            'error' => 'Usuario o contraseña incorrectos. Intente de nuevo.'
        ]);
    }
}
