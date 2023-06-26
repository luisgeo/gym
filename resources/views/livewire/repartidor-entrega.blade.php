<div>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight justify-between inline-block align-middle">
            {{ __('PEDIDO DE ' . Str::upper($pedidos[0]->compra->usuario->user->name))}}

        </h2>
    </x-slot>
    <br>
    @if (session()->get('phase') == -2)
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="md:flex justify-between">
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Sobre nuestro
                        cliente</div>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                        {{ $pedidos[0]->compra->usuario->user->name }}</p>
                    <p class="mt-2 text-gray-500">
                    <ul>
                        <li>
                            Teléfono: {{ $pedidos[0]->compra->usuario->telefono }}
                        </li>
                        <li>
                            Correo electrónico: {{ $pedidos[0]->compra->usuario->user->email }}
                        </li>
                        <li>
                            {{ $pedidos[0]->compra->usuario->membresia > 0 ? 'Sí' : 'No' }} cuenta con membresía
                        </li>
                    </ul>
                    <br>
                    Total a pagar: ${{ $pedidos[0]->compra->total }}
                    </p>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Sobre la compra</div>
                    <div class="mr-2 mt-2">
                        <div class="inline-block align-middle">
                            <ul>
                                <li>
                                    Pagado: {{ $pedidos[0]->compra->pagado ? 'Sí' : 'No' }}
                                </li>
                                <li>
                                    Entregado: {{ $pedidos[0]->compra->estatus == 1 ? 'Sí' : 'No' }}
                                </li>
                                <li>
                                    Fecha: {{ $pedidos[0]->compra->fecha_pedido }}
                                </li>
                                @if ($pedidos[0]->compra->estatus == 2)
                                <li class="text-red-500">
                                    CANCELADA
                                </li>
                                @endif
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <br>
        <div class="bg-gray-200 flex justify-center items-center">
            <div class="max-w-2xl bg-white border-2 border-gray-300 p-5 rounded-md tracking-wide shadow-lg">
                <div id="header" class="flex">
                    <div id="body" class="flex flex-col ml-5">
                        <h4 id="name" class="text-xl font-semibold mb-2">Sobre nuestro repartidor</h4>
                        <p id="job" class="text-gray-800 mt-2">
                        <ul>
                            <li>
                                Nombre: {{ $pedidos[0]->compra->repartidor->usuario->user->name }}
                            </li>
                            <li>
                                Teléfono: {{ $pedidos[0]->compra->repartidor->usuario->telefono }}
                            </li>
                            <li>
                                Correo electrónico: {{ $pedidos[0]->compra->repartidor->usuario->user->email }}
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">

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
                                            Cantidad
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($pedidos) == 0)
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-4 whitespace-nowrap text-red-600 text-center">
                                                No hay pedidos todavía.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($pedidos as $pedido)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $pedido->producto->nombre }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $pedido->producto->marca }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pedido->cantidad }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2 ">
                    Éxito
                </div>
                <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            </div>
        @endif
        <div wire:poll.3s class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="md:flex justify-between">
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Sobre nuestro
                        cliente</div>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">
                        {{ $pedidos[0]->compra->usuario->user->name }}</p>
                    <p class="mt-2 text-gray-500">
                    <ul>
                        <li>
                            Teléfono: {{ $pedidos[0]->compra->usuario->telefono }}
                        </li>
                        <li>
                            Correo electrónico: {{ $pedidos[0]->compra->usuario->user->email }}
                        </li>
                        <li>
                            {{ $pedidos[0]->compra->usuario->membresia > 0 ? 'Sí' : 'No' }} cuenta con membresía
                        </li>
                    </ul>
                    <br>
                    Total a pagar: ${{ $pedidos[0]->compra->total }}
                    </p>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                        Acciones del repartidor
                    </div>
                    @if ($repartidor->estatus == -1)
                        <div class="mr-2 mt-2">
                            <div class="inline-block align-middle">
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                                    role="alert">
                                    <div class="flex">
                                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                            </svg></div>
                                        <div>
                                            <p class="font-bold">Has solicitado ayuda</p>
                                            <p class="text-sm">Uno de nuestros administradores te brindará soporte
                                                inmediatamente.</p>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" wire:click="continuar"
                                    class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    Recibí ayuda, continuar
                                </button>
                            </div>

                        </div>
                    @else
                        @if (session()->get('phase') == 1)
                            <div class="mr-2 mt-2">
                                <div class="inline-block align-middle">
                                    <button type="button" wire:click="llegada"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        Llegué al destino
                                    </button>
                                    <br>
                                    <button type="button" wire:click="anomalia"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                        </svg>
                                        Necesito ayuda
                                    </button>
                                </div>

                            </div>

                        @elseif(session()->get('phase') == 2)
                            <div class="mr-2 mt-2">
                                <div class="inline-block align-middle">
                                    <button type="button" wire:click="entrega"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        Entregué productos
                                    </button>

                                    <br>
                                    <button type="button" wire:click="anomalia"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                        </svg>
                                        Necesito ayuda
                                    </button>
                                </div>

                            </div>
                        @elseif(session()->get('phase') == 3)
                            <div class="mr-2 mt-2">
                                <div class="inline-block align-middle">
                                    <div>
                                        <form wire:submit.prevent="calcularCambio">
                                            <div class="flex justify-center">
                                                <input type="number" wire:model="cantidad"
                                                    placeholder="Ingresa cantidad pagada y da clic en calcular"
                                                    class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                                                <button type="submit"
                                                    class="focus:outline-none text-white text-sm py-2 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg flex items-center">
                                                    Calcular
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                    Debes dar <b>${{ session()->get('cambio') }}</b> de cambio
                                    <br>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('repartidor.ticket', $compra->id_compra) }}"
                                            target="_blank"
                                            class="focus:outline-none text-white text-center text-sm py-2.5 px-5 rounded-md bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">
                                            Imprimir ticket
                                        </a>

                                        <button type="button" wire:click="pagado"
                                            class="focus:outline-none text-white text-center text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            Terminar venta
                                        </button>
                                    </div>
                                    <br>
                                    <button type="button" wire:click="anomalia"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                        </svg>
                                        Necesito ayuda
                                    </button>
                                </div>

                            </div>
                        @elseif(session()->get('phase') == 4)
                            <div class="mr-2 mt-2">
                                <div class="inline-block align-middle">
                                    @if ($tiene_mas_pedidos)
                                        <button type="button" wire:click="volverAPedidos"
                                            class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg flex items-center">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            Volver a mis pedidos
                                        </button>
                                    @else
                                        <button type="button" wire:click="tienda"
                                            class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            Llegué a la tienda
                                        </button>
                                    @endif

                                    <br>
                                    <button type="button" wire:click="anomalia"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                        </svg>
                                        Necesito ayuda
                                    </button>
                                </div>
                            </div>
                        @elseif(session()->get('phase') == 5)
                            <div class="mr-2 mt-2">
                                <div class="inline-block align-middle">
                                    <button type="button" wire:click="base"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        Llegué a la base
                                    </button>
                                    <br>
                                    <button type="button" wire:click="anomalia"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                        </svg>
                                        Necesito ayuda
                                    </button>
                                </div>

                            </div>
                        @elseif(session()->get('phase') == -1)
                            <div class="mr-2 mt-2">
                                <div class="inline-block align-middle">
                                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                                        role="alert">
                                        <div class="flex">
                                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                                </svg></div>
                                            <div>
                                                <p class="font-bold">Has solicitado ayuda</p>
                                                <p class="text-sm">Uno de nuestros administradores te brindará soporte
                                                    inmediatamente.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" wire:click="continuar"
                                        class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        Recibí ayuda, continuar
                                    </button>
                                </div>

                            </div>
                        @else
                            <div class="flex justify-center">
                                <button type="button" wire:click="enCamino"
                                    class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    Iniciar entrega
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        @if (session()->get('phase') == 4)
            <br>
            <div class="border border-light-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                <div class="animate-pulse flex space-x-4">
                    <div class="rounded-full bg-green-600 h-12 w-12 text-white p-2.5">Bye!</div>
                    <div class="flex-1 space-y-3 py-1">
                        <div class="h-4 bg-green-400 rounded w-5/6 text-xs px-2 text-gray-10">
                            Agradece al cliente por su compra.
                        </div>
                        <div class="h-4 bg-green-300 rounded w-3/4 text-xs px-2 text-gray-10">
                            Despídete de nuestro cliente.
                        </div>
                        <div class="h-4 bg-green-200 rounded text-xs px-2 text-gray-10">
                            Regresa a la tienda y deja la ganancia.
                        </div>
                        <div class="h-4 bg-green-100 rounded w-2/4 text-xs px-2 text-gray-10">
                            Regresa a la base.
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                                            Cantidad
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($pedidos) == 0)
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-4 whitespace-nowrap text-red-600 text-center">
                                                No hay pedidos todavía.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($pedidos as $pedido)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                           
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $pedido->producto->nombre }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $pedido->producto->marca }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pedido->cantidad }}
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
    @endif
</div>
