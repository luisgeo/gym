@if ($completado)
    <div>
        Ya completaste tu registro. Gracias.
    </div>
@else
    <div>
        <div class="py-2">
            <div class="container mx-auto content-center">
                <div class="mt-10 sm:mt-0 content-center">
                    <div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form wire:submit.prevent="save" method="POST">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="cp" class="block text-sm font-medium text-gray-700">Código
                                                    Postal</label>
                                                <input type="number" wire:model="usuario.cp" name="cp" id="cp"
                                                    autocomplete="given-name"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                @error('usuario.cp')
                                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="telefono"
                                                    class="block text-sm font-medium text-gray-700">Teléfono de
                                                    contacto</label>
                                                <input type="text" wire:model="usuario.telefono" name="telefono"
                                                    id="telefono" autocomplete="given-name"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                @error('usuario.telefono')
                                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>



                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <button type="submit"
                                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Guardar datos
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
@endif
