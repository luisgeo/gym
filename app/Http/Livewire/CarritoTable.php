<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Queja;
use App\Models\Repartidor;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CarritoTable extends Component
{

    public Producto $producto;
    public $repartidor;
    public $contador;
    public $carrito;
    public $confirmada;
    public $pedidos;
    public $pedido;
    public $ubicacion;
    public $mensaje;
    public $usuario;
    public $buscarRepartidor;
    public $cancelado;
    public $compra = [];
    public $ultCompra;
    public $estatus_pedido;
    public $membresia;
    public $encontrado;

    public $rules = [
        'mensaje.mensaje' => 'required|max:30'
    ];

    public function render()
    {
        $this->usuario = Usuario::where('id_user', '=', Auth::id())
            ->first();
        $this->membresia = $this->usuario->membresia;
        $this->usuario = $this->usuario->id_usuario;

        $this->ultCompra = Compra::where('id_usuario', '=', $this->usuario)
            ->orderBy('id_compra', 'desc')
            ->first();

        $this->encontrado = session()->get('encontrado');

        if ($this->ultCompra != null) {
            $this->actualizarEstatus();
        }

        if ($this->ultCompra != null && $this->estatus_pedido != 1 && $this->estatus_pedido != 2) {
            $this->encontrarRepartidor();
        }

        return view('livewire.carrito-table', [
            'id_usuario' => $this->usuario
        ]);
    }

    public function agregar($id)
    {

        if (is_null($id)) {
            $this->producto = new Producto();
        } else {
            $this->producto = Producto::find($id);
        }

        $carrito = session()->get('cart');

        if (!$carrito) {
            $carrito = [
                $id => [
                    'id' => $id,
                    'nombre' => $this->producto->nombre,
                    'marca' => $this->producto->marca,
                    'precio' => $this->producto->precio,
                    'descuento' => $this->producto->descuento,
                    'cantidad' => 1,
                    'subtotal' => 0.0
                ]
            ];
        } else if (isset($carrito[$id])) {
            $stock = $this->producto->stock;
            if ($carrito[$id]['cantidad'] < $stock) {
                $carrito[$id]['cantidad']++;
            }
        } else {
            $carrito[$id] = [
                'id' => $id,
                'nombre' => $this->producto->nombre,
                'marca' => $this->producto->marca,
                'precio' => $this->producto->precio,
                'descuento' => $this->producto->descuento,
                'cantidad' => 1,
                'subtotal' => 0.0
            ];
        }

        $carrito[$id]['subtotal'] = $carrito[$id]['cantidad'] * ($carrito[$id]['precio'] - ($carrito[$id]['precio'] * ($carrito[$id]['descuento'] * 0.01)));

        $total = 0;
        foreach ($carrito as $elem) {
            $total += $elem['subtotal'];
        }

        if ($total > 0 && $total < 150) {
            $total += 5;
        }

        session()->put('total', $total);
        session()->put('cart', $carrito);
    }

    public function quitar($id)
    {
        if (is_null($id)) {
            $this->producto = new Producto();
        } else {
            $this->producto = Producto::find($id);
        }

        $carrito = session()->get('cart');


        if ($carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
        } else {
            unset($carrito[$id]);
        }

        if (isset($carrito[$id])) {
            $carrito[$id]['subtotal'] = $carrito[$id]['cantidad'] * ($carrito[$id]['precio'] - ($carrito[$id]['precio'] * ($carrito[$id]['descuento'] * 0.01)));
        }

        $total = 0;
        foreach ($carrito as $elem) {

            $total += $elem['subtotal'];
        }

        if ($total > 0 && $total < 150) {
            $total += 5;
        }

        session()->flash('message', 'Se ha quitado el producto del carrito');
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

        $carrito[$id]['subtotal'] = $carrito[$id]['cantidad'] * ($carrito[$id]['precio'] - ($carrito[$id]['precio'] * ($carrito[$id]['descuento'] * 0.01)));

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->flash('message', 'Se ha quitado el producto del carrito');
        }


        $total = 0;
        foreach ($carrito as $elem) {

            $total += $elem['subtotal'];
        }

        if ($total > 0 && $total < 150) {
            $total += 5;
        }

        session()->put('cart', $carrito);
        session()->put('total', $total);
    }


    public function guardarPedido()
    {
        $strikes = Usuario::select('strikes')->where('id_usuario', '=', $this->usuario)->get()[0]['strikes'];

        if ($strikes < 3) {
            $carrito = session()->get('cart');
            $repartidor = 1;

            $fields = [
                'id_usuario' => $this->usuario,
                'id_repartidor' => $repartidor,
                'total' =>  session()->get('total'),
                'con_membresia' => $this->membresia > 0 ? 'true' : 'false',
                'estatus' => '0',
                'pagado' => 'false'
            ];

            $this->ultCompra = Compra::create($fields);

            foreach ($carrito as $pedido) {
                $id = $pedido['id'];
                $this->producto = Producto::find($id);
                $cantidad = $pedido['cantidad'];

                $datos = [

                    'id_producto' => $id,
                    'cantidad' => $cantidad,
                    'id_compra' => $this->ultCompra->id_compra

                ];
                Pedido::insert($datos);
            }

            $this->confirmada = true;
            $this->estatus_pedido = 0;
            $this->encontrarRepartidor();
        } else {
            $this->contador = -1;
            session()->put('contador', $this->contador);
        }
    }

    public function encontrarRepartidor()
    {
        $this->repartidor = $this->ultCompra->repartidor;
        session()->put('phase', 1);

        if ($this->repartidor->id_repartidor != 1) {
            $this->contador = 1;
            $this->encontrado = true;
            session()->put('repartidor', $this->repartidor);
            session()->put('phase', 2);


            //$this->guardarPedido();
        } else {
            $this->contador = 0;
            $this->encontrado = false;
        }

        //Llenar el carrito con la compra anterior
        $pedidos = Pedido::where('id_compra', '=', $this->ultCompra->id_compra)->get();
        $carrito = [];

        foreach ($pedidos as $pedido) {
            $carrito[$pedido->id_producto] = [
                'id' => $pedido->id_producto,
                'nombre' => $pedido->producto->nombre,
                'marca' => $pedido->producto->marca,
                'precio' => $pedido->producto->precio,
                'descuento' => $pedido->producto->descuento,
                'cantidad' => $pedido->cantidad,
                'subtotal' => ($pedido->cantidad * ($pedido->producto->precio - ($pedido->producto->precio * ($pedido->producto->descuento * 0.01))))
            ];
        }

        $total = 0;
        foreach ($carrito as $elem) {
            $total += $elem['subtotal'];
        }

        session()->put('total', $total);
        session()->put('cart', $carrito);

        session()->put('contador', $this->contador);
        session()->put('encontrado', $this->encontrado);

        $this->buscarRepartidor = true;
    }


    public function actualizarEstatus()
    {
        $this->estatus_pedido = Compra::find($this->ultCompra->id_compra)->estatus;
        $this->cancelado = $this->estatus_pedido == 2;
    }

    public function terminar()
    {
        $carrito = session()->get('cart');
        foreach ($carrito as $pedido) {
            $this->borrar($pedido['id']);
        }

        $this->cancelado = null;
        $this->encontrado = false;
        $this->buscarRepartidor = false;

        session()->put('contador', 0);
        session()->put('encontrado', false);
        session()->put('repartidor', null);
        session()->put('phase', 0);
    }

    public function cancelarPedido()
    {
        $this->ultCompra->estatus = 2;
        $this->ultCompra->save();

        DB::table('usuarios')
            ->where('id_usuario', $this->usuario)
            ->increment('strikes', 1);

        session()->put('phase', -1);
        $this->cancelado = true;
        $this->encontrado = false;
    }

    public function cerrarEstado()
    {
        $this->encontrado = false;
        $this->cancelado = null;

        session()->put('contador', 0);
        session()->put('encontrado', false);
        session()->put('repartidor', null);
        session()->put('phase', 0);
    }

    public function reportarPedido()
    {
        $this->validate();

        $id = $this->ultCompra->id_compra;

        Queja::insert([
            'id_compra' => $id,
            'id_usuario' => $this->usuario,
            'mensaje' => $this->mensaje
        ]);
        session()->flash('message', 'Se ha guardado su queja. Atenderemos su caso a la brevedad.');
        $this->terminar();
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
