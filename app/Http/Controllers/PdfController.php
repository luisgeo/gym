<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Compra;
use App\Models\HistorialCompra;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public $compras;
    public $total;

    public function reportOfTheDayCaja()
    {
        date_default_timezone_set('America/Mexico_City');
        $usuario = Usuario::where('id_user', '=', Auth::id())->first();

        $this->compras = DB::select('SELECT nombre, sum(pedidos.cantidad) as sumatoria FROM productos
            INNER JOIN pedidos
            ON pedidos.id_producto = productos.id_producto
            INNER JOIN compras
            ON compras.id_compra = pedidos.id_compra
            WHERE compras.estatus = ? AND compras.pagado = ? AND date(compras.fecha_pedido) = ?
            AND compras.id_usuario = ?
            GROUP BY productos.id_producto', [1, true, date('Y-m-d'), $usuario->id_usuario]);

        $caja = Caja::where('id_usuario', '=', $usuario->id_usuario)->first();

        $this->total = 0;

        $this->total = DB::table('compras')
            ->select(DB::raw('sum(total) as total'))
            ->where(DB::raw('date(fecha_pedido)'), '=', date('Y-m-d'))
            ->where('id_usuario', '=', $usuario->id_usuario)
            ->first()->total;

        $pdf = PDF::loadView('pdf.reporte', [
            'apertura' => session()->get('cantidad_apertura'),
            'cierre' => session()->get('cantidad_apertura') + $this->total,
            'fecha_apertura' => $caja->fecha_apertura,
            'fecha_cierre' => $caja->fecha_cierre,
            'compras' => $this->compras,
            'vendido' => $this->total
        ]);

        return $pdf->stream('Reporte de caja ' . date('Y-m-d Hi') . '.pdf');
    }

    public function reportToday()
    {
        date_default_timezone_set('America/Mexico_City');

        $this->compras = DB::select('SELECT nombre, sum(pedidos.cantidad) as sumatoria FROM productos
            INNER JOIN pedidos
            ON pedidos.id_producto = productos.id_producto
            INNER JOIN compras
            ON compras.id_compra = pedidos.id_compra
            WHERE compras.estatus = ? AND compras.pagado = ? AND date(compras.fecha_pedido) = ?
            GROUP BY productos.id_producto', [1, true, date('Y-m-d')]);

        $this->total = 0;

        $this->total = DB::table('compras')
            ->select(DB::raw('sum(total) as total'))
            ->where(DB::raw('date(fecha_pedido)'), '=', date('Y-m-d'))
            ->first()->total;

        $pdf = PDF::loadView('pdf.reporte', [
            'compras' => $this->compras,
            'vendido' => $this->total
        ]);

        return $pdf->stream('Reporte diario ' . date('Y-m-d Hi') . '.pdf');
    }

    public function reportOfTheWeek()
    {
        date_default_timezone_set('America/Mexico_City');

        $this->compras = DB::select('SELECT nombre, sum(pedidos.cantidad) as sumatoria FROM productos
            INNER JOIN pedidos
            ON pedidos.id_producto = productos.id_producto
            INNER JOIN compras
            ON compras.id_compra = pedidos.id_compra
            WHERE compras.estatus = ? AND compras.pagado = ? AND extract(week from compras.fecha_pedido) = ?
            GROUP BY productos.id_producto', [1, true, date('W')]);

        $this->total = 0;

        $this->total = DB::table('compras')
            ->select(DB::raw('sum(total) as total'))
            ->where(DB::raw('extract(week from fecha_pedido)'), '=', date('W'))
            ->first()->total;

        $pdf = PDF::loadView('pdf.reporte', [
            'compras' => $this->compras,
            'vendido' => $this->total
        ]);



        return $pdf->stream('Reporte de semana ' . date('W') . ' ' . date('Y-m-d Hi') . '.pdf');
    }

    public function reportOfTheMonth()
    {
        date_default_timezone_set('America/Mexico_City');

        $this->compras = DB::select('SELECT nombre, sum(pedidos.cantidad) as sumatoria FROM productos
            INNER JOIN pedidos
            ON pedidos.id_producto = productos.id_producto
            INNER JOIN compras
            ON compras.id_compra = pedidos.id_compra
            WHERE compras.estatus = ? AND compras.pagado = ? AND extract(month from compras.fecha_pedido) = ?
            GROUP BY productos.id_producto', [1, true, date('m')]);

        $this->total = 0;

        $this->total = DB::table('compras')
            ->select(DB::raw('sum(total) as total'))
            ->where(DB::raw('extract(month from fecha_pedido)'), '=', date('m'))
            ->first()->total;

        $pdf = PDF::loadView('pdf.reporte', [
            'compras' => $this->compras,
            'vendido' => $this->total
        ]);



        return $pdf->stream('Reporte mensual ' . date('Y-m-d Hi') . '.pdf');
    }

    public function ticket($id = null)
    {
        $idFromSession = session()->has('ultCompra') ? session('ultCompra') : null;

        if (is_null($id) && is_null($idFromSession)) {
            abort(403);
        }

        if (!is_null($idFromSession)) {
            $id = $idFromSession;
        }

        $compra = Compra::findOrFail($id);

        $usuario_sesion = User::where('id', '=', Auth::id())->first()->rol;

        if ($usuario_sesion != 2 && $usuario_sesion != 3) {
            abort(403, 'No autorizado');
        }

        $caja = Caja::where('id_usuario', '=', $compra->id_caja)->first();

        $cantidad = HistorialCompra::select(DB::raw('sum(cantidad) as cantidad_productos'))
            ->where('id_compra', '=', $id)->first()->cantidad_productos;

        $historial = HistorialCompra::join('productos', 'productos.id_producto', '=', 'historial_compra.id_producto')
            ->where('id_compra', '=', $id)
            ->orderBy('productos.nombre', 'ASC')
            ->get();

        $pdf = PDF::loadView('pdf.ticket', [
            'compra' => $historial,
            'cantidad_productos' => $cantidad,
            'reporte' => $compra,
            'caja' => $caja,
            'recibido' => $compra->recibido,
            'cambio' => $compra->cambio,
            'fecha' => $compra->fecha_compra
        ]);

        $now = Carbon::now();
        return $pdf->stream('Ticket de compra ' . $now->format('Y-m-d h:i:s') . '.pdf');
    }
}
