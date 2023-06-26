<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\HistorialCompra;
use App\Models\Notificacion;
use App\Models\Producto;
use App\Models\Reparto;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class VenderProducto extends Component
{
    public Producto $producto;
    public Producto $productoBuscado;

    public bool $showCart;
    public Cliente $cliente;
    public Cliente $clienteNuevo;

    public $contador;
    public $carrito;
    public $cantidad;
    public $usuario;
    public $compra = [];
    public Compra $ultCompra;
    public $buscar;

    public Caja $caja;
    public $cantidad_apertura;
    public $ventas;
    public $total_ventas;
    public int $totalProductos = 0;
    // public $clientes;
    public $showNewClientModal;
    public $cliente_nombre_buscar;

    public $recibido;
    public $phase;
    public $cantidadVentas;

    public $scan;

    use WithPagination;

    public function mount()
    {
        $this->caja = Caja::where('id_usuario', '=', Auth::id())->first();
        $this->cantidadVentas = Compra::where('id_caja', '=', Auth::id())
            ->where(DB::raw('date(fecha_compra)'), '=', date('Y-m-d'))
            ->count();

        if ($this->caja->abierta == 0 &&  $this->cantidadVentas > 0) {
            abort(403, 'La caja ya se ha cerrado por hoy. Contacta a un administrador para desbloquear tu usuario.');
            return;
        }

        $this->clienteNuevo = new Cliente();
        $this->showCart = true;
        $this->setTotalProductos();
        $this->showNewClientModal = false;
        $this->cliente = new Cliente();
        $this->phase = session()->has('phase') ? session()->get('phase') : 0;
        $this->scan = false;

        if (!is_null(session()->get('cliente_nombre'))) {
            $this->cliente = Cliente::where('id_cliente', '=', session()->get('cliente_id'))->first();
            $this->cliente_nombre_buscar = session()->get('cliente_nombre');
        }
    }

    public function render()
    {
        $this->caja = Caja::where('id_usuario', '=', Auth::id())->first();
        $this->cantidadVentas = Compra::where('id_caja', '=', Auth::id())
            ->where(DB::raw('date(fecha_compra)'), '=', date('Y-m-d'))
            ->count();

        if ($this->caja->abierta == 0 &&  $this->cantidadVentas > 0) {
            abort(403, 'La caja ya se ha cerrado por hoy. Contacta a un administrador para desbloquear tu usuario.');
            return;
        }

        if (!is_null(session()->get('cliente_nombre'))) {
            $this->cliente = Cliente::where('id_cliente', '=', session()->get('cliente_id'))->first();
            $this->cliente_nombre_buscar = session()->get('cliente_nombre');
        }

        $this->phase = session()->has('phase') ? session()->get('phase') : 0;

        $clienteBuscar = mb_strtolower('%' .  $this->cliente_nombre_buscar . '%');
        $clientes = Cliente::where('nombre', 'like', $clienteBuscar)->get();

        date_default_timezone_set('America/Mexico_City');

        $this->usuario = Auth::user();

        $this->caja = Caja::where('id_usuario', '=', $this->usuario->id)->first();
        $this->ventas = Compra::where('id_caja', '=', $this->usuario->id)->where(DB::raw('date(fecha_compra)'), '=', date('Y-m-d'))->get();

        $this->total_ventas = 0;
        foreach ($this->ventas as $venta) {
            $this->total_ventas += $venta->total;
        }

        $this->total_ventas += session()->get('cantidad_apertura');

        $this->ultCompra = Compra::where('id_caja', '=', $this->usuario->id_usuario)->orderBy('fecha_compra', 'desc')->first() ?? new Compra();

        $like = mb_strtolower('%' . $this->buscar . '%');

        // $isACode = Producto::select('id_producto', 'estatus')
        //     // ->join('almacenes', 'almacenes.id_almacen', '=', 'productos.id_almacen')
        //     ->join('reparto', 'reparto.id_producto', '=', 'reparto.id_producto')
        //     ->join('almacenes', 'almacenes.id_almacen', '=', 'reparto.id_almacen')
        //     ->where('reparto.id_almacen', '=', $this->caja->id_almacen)
        //     ->where('codigo', '=', $this->buscar)
        //     ->where('estatus', '!=', 0)
        //     ->count() > 0;

        $isACode = Reparto::select('productos.id_producto', 'descripcion', 'estatus', 'productos.nombre as nombre', 'reparto.stock as stock', 'precio', 'precio_unitario', 'precio_medio_mayoreo', 'precio_mayoreo', 'precio_super_mayoreo', 'descuento', 'modelo', 'codigo', 'almacenes.nombre as nombre_almacen')
            ->join('almacenes', 'almacenes.id_almacen', '=', 'reparto.id_almacen')
            ->join('productos', 'productos.id_producto', '=', 'reparto.id_producto')
            ->where('reparto.id_almacen', '=', $this->caja->id_almacen)
            ->where('productos.estatus', '!=', 0)
            ->where('productos.codigo', '=', $this->buscar)
            ->count() > 0;

        if ($isACode && $this->buscar != "") {
            $productoEncontrado = Reparto::select('productos.id_producto', 'descripcion', 'estatus', 'productos.nombre as nombre', 'reparto.stock as stock', 'precio', 'precio_unitario', 'precio_medio_mayoreo', 'precio_mayoreo', 'precio_super_mayoreo', 'descuento', 'modelo', 'codigo', 'almacenes.nombre as nombre_almacen')
                ->join('almacenes', 'almacenes.id_almacen', '=', 'reparto.id_almacen')
                ->join('productos', 'productos.id_producto', '=', 'reparto.id_producto')
                ->where('reparto.id_almacen', '=', $this->caja->id_almacen)
                ->where('productos.estatus', '!=', 0)
                ->where('productos.codigo', 'like', $like)
                ->first();
            $this->agregar($productoEncontrado->id_producto);
            $this->buscar = "";
        }

        $this->showCart = $this->buscar == "";

        $productos = Reparto::select('productos.id_producto', 'descripcion', 'estatus', 'productos.nombre as nombre', 'reparto.stock as stock', 'precio', 'precio_unitario', 'precio_medio_mayoreo', 'precio_mayoreo', 'precio_super_mayoreo', 'descuento', 'modelo', 'codigo', 'almacenes.nombre as nombre_almacen')
            ->join('almacenes', 'almacenes.id_almacen', '=', 'reparto.id_almacen')
            ->join('productos', 'productos.id_producto', '=', 'reparto.id_producto')
            ->where('reparto.id_almacen', '=', $this->caja->id_almacen)
            ->where('productos.estatus', '!=', 0)
            ->where(function ($query) use ($like) {
                $query->where('productos.nombre', 'like', $like)
                    ->orWhere('codigo', 'like', $like)
                    ->orWhere('modelo', 'like', $like)
                    ->orWhere('descripcion', 'like', $like);
            })
            ->orderBy('productos.nombre', 'asc')
            ->paginate(50);

        return view('livewire.vender-producto', [
            'id_usuario' => $this->usuario->id,
            'productos' => $productos,
            'clientes' => $clientes
        ]);
    }

    public function abrirCaja()
    {
        $datos = $this->validate(
            ['cantidad_apertura' => 'required|gt:-1'],
            [
                'cantidad_apertura.required' => 'Se requiere una cantidad',
                'cantidad_apertura.gt' => 'La cantidad debe ser igual o mayor a 0'
            ]
        );

        session()->put('cantidad_apertura', $datos['cantidad_apertura']);

        if ($this->caja != null) {
            $this->caja->abierta = 1;
            $this->caja->save();
            $now = CarbonImmutable::now();
            $notificacion = new Notificacion();
            $notificacion->id_usuario = Auth::id();
            $notificacion->accion = __('messages.pings.vender_producto.abrir_caja', [
                'apertura'  => number_format($datos['cantidad_apertura'], 2)
            ]);
            $notificacion->tipo_alerta = 'alerta';
            $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");

            $notificacion->save();
        }
    }

    public function cerrarCaja()
    {
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.vender_producto.cerrar_caja', [
            'total'  => number_format(session('total'), 2)
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");

        $notificacion->save();

        session()->forget('abierta');
        session()->forget('total');
        session()->forget('cantidad_apertura');

        $this->limpiar();
        $this->phase = -1;
    }


    public function agregar($id)
    {
        if ($this->buscar != "") $this->buscar = "";

        if (is_null($id)) {
            $this->producto = new Producto();
        } else {
            $this->producto = Producto::find($id);
        }

        $carrito = session()->get('cart');

        if (!$carrito) {
            $carrito = [
                $id => [
                    'id' => $this->producto->id_producto,
                    'precio_adquisicion' => $this->producto->precio,
                    'precio_unitario' => $this->producto->precio_unitario,
                    'precio_medio_mayoreo' => $this->producto->precio_medio_mayoreo,
                    'precio_mayoreo' => $this->producto->precio_mayoreo,
                    'precio_super_mayoreo' => $this->producto->precio_super_mayoreo,
                    'descripcion' => $this->producto->descripcion,
                    'nombre' => $this->producto->nombre,
                    'codigo' => $this->producto->codigo,
                    'modelo' => $this->producto->modelo,
                    'precio' => 0,
                    'descuento' => $this->producto->descuento,
                    'cantidad' => 1,
                    'subtotal' => 0.0
                ]
            ];
            $this->totalProductos += 1;
        } else if (isset($carrito[$id])) {
            $stock = Reparto::where('id_producto', '=', $this->producto->id_producto)
                ->where('id_almacen', '=', $this->caja->id_almacen)
                ->first()
                ->stock;

            if ($carrito[$id]['cantidad'] < $stock) {
                $this->totalProductos += 1;

                $carrito[$id]['cantidad']++;
                $carrito[$id]['precio'] = 0;
            }
        } else {
            $carrito[$id] = [
                'id' => $this->producto->id_producto,
                'precio_adquisicion' => $this->producto->precio,
                'precio_unitario' => $this->producto->precio_unitario,
                'precio_medio_mayoreo' => $this->producto->precio_medio_mayoreo,
                'precio_mayoreo' => $this->producto->precio_mayoreo,
                'precio_super_mayoreo' => $this->producto->precio_super_mayoreo,
                'descripcion' => $this->producto->descripcion,
                'nombre' => $this->producto->nombre,
                'codigo' => $this->producto->codigo,
                'modelo' => $this->producto->modelo,
                'precio' => 0,
                'descuento' => $this->producto->descuento,
                'cantidad' => 1,
                'subtotal' => 0.0
            ];
            $this->totalProductos += 1;
        }

        foreach ($carrito as $id_item => $item) {
            $carrito[$id_item]['precio'] = $this->getPrecio($item['precio_adquisicion'], $item['precio_unitario'], $item['precio_medio_mayoreo'], $item['precio_mayoreo'], $item['precio_super_mayoreo']);
            $carrito[$id_item]['subtotal'] = $carrito[$id_item]['cantidad'] * ($carrito[$id_item]['precio'] - ($carrito[$id_item]['precio'] * ($carrito[$id_item]['descuento'] * 0.01)));
        }

        $total = 0;
        foreach ($carrito as $elem) {
            $total += $elem['subtotal'];
        }


        session()->put('total', $total);
        session()->put('cart', $carrito);
    }

    public function setTotalProductos()
    {
        $carrito = session()->get('cart');
        if (!$carrito) {
            $this->totalProductos = 0;
            return;
        }

        foreach ($carrito as $id => $item) {
            $this->totalProductos += $item['cantidad'];
        }
    }

    public function getPrecio($precioAdquisicion, $precioUnitario, $precioMedioMayoreo, $precioMayoreo, $precioSuperMayoreo)
    {
        //Precios de mayoreo y super mayoreo

        if ($this->totalProductos < getenv('MIN_MEDIO_MAYOREO'))
            return (($precioUnitario / 100) * $precioAdquisicion) + $precioAdquisicion;

        if ($this->totalProductos >= getenv('MIN_MEDIO_MAYOREO') && $this->totalProductos < getenv('MIN_MAYOREO'))
            return (($precioMedioMayoreo / 100) * $precioAdquisicion) + $precioAdquisicion;

        if ($this->totalProductos >= getenv('MIN_MAYOREO') && $this->totalProductos < getenv('MIN_SUPER_MAYOREO'))
            return (($precioMayoreo / 100) * $precioAdquisicion) + $precioAdquisicion;

        if ($this->totalProductos >= getenv('MIN_SUPER_MAYOREO'))
            return (($precioSuperMayoreo / 100) * $precioAdquisicion) + $precioAdquisicion;
    }

    public function quitar($id)
    {
        if (is_null($id)) {
            $this->producto = new Producto();
        } else {
            $this->producto = Producto::find($id);
        }

        $carrito = session()->get('cart');

        if (!isset($carrito[$id])) return;

        if ($carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
            $carrito[$id]['precio'] = 0;
        } else {
            unset($carrito[$id]);
        }

        $this->totalProductos -= 1;

        foreach ($carrito as $id_item => $item) {
            $carrito[$id_item]['precio'] = $this->getPrecio($item['precio_adquisicion'], $item['precio_unitario'], $item['precio_medio_mayoreo'], $item['precio_mayoreo'], $item['precio_super_mayoreo']);
            $carrito[$id_item]['subtotal'] = $carrito[$id_item]['cantidad'] * ($carrito[$id_item]['precio'] - ($carrito[$id_item]['precio'] * ($carrito[$id_item]['descuento'] * 0.01)));
        }

        $total = 0;
        foreach ($carrito as $elem) {
            $total += $elem['subtotal'];
        }

        session()->put('cart', $carrito);
        session()->put('total', $total);
    }

    public function borrar($id)
    {
        if (is_null($id)) {
            $this->producto = new Producto();
        } else {
            $this->producto = Producto::find($id);
        }

        $carrito = session()->get('cart');

        if (!isset($carrito[$id])) return;

        $this->totalProductos -= $carrito[$id]['cantidad'];

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
        }

        foreach ($carrito as $id_item => $item) {
            $carrito[$id_item]['precio'] = $this->getPrecio($item['precio_adquisicion'], $item['precio_unitario'], $item['precio_medio_mayoreo'],  $item['precio_mayoreo'], $item['precio_super_mayoreo']);
            $carrito[$id_item]['subtotal'] = $carrito[$id_item]['cantidad'] * ($carrito[$id_item]['precio'] - ($carrito[$id_item]['precio'] * ($carrito[$id_item]['descuento'] * 0.01)));
        }

        $total = 0;
        foreach ($carrito as $elem) {

            $total += $elem['subtotal'];
        }

        session()->put('cart', $carrito);
        session()->put('total', $total);
    }

    public function mostrarCliente()
    {
        session()->put('phase', 1);
        $this->phase = 1;
    }

    public function terminarCompra()
    {
        session()->put('phase', 2);
        $this->phase = 2;
    }

    public function prelimpieza()
    {
        $cambio = $this->recibido - session()->get('total');

        session()->put('recibido', $this->recibido);
        session()->put('cambio', $cambio);

        //Registrar compra

        $carrito = session()->get('cart');
        $clienteId = session()->has('cliente_id') ? session('cliente_id') : 1;
        $tipoCompra = ($this->totalProductos >= getenv('MIN_MAYOREO') && $this->totalProductos < getenv('MIN_SUPER_MAYOREO') ? 2 : ($this->totalProductos >= getenv('MIN_SUPER_MAYOREO') ? 3 : 1));

        $now = CarbonImmutable::now();

        $this->compra = [
            'id_caja' => Auth::id(),
            'id_cliente' => $clienteId,
            'estatus' => 1,
            'total' =>  session()->get('total'),
            'tipo_compra' => $tipoCompra,
            'acumulado_cliente' => session()->get('total'),
            'cambio' => $cambio,
            'recibido' => $this->recibido,
            'fecha_compra' => $now->format("Y-m-d H:i:s")
        ];

        $this->cliente = Cliente::where('id_cliente', '=', $clienteId)->first();
        $this->cliente->acumulado += session()->get('total');
        $this->cliente->save();

        $this->ultCompra = new Compra();
        $this->ultCompra = $this->ultCompra->create($this->compra);

        session()->put('ultCompra', $this->ultCompra->id_compra);

        foreach ($carrito as $pedido) {
            $id = $pedido['id'];
            // $this->producto = Producto::find($id);
            $cantidad = $pedido['cantidad'];

            $datos = [
                'id_producto' => $id,
                'precio_aplicado' => $pedido['precio'],
                'cantidad' => $cantidad,
                'descuento_aplicado' => $pedido['descuento'],
                'id_almacen' => $this->caja->id_almacen,
                'id_compra' =>  $this->ultCompra->id_compra
            ];

            $query = DB::table('reparto')
            ->where('id_producto', '=', $id)
            ->where('id_almacen', '=', $this->caja->id_almacen);

            $query->decrement('stock', $cantidad);

            HistorialCompra::insert($datos);
        }

        session()->put('phase', 3);
        $this->phase = 3;

        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.vender_producto.terminar', [
            'total'  => $this->recibido,
            'cambio' => $cambio
        ]);
        $notificacion->tipo_alerta = 'info';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");

        $notificacion->save();

        Log::error("PRELIMPIEZA: R=" . $this->recibido . " C=" . $cambio);
    }

    public function limpiar()
    {
        session()->forget('phase');
        session()->forget('cliente_nombre');
        session()->forget('cliente_id');
        session()->forget('cambio');
        session()->forget('recibido');
        session()->forget('ultCompra');

        $this->recibido = 0;
        $this->clienteNuevo = new Cliente();
        $this->cliente = new Cliente();
        $this->cliente_nombre_buscar = "";

        if (session()->has('cart')) {
            $carrito = session()->get('cart');
            foreach ($carrito as $pedido) {
                $this->borrar($pedido['id']);
            }
        }

        $this->totalProductos = 0;
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }

    public function openNewClientModal()
    {
        $this->showNewClientModal = true;
        $this->scan = false;
    }
    public function closeNewClientModal()
    {
        $this->showNewClientModal = false;
        $this->scan = false;
    }

    public function closeScanQr()
    {
        $this->showNewClientModal = false;
        $this->scan = false;
    }

    public function rules()
    {
        return [
            'clienteNuevo.nombre' => ['required', 'string'],
            'clienteNuevo.telefono' => ['required', 'numeric', 'digits:10'],
            'clienteNuevo.correo' => ['nullable', 'email'],
        ];
    }

    public function messages()
    {
        return __('messages.registrar_cliente');
    }

    public function registrarCliente()
    {
        $this->validate();
        $this->clienteNuevo->acumulado = 0;
        $this->clienteNuevo->estatus = 1;
        $this->clienteNuevo->save();

        $this->cliente = $this->clienteNuevo;
        $now = CarbonImmutable::now();
        $notificacion = new Notificacion();
        $notificacion->id_usuario = Auth::id();
        $notificacion->accion = __('messages.pings.vender_producto.registrar_cliente', [
            'id'  => $this->clienteNuevo->id_cliente,
            'nombre' => $this->clienteNuevo->nombre
        ]);
        $notificacion->tipo_alerta = 'alerta';
        $notificacion->fecha_registro = $now->format("Y-m-d H:i:s");

        $notificacion->save();

        session()->put('cliente_nombre', $this->clienteNuevo->nombre);
        session()->put('cliente_id', $this->clienteNuevo->id_cliente);

        $this->closeNewClientModal();
    }

    public function cambiarCliente()
    {
        session()->forget('cliente_nombre');
        session()->forget('cliente_id');
    }

    public function seleccionarCliente($id_cliente)
    {
        $this->cliente = Cliente::where('id_cliente', '=', $id_cliente)->first();
        $this->cliente_nombre_buscar = $this->cliente->nombre;
        session()->put('cliente_nombre', $this->cliente->nombre);
        session()->put('cliente_id', $this->cliente->id_cliente);
    }

    public function activateScan()
    {
        $this->buscar = "";
        $this->showNewClientModal = false;
        $this->scan = true;
    }

    public function clearSearch()
    {
        $this->scan = false;
        $this->buscar = "";
    }
}
