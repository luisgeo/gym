<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Repartidor;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RepartidorPedidos extends Component
{

    public $usuario;
    public $repartidor;
    public $pedidos;

    public function render()
    {
        $this->usuario = Usuario::where('id_user', '=', Auth::id())->first();
        $this->repartidor = Repartidor::where('id_usuario', '=', $this->usuario->id_usuario)->first();
        $this->pedidos = Compra::where('id_repartidor', '=', $this->repartidor->id_repartidor)
            ->where('estatus', '!=', 1)
            ->where('estatus', '!=', 2)
            ->orderBy('fecha_pedido', 'desc')
            ->get();
        return view('livewire.repartidor-pedidos');
    }
}
