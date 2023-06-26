<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Reparto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RepartirProductos extends Component
{
    public $buscar;

    public function render()
    {
        $this->buscar = mb_strtolower($this->buscar);

        $productos = Producto::where('estatus', '!=', 0)
            ->where(function ($query) {
                $query->where('descripcion', 'like', "%{$this->buscar}%")
                    ->orWhere('nombre', 'like', "%{$this->buscar}%");
            })
            ->join('reparto', 'reparto.id_producto', 'productos.id_producto')
            ->distinct()
            ->groupBy(
                'nombre',
                'productos.stock',
                'productos.id_producto',
                'descripcion',
                'imagen',
                'precio'
            )
            ->orderBy('productos.nombre', 'asc')
            ->get([
                'nombre', 'productos.stock', 'productos.id_producto', 'descripcion',
                'imagen', 'precio',
                DB::raw("SUM(reparto.stock) as stock_suma"),
            ]);


        $suma = 0;

        foreach ($productos as $prod) {
            $suma += ($prod->stock + $prod->stock_suma) * $prod->precio;
        }

        return view('livewire.repartir-productos', [
            'productos' => $productos,
            'suma_total' => $suma
        ]);
    }

    public function generateRegisters()
    {
        $productos = Producto::join('reparto', 'reparto.id_producto', 'productos.id_producto')->get();
        $almacenes = Almacen::where('activo', '!=', 0)->get();

        foreach ($productos as $producto) {
            foreach ($almacenes as $almacen) {
                Reparto::firstOrCreate(
                    [
                        'id_producto' => $producto->id_producto,
                        'id_almacen' => $almacen->id_almacen
                    ],
                    [
                        'stock' => 0,
                    ]
                );
            }
        }

        return "Done!";
    }

    public $rules = [
        'producto.*.stock' => 'required|numeric|gt:-1',
        'producto.*.cantidad' => 'required|numeric|gt:-1',
        'producto.*.almacenes.*' => 'required|numeric|gt:-1',
    ];

    public $messages = [
        'producto.*.stock.required' => 'Se requiere un stock en el almacen general',
        'producto.*.stock.numeric' => 'Se requiere un número',
        'producto.*.stock.gt' => 'Este número debe ser 0 o mayor',

        'producto.*.cantidad.required' => 'Se requiere un stock en el almacen general',
        'producto.*.cantidad.numeric' => 'Se requiere un número',
        'producto.*.cantidad.gt' => 'Este número debe ser 0 o mayor',

        'producto.*.almacenes.*.required' => 'Se requiere un número ya sea 0 o mayor',
        'producto.*.almacenes.*.numeric' => 'Se requiere un número',
        'producto.*.almacenes.*.gt' => 'Este número debe ser 0 o mayor',
    ];

    public function save(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->rules,
            $this->messages
        );

        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        foreach ($request->get('producto') as $producto => $productoValues) {
            if ($productoValues['cantidad'] > $productoValues['stock']) {
                $validator->errors()->add('producto.' . $producto . '.cantidad', 'Los productos repartidos exceden el stock en almacén general');
                return back()->withInput()->withErrors($validator);
            }

            if ($productoValues['cantidad'] == 0) continue;

            // Validating and updating productos in reparto

            $cant = 0;

            array_map(function ($val) use (&$cant) {
                $cant += $val;
            }, array_values($productoValues['almacenes']));

            if ($cant == 0) continue;

            // Updating productos stock

            $prod = Producto::where('id_producto', '=', $producto)
                ->first();

            if ($prod->stock != $productoValues['stock']) {
                $prod->update([
                    'stock' => $productoValues['stock']
                ]);
            }

            if ($cant != $productoValues['cantidad']) {
                $validator->errors()->add('producto.' . $producto . '.cantidad', "No se pueden repartir {$cant} productos de {$productoValues['cantidad']}. 
                Corrige y vuelve a intentar");
                return back()->withInput()->withErrors($validator);
            } else {
                Producto::where('id_producto', '=', $producto)
                    ->decrement('stock', $productoValues['cantidad']);
            }
        }

        foreach ($request->get('producto') as $producto => $productoValues) {

            if ($productoValues['cantidad'] == 0) continue;

            foreach ($productoValues['almacenes'] as $reparto => $repartoValue) {
                Reparto::where('id_producto', '=', $producto)
                    ->where('id_almacen', '=', $reparto)
                    ->increment(
                        'stock',
                        $repartoValue
                    );
            }
        }

        return redirect('/producto');
    }
}
