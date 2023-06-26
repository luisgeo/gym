<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Levantar una queja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto content-center">
            <div class="mt-10 sm:mt-0 content-center">
                <div class="md:grid md:grid-cols-3 md:gap-6 ">
                    {{$errors}}
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form wire:submit.prevent="save" method="POST">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="mensaje"
                                                class="block text-sm font-medium text-gray-700">Mensaje</label>
                                            <input type="text" wire:model="mensaje" name="mensaje" id="mensaje"
                                                autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Enviar queja
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
