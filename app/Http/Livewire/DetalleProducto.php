<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;

class DetalleProducto extends Component
{
    public Producto $producto;

    public function mount($id = null)
    {
        if ($id == null) {
            $this->producto = new Producto();
        } else {
            $this->producto = Producto::findOrFail($id);
        }
    }

    public function render()
    {
        return view('livewire.detalle-producto', [
            'producto' => $this->producto
        ]);
    }

    #Agregar al carrito

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
        return redirect()->route('ofertas');
    }
}
