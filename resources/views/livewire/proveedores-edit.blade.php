<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proveedores') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="container mx-auto content-center">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6 ">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form wire:submit.prevent="save" method="POST">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="nombre"
                                                class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" wire:model="proveedor.nombre" name="nombre" id="nombre"
                                                autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('proveedor.nombre')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="ubicacion"
                                                class="block text-sm font-medium text-gray-700">Ubicacion</label>
                                            <input type="text" wire:model="proveedor.ubicacion" name="ubicacion"
                                                id="ubicacion" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('proveedor.ubicacion')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="telefono"
                                                class="block text-sm font-medium text-gray-700">Teléfono</label>
                                            <input type="text" wire:model="proveedor.telefono" name="telefono"
                                                id="telefono" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('proveedor.telefono')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="estatus"
                                                class="block text-sm font-medium text-gray-700">Estatus</label>
                                            <select id="estatus" wire:model="proveedor.estatus" name="estatus"
                                                autocomplete="proveedor"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="e">--Seleccionar--</option>
                                                <option value="1">Disponible</option>
                                                <option value="0">No disponible</option>
                                            </select>
                                            @error('proveedor.estatus')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
