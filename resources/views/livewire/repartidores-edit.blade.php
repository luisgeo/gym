<div>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Caja') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <!--
      This example requires Tailwind CSS v2.0+ 
      
      This example requires some changes to your config:
      
      ```
      // tailwind.config.js
      module.exports = {
        // ...
        plugins: [
          // ...
          require('@tailwindcss/forms'),
        ]
      }
      ```
    -->



            <div class="container mx-auto content-center">
                <div class="mt-10 sm:mt-0 content-center">
                    <div class="md:grid md:grid-cols-3 md:gap-6 ">

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form wire:submit.prevent="save">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="ubicacion"
                                                    class="block text-sm font-medium text-gray-700">Ubicación</label>
                                                <input type="text" wire:model="repartidor.ubicacion" name="ubicacion"
                                                    id="ubicacion" autocomplete="given-name"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="estatus"
                                                    class="block text-sm font-medium text-gray-700">Estatus</label>
                                                <select id="estatus" wire:model="repartidor.estatus" name="estatus"
                                                    autocomplete="estatus"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option>--Seleccionar--</option>
                                                    <option value="1">Ocupado</option>
                                                    <option value="0">Desocupado</option>
                                                </select>
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
