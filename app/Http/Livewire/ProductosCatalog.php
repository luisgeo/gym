<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosCatalog extends Component
{

    use WithPagination;

    public Producto $producto;
    public $carrito;
    public $buscar;

    public function render()
    {
        $like = '%' . $this->buscar . '%';
        $productos = Producto::where('nombre', 'like', $like)
            ->where('stock', '>', '0')
            ->orWhere('marca', 'like', $like)
            ->orWhere('descripcion', 'like', $like)
            ->paginate(50);
        return view('livewire.productos-catalog', compact('productos'));
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
        session()->flash('message', 'Se ha agregado al carrito.');
    }

    public function cerrarAlerta()
    {
        session()->forget('message');
    }
}
