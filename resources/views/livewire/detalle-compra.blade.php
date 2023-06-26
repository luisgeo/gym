<div>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight justify-between inline-block align-middle">
            {{ __('PEDIDO DE ' . Str::upper($pedidos[0]->compra->cliente->nombre)) }}

        </h2>
    </x-slot>
    <br>

    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex justify-between">
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Sobre la compra</div>
                <div class="mr-2">
                    <div class="inline-block align-middle text-gray-500">
                        <ul>
                            <li>
                                Fecha: {{ date_format(date_create($pedidos[0]->compra->fecha_compra), 'Y-m-d') }}
                            </li>
                            <li>
                                Hora: {{ date_format(date_create($pedidos[0]->compra->fecha_compra), 'h:i:s') }}
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="mt-2 mr-2">
                    <div class="inline-block align-middle text-gray-700">
                        <ul>
                            <li>
                                Empleado: {{ $pedidos[0]->compra->usuario->name }}
                            </li>
                            <li class="text-gray-500 font-bold">
                                Tienda: {{ $pedidos[0]->producto->almacen->nombre }}
                            </li>
                            <li class="text-yellow-600 mt-1 underline">
                                Tipo de venta:
                                {{ $pedidos[0]->compra->tipo_compra == 1
                                    ? 'Unitario'
                                    : ($pedidos[0]->compra->tipo_compra == 2
                                        ? 'Medio Mayoreo'
                                        : ($pedidos[0]->compra->tipo_compra == 3
                                            ? 'Mayoreo'
                                            : ($pedidos[0]->compra->tipo_compra == 4
                                                ? 'Súper Mayoreo'
                                                : ''))) }}
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Sobre nuestro
                    cliente</div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                    {{ $pedidos[0]->compra->cliente->nombre }}</p>
                <p class="text-gray-500">
                    Pagado: ${{ number_format($pedidos[0]->compra->total, 2) }}
                </p>
            </div>

        </div>
    </div>

    <br>


    <div class="py-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th colspan="4" scope="col"
                                        class="px-6 py-3 text-center text-md font-medium text-gray-800 uppercase tracking-wider">
                                        Lista de productos
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Producto
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descuento
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($pedidos) == 0)
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-red-600 text-center">
                                            No hay compras todavía.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $pedido->producto->nombre }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $pedido->producto->codigo }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap {{$pedido->descuento_aplicado > 0 ? 'text-green-500 font-bold': ''}}">
                                                {{ $pedido->descuento_aplicado ?? 0 }}%
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap  text-gray-600">
                                                ${{ number_format($pedido->precio_aplicado, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $pedido->cantidad }} pz
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                ${{ number_format(($pedido->precio_aplicado - $pedido->precio_aplicado * ($pedido->descuento_aplicado / 100)) * $pedido->cantidad, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <!-- More items... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
