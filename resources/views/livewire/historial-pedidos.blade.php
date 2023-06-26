<div>
    <x-slot name="header">
        <div class="flex inline-block justify-between align-middle">
            <div class=" flex flex-wrap content-center ">
                <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('HISTORIAL DE PEDIDOS') }}
                </h2>
            </div>
            <div>
                Has completado {{$total_pedidos}} pedido(s)
            </div>
        </div>
    </x-slot>

    <div>
        <div class="flex justify-between py-4">
            <div class="relative text-gray-600">
                <input type="search" wire:model="buscar" name="search" placeholder="Realiza tu búsqueda..."
                    class="bg-white h-10 px-5 pr-10 rounded-full text-sm">
                <button disabled class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                        xml:space="preserve" width="512px" height="512px">

                        <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex space-y-1.5">

        </div>

        <div wire:poll.2s>
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
                                            Usuario
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">hghg</span>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($compras) == 0)
                                        <tr>
                                            <td colspan="3"
                                                class="px-6 py-4 whitespace-nowrap text-center text-red-500">
                                                No hay pedidos.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($compras as $compra)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $compra->nombre_cliente }}
                                                </td>
                                                
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $compra->fecha_pedido }}
                                                </td>

                                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('repartidor.detalle.compra', $compra->id_compra) }}"
                                                        class="text-green-600 hover:text-green-900">
                                                        <svg height="40px" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth={2}
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            <title>Ver detalle de la compra</title>
                                                        </svg>
                                                    </a>
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
            {{ $compras->links() }}
        </div>
    </div>


</div>
