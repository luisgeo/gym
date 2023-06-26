<div>
    <br>
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
    <div class="flex justify-between py-4">
        <div class="relative text-gray-600">
            <input type="search" wire:model="buscar" name="search" placeholder="Busca un producto..."
                class="bg-white h-10 px-5 pr-20 rounded-full text-sm">
            <button disabled class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                    width="512px" height="512px">

                    <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="flex flex-wrap -mx-4 overflow-hidden" wire:poll.4s>
        @foreach ($productos as $producto)
            <div class="my-4 px-4 w-1/3 overflow-hidden">
                <a href="{{ route('cliente.detalle.producto', $producto->id_producto) }}">
                   
                </a>
                <div class="px-6 py-4">
                    <div>
                        <div class=" flex justify-center">
                            <button {{ $producto->stock <= 0 ? 'disabled' : '' }}
                                wire:click="agregar({{ $producto->id_producto }})"
                                class="flex inline-block px-3 py-3 text-sm font-semibold text-white uppercase transition-colors duration-200 transform bg-gray-800 rounded hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none">

                                <svg height="15px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <title>Agregar al carrito</title>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="hidden text-xs pl-1 sm:block">
                                    Agregar al carrito
                                </p>
                            </button>
                        </div>
                        <br>
                        <div class="flex justify-center">
                            <div class="font-bold text-xl mb-2 ">{{ $producto->nombre }}</div>


                        </div>
                        <div class="flex justify-center">
                            @if ($producto->stock <= 0)
                                <span
                                    class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-700 mr-2 mb-2">

                                    No disponible.

                                </span>
                            @else
                                <span
                                    class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-green-700 mr-2 mb-2">

                                    {{ $producto->stock }} disponible(s).

                                </span>
                            @endif
                        </div>

                        <div class="flex justify-center">
                            <p class="text-gray-700 text-base ">
                                <span
                                    class="inline-block bg-blue-200 font-bold rounded-full px-3 py-1 text-sm font-semibold text-blue-700 mr-2 mb-2">
                                    ${{ $producto->precio }}
                                </span>
                                @if ($producto->descuento != 0)
                                    <span
                                        class="inline-block bg-yellow-200 font-bold rounded-full px-3 py-1 text-sm font-semibold text-yellow-700 mr-2 mb-2">
                                        -{{ $producto->descuento }}%
                                    </span>
                                @endif
                            </p>
                        </div>


                    </div>

                </div>
            </div>
            <br>
        @endforeach
    </div>
    {{ $productos->links() }}
</div>
