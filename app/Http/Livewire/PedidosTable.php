<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class PedidosTable extends Component
{
    use WithPagination;

    public Pedido $pedido;
    public $carrito;
    public $buscar;

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $pedidos = Compra::select('ucu.name as cliente_nombre', 
            'uc.telefono as cliente_telefono', 'uru.name as repartidor_nombre',
            'uru.name as repartidor_nombre',
            'ur.telefono as repartidor_telefono',
            'prod.nombre as producto', 'ped.cantidad as cantidad', 'prod.marca',
            'compras.estatus as estatus', 'compras.pagado as pagado')
            ->join('usuarios as uc', 'compras.id_usuario', '=', 'uc.id_usuario')
            ->join('users as ucu', 'ucu.id', '=', 'uc.id_user')
            ->join('usuarios as ur', 'r.id_usuario', '=', 'ur.id_usuario')
            ->join('users as uru', 'uru.id', '=', 'ur.id_user')
            ->join('pedidos as ped', 'compras.id_compra', '=', 'ped.id_compra')
            ->join('productos as prod', 'ped.id_producto', '=', 'prod.id_producto')
            ->where('compras.estatus', '=', '0')
            ->orWhere('ucu.name', 'ilike', $like)
            ->orWhere('r.ubicacion', 'ilike', $like)
            ->orWhere('uru.name', 'ilike', $like)
            ->orWhere('prod.nombre', 'ilike', $like)
            ->orWhere('prod.marca', 'ilike', $like)
            ->orderBy('compras.fecha_pedido', 'desc')
            ->paginate(50);
            
        return view('livewire.pedidos-table', [
            'pedidos' => $pedidos
        ]);
    }
}
