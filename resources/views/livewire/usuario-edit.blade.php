<div>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight justify-between inline-block align-middle">
            {{ __('USUARIOS') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="container content-center">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form wire:submit.prevent="save">

                            {{ csrf_field() }}
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre
                                                de usuario</label>
                                            <input value="{{ $usuario->name }}" type="text" wire:model="user.name"
                                                name="name" id="name"
                                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                :value="old('name')" required autofocus autocomplete="name">
                                            @error('user.name')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">

                                            {{-- 
                                            <div x-data="{ value: 'unset', offValue: 'Off', onValue: 'On' }">
                                                <div class="flex items-center m-2 cursor-pointer cm-toggle-wrapper">
                                                    <span class="font-semibold text-gray-700 text-sm">Cambiar teléfono<span class="font-bold"
                                                            x-text="value" /></span>
                                                </div>

                                                <div class="flex items-center m-2 cursor-pointer cm-toggle-wrapper"
                                                    x-on:click="value =  (value == onValue ? offValue : onValue);">
                                                    <span class="font-semibold text-xs mr-1">
                                                        Off
                                                    </span>
                                                    <div class="rounded-full w-8 h-4 p-0.5 bg-gray-300"
                                                        :class="{
                                                            'bg-red-500': value == offValue,
                                                            'bg-green-500': value ==
                                                                onValue
                                                        }">
                                                        <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out"
                                                            :class="{
                                                                '-translate-x-2': value ==
                                                                    offValue,
                                                                'translate-x-2': value == onValue
                                                            }">
                                                        </div>
                                                    </div>
                                                    <span class="font-semibold text-xs ml-1">
                                                        On
                                                    </span>
                                                </div>
                                            </div> --}}
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Número
                                                de teléfono</label>
                                            <input type="text" wire:model="user.phone" name="phone" id="phone"
                                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                :value="old('phone')" required autofocus autocomplete="phone">
                                            @error('user.phone')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="rol"
                                                class="block text-sm font-medium text-gray-700">Rol</label>
                                            <select id="rol" wire:model="user.rol" name="rol"
                                                autocomplete="rol"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">--Seleccionar--</option>
                                                <option value="2">
                                                    Administrador
                                                </option>
                                                <option value="3">
                                                    Empleado
                                                </option>
                                            </select>
                                            @error('user.rol')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
