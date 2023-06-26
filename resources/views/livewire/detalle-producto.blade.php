<div>
    <div >
        <div class="flex justify-center  h-screen w-screen">
            <dialog open class="rounded-2xl overflow-hidden p-0 w-auto max-w-7xl md:mx-auto md:w-2/3 shadow-lg m-8">
                <div class="flex flex-col lg:flex-row">
                    <div class="relative h-64 sm:h-80 w-full lg:h-auto lg:w-1/3 xl:w-2/5 flex-none">
                      
                        <span
                            class="absolute block inset-x-0 bottom-0 lg:hidden lg:inset-y-0 lg:right-auto bg-gradient-to-t lg:bg-gradient-to-r from-white to-transparent w-full h-16 lg:h-full lg:w-16"></span>
                        @if ($producto->descuento != 0)
                            <div
                                class="relative flex justify-end lg:justify-start flex-wrap text-white text-xl font-bold m-4">
                                <div class="bg-yellow-500 px-4 py-1 rounded">Oferta</div>
                            </div>
                        @endif

                    </div>
                    <div class="w-full">
                        <div class="p-8">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold mb-2">
                                    {{ $producto->nombre }}
                                </h3>
                                <b class="text-xl">
                                    Precio:
                                    @if ($producto->descuento != 0)
                                        <span style="text-decoration: line-through" class="text-yellow-500 text-xl">
                                            ${{ $producto->precio }}
                                        </span>
                                        <span class="text-green-600 text-xl">
                                            ${{ $producto->precio - ($producto->precio * $producto->descuento) / 100 }}
                                        </span>
                                    @else
                                        <span class="text-green-600 text-xl">
                                            ${{ $producto->precio }}
                                        </span>
                                    @endif
                                </b>

                            </div>
                            <div class="py-3">

                                @if ($producto->stock == 0)
                                    <span class="text-red-500 text-xl">No disponible</span>
                                @else
                                    <span class="text-green-500 text-xl">Disponibles: {{ $producto->stock }}</span>
                                @endif
                            </div>

                            <div class="relative">
                                <div class="border p-2 h-20 overflow-y-auto rounded-b-xl rounded-tr-xl">
                                    <div>
                                        <p class="text-sm text-gray-500 line-clamp-3">
                                            Descripción: {{ $producto->descripcion }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- action buttons -->
                            <div class="flex justify-end items-center text-sm font-bold mt-8 gap-4">
                                <button wire:click="agregar({{ $producto->id_producto }})"
                                    class="text-blue-700 border border-blue-300 hover:border-blue-700 px-4 py-1 rounded">Agregar
                                    al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            </dialog>
        </div>
    </div>
</div>
