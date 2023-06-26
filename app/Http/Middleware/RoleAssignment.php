<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAssignment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = Auth::id();
        $rol = User::select('rol')
            ->where('id', '=', $id)
            ->get();

        if (count($rol) == 0) {
            $rol = 0;
        } else {
            $rol = User::select('rol')
                ->where('id', '=', $id)
                ->get()[0]['rol'];
        }

        session()->put('usuario_rol', $rol);

        return $next($request);
    }
}
