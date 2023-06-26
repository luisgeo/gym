<div>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Caja') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="container mx-auto content-center">
                <div class="mt-10 sm:mt-0 content-center">
                    <div class="md:grid md:grid-cols-3 md:gap-6 ">

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form wire:submit.prevent="save">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="almacen"
                                                    class="block text-sm font-medium text-gray-700">Almacén</label>
                                                <select id="almacen" wire:model="caja.id_almacen" name="almacen"
                                                    autocomplete="almacen"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option>--Seleccionar--</option>
                                                    @foreach ($almacenes as $almacen)
                                                        <option value="{{ $almacen->id_almacen }}">
                                                            {{ $almacen->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('caja.id_almacen')
                                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="abierta"
                                                    class="block text-sm font-medium text-gray-700">Estatus</label>
                                                <select id="abierta" wire:model="caja.abierta" name="abierta"
                                                    autocomplete="abierta"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option>--Seleccionar--</option>
                                                    <option value="1">Abierta</option>
                                                    <option value="0">Cerrada</option>
                                                </select>
                                                @error('caja.abierta')
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
