<div>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight justify-between inline-block align-middle">
            {{ __('MIS PEDIDOS') }}
        </h2>
    </x-slot>
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
    <div class="py-12" wire:poll.2s>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Productos
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total a cobrar
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pagado
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ver lista
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($pedidos) == 0)
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-blue-600 text-center">
                                            No hay pedidos.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $pedido->usuario->user->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $pedido->usuario->user->email }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $pedido->usuario->telefono }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ count($pedido->pedidos) }} pedidos.
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                ${{ $pedido->total }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $pedido->pagado == 'true' ? 'Pagado' : 'No pagado' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if (!$pedido->pagado)
                                                    <a href="{{ route('ver.entrega', $pedido->id_compra) }}"
                                                        class="text-blue-600 hover:text-blue-900">
                                                        <svg height="40px" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth={2}
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="{{ route('repartidor.detalle.compra', $pedido->id_compra) }}"
                                                        class="text-blue-600 hover:text-blue-900">
                                                        <svg height="40px" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth={2}
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                @endif
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
</div>
