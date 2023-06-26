<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Almacen;
use App\Models\Caja;
use App\Models\Notificacion;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RegisterUser extends Component
{
    public $almacenes;

    public $rol;
    public $name;
    public $phone;
    public $password;
    public $password_confirmation;
    public $almacen;

    # Caja

    use PasswordValidationRules;

    public function messages()
    {
        return __('messages.registro_usuarios');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer', 'digits:10', 'unique:users'],
            'password' => $this->passwordRules(),
            'rol' => ['required', 'integer'],
            'almacen' => ['required_if:rol,==,3']
        ];
    }

    public function mount()
    {
        $this->rol = "--Seleccionar--";
        $this->almacenes = Almacen::all();
    }

    public function render()
    {
        return view('livewire.register-user');
    }

    public function register()
    {
        $this->validate();

        $now = Carbon::now();

        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'rol' => $this->rol,
            'estado_usuario' => 0,
            'fecha_ultima_actividad' => $now->format('Y-m-d h:i:s')
        ]);
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.usuarios.crear_usuario', [
            'id'  => $user->id,
            'nombre' => $user->name,
            'telefono' => $user->phone,
            'rol' => $user->rol,
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        if ($this->rol == 3) {
            Caja::create([
                'abierta' => 0,
                'id_almacen' => $this->almacen,
                'id_usuario' => $user->id
            ]);
        }

        return redirect('/usuarios');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        if (Auth::attempt(array('phone' => $input['phone'], 'password' => $input['password']))) {
            $now = CarbonImmutable::now();
            $notificacion = new Notificacion();
            $notificacion->id_usuario = Auth::id();
            $notificacion->accion = __('messages.pings.usuarios.login', [
                'telefono'  => $input['phone']
            ]);
            $notificacion->tipo_alerta = 'info';
            $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");

            $notificacion->save();

            return redirect('/dashboard');
        }
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id() ?? User::where('name', '=', 'Desconocido')->first()->id;
        $notificacion->accion = __('messages.pings.usuarios.intento_fallido', [
            'telefono'  => $input['phone']
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        return redirect('/login')->withErrors([
            'error' => 'Usuario o contraseña incorrectos. Intente de nuevo.'
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->estado_usuario = 0;
        $user->save();

        if ($user->rol == 3) {
            $caja = Caja::where('id_usuario', '=', $user->id)->first();
            $caja->abierta = 0;
            $caja->save();
        }
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.usuarios.logout', [
            'telefono'  => $user->phone
        ]);
        $notificacion->tipo_alerta = 'info';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");
        $notificacion->save();

        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function setRole()
    {
        $this->rol = 2;
    }
}
