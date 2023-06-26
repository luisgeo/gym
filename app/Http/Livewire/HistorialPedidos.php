<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Repartidor;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HistorialPedidos extends Component
{
    use WithPagination;

    public $total_ventas;
    public Producto $producto;
    public Usuario $usuario;
    public Repartidor $repartidor;
    public $buscar;

    public function render()
    {
        date_default_timezone_set('America/Mexico_City');

        $like = '%' . $this->buscar . '%';

        $this->usuario = Usuario::where('id_user', '=', Auth::id())->first();
        $this->repartidor = Repartidor::where('id_usuario', '=', $this->usuario->id_usuario)->first();

        $compras = Compra::select(
            'ucu.name as nombre_cliente',
            'uru.name as nombre_repartidor',
            'compras.fecha_pedido',
            'compras.id_compra',
            'compras.total',
            'compras.estatus',
            'compras.id_repartidor as id_rep',
            'r.estatus as repartidor_estatus',
            'r.ubicacion as repartidor_ubicacion'
        )
            ->join('usuarios as uc', 'compras.id_usuario', '=', 'uc.id_usuario')
            ->join('users as ucu', 'ucu.id', '=', 'uc.id_user')
            ->join('usuarios as ur', 'r.id_usuario', '=', 'ur.id_usuario')
            ->join('users as uru', 'uru.id', '=', 'ur.id_user')
            ->where('compras.id_repartidor', '=', $this->repartidor->id_repartidor)
            ->where(function ($query) use ($like) {
                $query->where('ucu.name', 'ilike', $like)
                    ->orWhere('ucu.email', 'ilike', $like);
            })
            ->orderBy('compras.fecha_pedido', 'desc')
            ->paginate(50);

        $compras_exito = Compra::where(function ($query) {
            $query->where('compras.id_repartidor', '=', $this->repartidor->id_repartidor)
                ->where('compras.estatus', '=', 1)
                ->where('compras.pagado', '=', true);
        })->get();

        return view('livewire.historial-pedidos', [
            'compras' => $compras,
            'total_pedidos' => count($compras_exito)
        ]);
    }
}
