<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\HistorialCompra;
use App\Models\Pedido;
use App\Models\Repartidor;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetalleCompra extends Component
{
    public $pedidos;
    public $repartidor;
    public $usuario;
    public $compra;


    public function mount($id = null)
    {
        $this->compra = Compra::findOrFail($id);
        $this->pedidos = HistorialCompra::where('historial_compra.id_compra', '=', $id)
            ->join('compras', 'compras.id_compra', '=', 'historial_compra.id_compra')
            ->get();
    }


    public function render()
    {
        return view('livewire.detalle-compra');
    }
}
