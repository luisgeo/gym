<div>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight justify-between inline-block align-middle">
            {{ __('MIS ESTADÍSTICAS') }}
            <div>
                Strikes: {{ $strikes }}
            </div>
        </h2>

    </x-slot>
    <div class="sm:flex sm:justify-center sm:gap-4">

        <div class="py-12">

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" colspan="2"
                                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                            TUS PEDIDOS
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col"
                                            class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Detalle
                                        </th>
                                        <th scope="col"
                                            class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Queja
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($pedidos) == 0)
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 whitespace-nowrap text-center">
                                                ¡Haz tu primer pedido!
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($pedidos as $pedido)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-stretch justify-center inline-block">
                                                        <a href="{{ route('cliente.detalle.compra', $pedido->id_compra) }}"
                                                            class="self-center focus:outline-none text-white text-sm py-1 px-5 border-b-4 border-green-600 rounded-md bg-green-500 hover:bg-green-400">
                                                            {{ $pedido->fecha_pedido }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-stretch justify-center inline-block">
                                                        @if ($pedido->queja != null)
                                                            <button disabled
                                                                href="{{ route('cliente.queja', $pedido->id_compra) }}"
                                                                class="self-center focus:outline-none text-white text-sm py-1 px-5 border-b-4 border-gray-600 rounded-md bg-gray-500 hover:bg-gray-400">
                                                                Queja
                                                            </button>
                                                        @else
                                                            <a href="{{ route('cliente.queja', $pedido->id_compra) }}"
                                                                class="self-center focus:outline-none text-white text-sm py-1 px-5 border-b-4 border-red-600 rounded-md bg-red-500 hover:bg-red-400">
                                                                Queja
                                                            </a>
                                                        @endif
                                                    </div>
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

        <div class="py-12">

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" colspan="3"
                                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                            QUEJAS
                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pedido
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mensaje
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($quejas) == 0)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-center" colspan="3">
                                                No hay quejas.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($quejas as $queja)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $queja->compra->fecha_pedido }}
                                                            </div>
                                                            @if ($queja->estatus == 0)
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                    Sin atender
                                                                </span>
                                                            @elseif ($queja->estatus == 1)
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                    Atendido
                                                                </span>
                                                            @elseif ($queja->estatus == 2)
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                    En proceso
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $queja->mensaje }}
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
</div>
