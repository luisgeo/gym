<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $rol)
    {
        $roles = [
            'no_registrado' => [0],
            'repartidor' => [1],
            'administrador' => [2],
            'empleado' => [3]
        ];

        $rolIds = $roles[$rol] ?? [];

        $usrRol = User::select('rol')
            ->where('id', '=', Auth::id())
            ->get();      

        if (count($usrRol) == 0) {
            $usrRol = 0;
        } else {
            $usrRol = User::select('rol')
                ->where('id', '=', Auth::id())
                ->get()[0]['rol'];
        }

        if (!in_array($usrRol, $rolIds)){
            abort(403);
        }

        $user = Auth::user();
        $user->estado_usuario = 1;
        $user->save();

        return $next($request);
    }
}
