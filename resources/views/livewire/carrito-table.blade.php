<div>

    @if (session()->has('message'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Atención: </strong>
            <span class="block sm:inline">{{ session('message') }}</span>
            <button wire:click="cerrarAlerta()">
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </button>
        </div>
    @endif
    <br>
    <div>
        <div class="flex justify-center">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="divide-y divide-gray-200 text-center">

                            <thead>
                                <tr>
                                    <th class="px-16 py-7 text-black text-left text-sm font-max"
                                        style="background-color: greenyellow">
                                        PRODUCTO
                                    </th>
                                    <th class="px-6 py-5 text-black text-sm font-max"
                                        style="background-color: greenyellow">
                                        CANTIDAD
                                    </th>
                                    <th class="px-8 py-5 text-black text-sm font-max"
                                        style="background-color: greenyellow">
                                        SUBTOTAL
                                    </th>
                                    <th class="px-8 py-2 text-black text-sm font-max"
                                        style="background-color: greenyellow">
                                        QUITAR
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->get('total') == 0)
                                    <tr>
                                        <td colspan="7" class="text-gray-500 py-4">Tu carrito está vacío</td>
                                    </tr>
                                @else
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $item)
                                            <tr>
                                                <td class="px-3 py-3">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-20 w-20">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item['nombre'] }}
                                                            </div>

                                                            <div class="text-sm text-gray-500">
                                                                {{ $item['marca'] }}
                                                            </div>
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                ${{ $item['precio'] }}
                                                            </span>
                                                            @if ($item['descuento'] != 0)
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                    -{{ $item['descuento'] }}%

                                                                </span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <div class="flex items-stretch justify-center">
                                                        <div
                                                            class="self-center bg-gray-800 w-24 py-3 text-white rounded-full">
                                                            <button
                                                                {{ session()->get('phase') >= 1 || session()->get('phase') == -1 ? 'disabled' : '' }}
                                                                wire:click="quitar({{ $id }})"
                                                                style="color: #54ff00; font-size: 16px;">
                                                                <strong> - </strong>
                                                            </button>
                                                            {{ $item['cantidad'] }}
                                                            <button
                                                                {{ session()->get('phase') >= 1 || session()->get('phase') == -1 ? 'disabled' : '' }}
                                                                wire:click="agregar({{ $id }})"
                                                                style="color: #54ff00; font-size: 16px;">
                                                                <strong> + </strong>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-3">
                                                    <strong>
                                                        ${{ $item['subtotal'] }}
                                                    </strong>
                                                </td>
                                                <td class="px-3">
                                                    <div class="flex items-stretch justify-center">
                                                        <div class="self-center bg-gray-700 w-12 py-3 rounded-full">
                                                            <button
                                                                {{ session()->get('phase') >= 1 || session()->get('phase') == -1 ? 'disabled' : '' }}
                                                                wire:click="borrar({{ $id }})"
                                                                style="color: #f6402f; font-size: 16px;">
                                                                <strong> x </strong>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                                <tr>
                                    <td colspan="2"
                                        class="text-left py-4 px-3 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-t border-grey-light">

                                        <strong>Total a pagar (MXN):
                                            ${{ session()->get('total') != 0 ? session()->get('total') : 0.0 }}
                                        </strong>

                                    </td>
                                    <td colspan="2"
                                        class="text-right py-4 px-3 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-t border-grey-light">
                                        @if (session()->get('total') > 150)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Envío gratis
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Envío (MXN): $5
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if (session()->get('total') !== null && session()->get('total') !== 0 && session()->get('phase') == 0)
            <style>
                .btncustom {
                    background-color: #02c4ad;
                    border-color: #00ab98;
                }

                .btncustom:hover {
                    background-color: #00e4ca;
                }

            </style>
            <div class="flex justify-center py-4">
                <button wire:click="guardarPedido"
                    class="btncustom focus:outline-none text-white text-md py-2.5 px-5 border-b-4 border-green-600 rounded-md  hover:bg-green-400"
                    style="">
                    Listo, terminar compra
                </button>
            </div>
        @endif

        <div class="flex justify-center">
            @if (session()->get('contador') == -1 && session()->get('phase') >= 1)
                <div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Oops...
                        </div>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                            No puedes comprar...</p>
                        <p class="mt-2 text-gray-500">
                            Tu cuenta está bloqueada porque ha rebasado los 3 strikes por cancelación de
                            pedidos.
                        </p>
                    </div>
                </div>

            @elseif (session()->get('contador') == 0 && session()->get('phase') >= 1)

                <div class="animate-pulse" wire:poll.3s>
                    <div class=" p-8 text-center">
                        <div class="uppercase tracking-wide text-sm text-green-700 font-semibold">
                            Procesando...
                        </div>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                            Estamos
                            asignándote un repartidor</p>
                        <p class="mt-2 text-gray-500">
                            No tardaremos mucho, espera a que te asignemos uno.
                        </p>
                    </div>
                </div>

            @elseif (session()->get('contador') > 0 && session()->get('phase') >= 1)

                <div>
                    <div class="p-8 text-center">
                        <div class="uppercase tracking-wide text-lg text-green-500 font-semibold">Contacta
                            a
                            nuestro
                            repartidor</div>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                            {{ session()->get('repartidor')['usuario']['user']['name'] }}</p>
                        <p class="mt-2 text-gray-500">
                        <ul>
                            <li>
                                Teléfono: {{ session()->get('repartidor')['usuario']['telefono'] }}
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>


            @endif
        </div>

        <div wire:poll.3s>
            
            @if (session()->get('phase') == 2 || session()->get('phase') == -1)
                <div class="p-20 text-center" style="background-color: greenyellow">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-bold mb-2 text-gray-800">Estado de tu pedido</h2>
                        <p class="text-gray-700">

                            @if ($estatus_pedido == 5)
                                ¡Ya llegamos! El repartidor te entregará tus productos.
                            @elseif ($estatus_pedido == 4)
                                El repartidor ha reportado una anomalía. Un asesor te brindará apoyo.
                            @elseif ($estatus_pedido == 3)
                                ¡Ya vamos en camino! En unos minutos llegaremos a tu ubicación.
                            @elseif ($estatus_pedido == 2)
                                El pedido ha sido cancelado y se te ha puesto un strike. ¡No llegues a tres o serás
                                sancionado/a! <br>
                                <button wire:click="cerrarEstado"
                                    class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                                    Listo
                                </button>
                            @elseif ($estatus_pedido == 1)
                                ¡Gracias por confiar en nosotros! Nos vemos en tu siguiente compra. <br>

                                <button wire:click="terminar"
                                    class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                                    Listo
                                </button>

                            @elseif ($estatus_pedido == 0)
                                Estamos preparando tu pedido...
                            @endif
                        </p>
                    </div>
                </div>
            @endif
        </div>

        @if (session()->get('phase') == 1 || session()->get('phase') == 2)
               
            @if ($cancelado == null)
                <div class="flex justify-center py-4">
                    <button wire:click="cancelarPedido"
                        class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                        Cancelar mi pedido
                    </button>
                </div>
            @endif

        @endif

    </div>
</div>
