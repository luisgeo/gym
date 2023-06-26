<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Pedido;
use App\Models\Queja;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisEstadisticasTable extends Component
{
    public function render()
    {
        $idusuario = Usuario::select('id_usuario')->where('id_user', '=', Auth::id())->get();
        $compras = [];
        $quejas = [];
        $strikes = 1;

        if (count($idusuario) > 0) {
            $idusuario = $idusuario[0]['id_usuario'];
            $compras = Compra::where('id_usuario', '=', $idusuario)->orderBy('fecha_pedido', 'desc')->get();
            $quejas = Queja::where('id_usuario', '=', $idusuario)->get();
            $strikes = Usuario::select('strikes')->where('id_usuario', '=', $idusuario)->get()[0]['strikes'];
        } else {
            $idusuario = 0;
        }

        return view('livewire.mis-estadisticas-table', [
            'id_usuario' => $idusuario,
            'quejas' => $quejas,
            'pedidos' => $compras,
            'strikes' => $strikes
        ]);
    }
}
