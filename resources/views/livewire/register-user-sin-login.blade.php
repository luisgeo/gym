<x-guest-layout>

    <div class="py-2">
        <div class="container mx-auto content-center">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form method="POST" action="{{route('usuario-not-registered.new')}}">
                            {{ csrf_field() }}
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de usuario</label>
                                            <input type="text" wire:model="name" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :value="old('name')" required autofocus autocomplete="name">
                                            @error('name')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Número de teléfono</label>
                                            <input type="text" wire:model="phone" name="phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :value="old('phone')" required autofocus autocomplete="phone">
                                            @error('phone')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                                            <input type="password" wire:model="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :value="old('password')" required autofocus autocomplete="password">
                                            @error('password')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                                            <input type="password" wire:model="password_confirmation" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :value="old('password_confirmation')" required autofocus autocomplete="password_confirmation">
                                            @error('password_confirmation')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                                            <select id="rol" wire:model="rol" name="rol" autocomplete="rol" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option>--Seleccionar--</option>
                                                <option value="2" default>
                                                    Administrador
                                                </option>
                                                <option value="3">
                                                    Empleado
                                                </option>
                                            </select>
                                            @error('rol')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

</x-guest-layout>