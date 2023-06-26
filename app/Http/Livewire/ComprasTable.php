<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Pedido;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ComprasTable extends Component
{
    use WithPagination;

    public $total_ventas;
    public Producto $producto;
    public $buscar;
    public $filtroFecha;

    public function render()
    {
        date_default_timezone_set('America/Mexico_City');

        $like = '%' . $this->buscar . '%';
        $filtroFechaFormatted = '';

        if ($this->filtroFecha != '') {
            $filtroFechaDate = Carbon::create($this->filtroFecha);
            $filtroFechaFormatted = $filtroFechaDate->format('Y-m-d');

            $compras = Compra::join('catclientes', 'catclientes.id_cliente', '=', 'compras.id_cliente')
                ->join('users', 'users.id', '=', 'compras.id_caja')
                ->where(
                    DB::raw('date(fecha_compra)'),
                    '=',
                    $filtroFechaFormatted
                )
                ->paginate(50);
        } else {
            $compras = Compra::join('catclientes', 'catclientes.id_cliente', '=', 'compras.id_cliente')
                ->join('users', 'users.id', '=', 'compras.id_caja')
                ->where('name', 'like', $like)
                ->orWhere('nombre', 'like', $like)
                ->orWhere('phone', 'like', $like)
                ->orWhere('telefono', 'like', $like)
                ->orderBy('compras.fecha_compra', 'desc')
                ->paginate(50);
        }

        $compras_hoy = Compra::where(
            DB::raw('date(fecha_compra)'),
            '=',
            $this->filtroFecha == '' ? date('Y-m-d') : $filtroFechaFormatted
        )->get();

        $this->total_ventas = 0;
        foreach ($compras_hoy as $compra) {
            $this->total_ventas += $compra->total;
        }

        return view('livewire.compras-table', [
            'compras' => $compras
        ]);
    }

    public function limpiarFecha()
    {
        $this->filtroFecha = '';
    }
}
