<div>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('TIENDAS') }}
            </h2>
        </x-slot>

        <div class="py-2">
            <div class="flex justify-center">
                <div>
                    <div class="container mx-auto content-center">
                        <div class="sm:mt-0 content-center">
                            <div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form wire:submit.prevent="save">
                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-6 gap-6">
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="nombre"
                                                            class="block text-sm font-medium text-gray-700">Nombre</label>
                                                        <input type="text" wire:model="almacen.nombre" name="nombre"
                                                            id="nombre" autocomplete="given-name"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('almacen.nombre')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="ubicacion"
                                                            class="block text-sm font-medium text-gray-700">Ubicación</label>
                                                        <input type="text" wire:model="almacen.ubicacion"
                                                            name="ubicacion" id="ubicacion" autocomplete="given-name"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('almacen.ubicacion')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="capacidad"
                                                            class="block text-sm font-medium text-gray-700">Capacidad</label>
                                                        <input type="number" step="1" wire:model="almacen.capacidad"
                                                            name="capacidad" id="capacidad" autocomplete="given-name"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('almacen.capacidad')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="administrador"
                                                            class="block text-sm font-medium text-gray-700">Administrador</label>
                                                        <select id="administrador" wire:model="almacen.id_administrador"
                                                            name="administrador" autocomplete="proveedor"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="e">--Seleccionar--</option>
                                                            @foreach ($administradores as $administrador)
                                                                <option value="{{ $administrador->id }}">
                                                                    {{ $administrador->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('almacen.id_administrador')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-span-6 sm:col-span-3">
                                                        <label for="administrador"
                                                            class="block text-sm font-medium text-gray-700">Estatus</label>
                                                        <select id="administrador" wire:model="almacen.activo"
                                                            name="estatus" autocomplete="proveedor"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option value="e">--Seleccionar--</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select>
                                                        @error('almacen.activo')
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
        </div>
    </div>

</div>
