<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CLIENTE') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="container mx-auto content-center">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6 ">
                    <div class="mt-5 md:mt-6 md:col-span-2">
                        <form wire:submit.prevent="save" method="POST">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-6 text-xl font-bold">
                                            {{ mb_strtoupper('Datos personales') }}
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="nombre"
                                                class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" wire:model="cliente.nombre" name="nombre"
                                                id="nombre" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.nombre')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="telefono"
                                                class="block text-sm font-medium text-gray-700">Teléfono</label>
                                            <input type="text" wire:model="cliente.telefono" name="telefono"
                                                id="telefono" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.telefono')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="correo" class="block text-sm font-medium text-gray-700">Correo
                                                electrónico</label>
                                            <input type="text" wire:model="cliente.correo" name="correo"
                                                id="correo" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.correo')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="acumulado"
                                                class="block text-sm font-medium text-gray-700">Puntos
                                                acumulados</label>
                                            <input type="text" name="acumulado" id="acumulado"
                                                value="{{ $cliente->acumulado ?? 0.0 }}" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.acumulado')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="direccion"
                                                class="block text-sm font-medium text-gray-700">Dirección</label>
                                            <input type="text" name="direccion" id="direccion"
                                                value="{{ $cliente->direccion }}" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.direccion')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="fechanac" class="block text-sm font-medium text-gray-700">Fecha
                                                de nacimiento</label>
                                            <input type="date" name="fechanac" id="fechanac"
                                                value="{{ $cliente->fechanac }}" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.fechanac')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="fechainsc" class="block text-sm font-medium text-gray-700">Fecha
                                                de inscripción</label>
                                            <input type="date" name="fechainsc" id="fechainsc"
                                                value="{{ $cliente->fechanac }}" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.fechainsc')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="edad"
                                                class="block text-sm font-medium text-gray-700">Edad</label>
                                            <input type="number" name="edad" id="edad"
                                                value="{{ $cliente->edad ?? 0.0 }}" autocomplete="given-name"
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('cliente.edad')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="estatus"
                                                class="block text-sm font-medium text-gray-700">Estatus</label>
                                            <select id="estatus" wire:model="cliente.estatus" name="estatus"
                                                autocomplete="cliente"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="e">--Seleccionar--</option>
                                                <option value="1">Disponible</option>
                                                <option value="0">No disponible</option>
                                            </select>
                                            @error('cliente.estatus')
                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.plan" class="text-sm font-medium text-gray-700">Tipo de
                                                plan</label>
                                            <div name="div.plan" id="div.plan" class="mt-1">
                                                <input type="radio" name="plan" id="plan"
                                                    autocomplete="given-name"> GYM Pass Básico <br>
                                                <input type="radio" name="plan" id="plan"
                                                    autocomplete="given-name"> GYM Pass Intermedio <br>
                                                <input type="radio" name="plan" id="plan"
                                                    autocomplete="given-name"> GYM Pass Pro
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3"></div>

                                        <div class="col-span-6 sm:col-span-6 text-xl font-bold pt-4">
                                            {{ mb_strtoupper('Antecedentes médicos') }}
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.alergico" class="text-sm font-medium text-gray-700">¿Es
                                                alérgico/a a algún suplemento?</label>
                                            <div name="div.alergico" id="div.alergico" class="mt-1">
                                                <input type="radio" name="alergico" id="alergico"
                                                    wire:model="antecedente.alergico" value="1"
                                                    autocomplete="given-name"> Sí
                                                <input type="radio" name="alergico" id="alergico"
                                                    wire:model="antecedente.alergico" value="0"
                                                    autocomplete="given-name"> No
                                            </div>
                                            <input class="mt-2 text-sm w-full" type="text"
                                                wire:model="antecedente.alergico_expl"
                                                placeholder="En caso afirmativo, describa brevemente...">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.lesion" class="text-sm font-medium text-gray-700">¿Ha
                                                tenido o tiene alguna lesión muscular?</label>
                                            <div name="div.lesion" id="div.lesion" class="mt-1">
                                                <input type="radio" name="lesion" id="lesion"
                                                    wire:model="antecedente.lesion" autocomplete="given-name"> Sí
                                                <input type="radio" name="lesion" id="lesion"
                                                    wire:model="antecedente.lesion" autocomplete="given-name"> No
                                            </div>
                                            <input class="mt-2 text-sm w-full" type="text"
                                                wire:model="antecedente.lesion_expl"
                                                placeholder="En caso afirmativo, describa brevemente...">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.cardiovascular"
                                                class="text-sm font-medium text-gray-700">¿Padece alguna enfermedad
                                                cardiovascular?</label>
                                            <div name="div.cardiovascular" id="div.cardiovascular" class="mt-1">
                                                <input type="radio" name="cardiovascular" id="cardiovascular"
                                                    wire:model="antecedente.cardiovascular" autocomplete="given-name">
                                                Sí
                                                <input type="radio" name="cardiovascular" id="cardiovascular"
                                                    wire:model="antecedente.cardiovascular" autocomplete="given-name">
                                                No
                                            </div>
                                            <input class="mt-2 text-sm w-full" type="text"
                                                wire:model="antecedente.cardiovascular_expl"
                                                placeholder="En caso afirmativo, describa brevemente...">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.desmayo" class="text-sm font-medium text-gray-700">¿Ha
                                                sufrido algún desmayo?</label>
                                            <div name="div.desmayo" id="div.desmayo" class="mt-1">
                                                <input type="radio" name="desmayo" id="desmayo"
                                                    wire:model="antecedente.desmayo" autocomplete="given-name"> Sí
                                                <input type="radio" name="desmayo" id="desmayo"
                                                    wire:model="antecedente.desmayo" autocomplete="given-name"> No
                                            </div>
                                            <input class="mt-2 text-sm w-full" type="text"
                                                wire:model="antecedente.desmayo_expl"
                                                placeholder="En caso afirmativo, describa brevemente...">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.anemia" class="text-sm font-medium text-gray-700">¿Padece
                                                de anemia?</label>
                                            <div name="div.anemia" id="div.anemia" class="mt-1">
                                                <input type="radio" name="anemia" id="anemia"
                                                    wire:model="antecedente.anemia" autocomplete="given-name"> Sí
                                                <input type="radio" name="anemia" id="anemia"
                                                    wire:model="antecedente.anemia" autocomplete="given-name"> No
                                            </div>
                                            <input class="mt-2 text-sm w-full" type="text"
                                                wire:model="antecedente.anemia_expl"
                                                placeholder="En caso afirmativo, describa brevemente...">
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="div.pie_plano"
                                                class="text-sm font-medium text-gray-700">¿Tiene pie plano?</label>
                                            <div name="div.pie_plano" id="div.pie_plano" class="mt-1">
                                                <input type="radio" name="pie_plano" id="pie_plano"
                                                    wire:model="antecedente.pie_plano" autocomplete="given-name"> Sí
                                                <input type="radio" name="pie_plano" id="pie_plano"
                                                    wire:model="antecedente.pie_plano" autocomplete="given-name"> No
                                            </div>
                                            <input class="mt-2 text-sm w-full" type="text"
                                                wire:model="antecedente.pie_plano_expl"
                                                placeholder="En caso afirmativo, describa brevemente...">
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
