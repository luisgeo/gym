<div>
    <div>
        <x-slot name="header">
            <div class="flex inline-block justify-between align-middle">
                <div class=" flex flex-wrap content-center ">
                    <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('REPARTIR PRODUCTOS') }}
                    </h2>
                </div>
                <div>
                    <a href="{{ route('productos.new') }}">
                        <svg height="40px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            <title>Repartir productos</title>
                        </svg>
                    </a>
                </div>
            </div>
        </x-slot>

        <div>
            @if (session()->has('message'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Atención: </strong>
                    <span class="block sm:inline">{{ session('message') }}</span>
                    <button wire:click="cerrarAlerta()">
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-blue-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
            <div class="md:flex md:justify-between md:items-center py-4">
                <div class="relative text-gray-600 flex items-center justify-center">
                    <input type="search" wire:model="buscar" name="search" placeholder="Realiza tu búsqueda..."
                        class="bg-white h-10 px-5 pr-10 rounded-full text-sm w-full">
                    <button disabled class="relative top-0 right-8">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                            y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                            xml:space="preserve" width="512px" height="512px">

                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>

                </div>

                <div class="bg-white shadow-md text-lg py-2 px-4 font-bold rounded-md">
                    Total de inversión: <span class="text-yellow-500">${{number_format($suma_total, 2)}}</span>
                </div>

            </div>
            <div>
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                <form method="POST" action="{{ route('productos.repartir.post') }}">
                                    @csrf
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Nombre
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Repartir
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @if (count($productos) == 0)
                                                <tr>
                                                    <td colspan="3"
                                                        class="px-6 py-4 whitespace-nowrap text-red-600 text-center">
                                                        No hay productos para mostrar.
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($productos as $producto)
                                                    <tr
                                                        class="{{ $producto->stock <= 10 ? 'bg-yellow-100' : ($producto->stock <= 5 ? 'bg-red-200' : '') }}">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <img src="/{{ $producto->imagen ?? 'default.svg' }}"
                                                                width="
                                                                50px"
                                                                class="rounded-full border-2 border-gray-500 mr-2">

                                                                <div
                                                                    class="font-medium text-gray-900 inline-block uppercase">
                                                                    <div class="text-lg">
                                                                        {{ trim(substr($producto->descripcion, 0, 27)) . (strlen($producto->descripcion) >= 27 ? '...' : '') }}
                                                                    </div>
                                                                    <div class="text-md text-gray-500 font-medium">
                                                                        {{ $producto->nombre }}</div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            <div>
                                                                <div
                                                                    class="text-sm font-medium text-gray-900 flex items-center">
                                                                    <div>
                                                                        <label class="block text-blue-400 font-bold"
                                                                            for="producto[{{ $producto->id_producto }}][stock]">A.
                                                                            General</label>
                                                                        <input type="number"
                                                                            class="w-20 border-blue-400"
                                                                            name="producto[{{ $producto->id_producto }}][stock]"
                                                                            id="producto[{{ $producto->id_producto }}][stock]"
                                                                            value="{{ old('producto.' . $producto->id_producto . '.stock') ?? $producto->stock }}">
                                                                        @error('producto.' . $producto->id_producto .
                                                                            '.stock')
                                                                            <div class="text-red-600">
                                                                                {{ $errors->first() }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="pl-4">
                                                                        <label class="block text-green-400 font-bold"
                                                                            for="producto[{{ $producto->id_producto }}][cantidad]">Repartir</label>
                                                                        <input type="number"
                                                                            class="w-20 border-green-400"
                                                                            name="producto[{{ $producto->id_producto }}][cantidad]"
                                                                            id="producto[{{ $producto->id_producto }}][cantidad]"
                                                                            value="{{ old('producto.' . $producto->id_producto . '.cantidad') ?? 0 }}">
                                                                    </div>
                                                                    <div class="pl-4">
                                                                        <div class="flex items-center">
                                                                            <label class="block text-blue-400 font-bold"
                                                                                for="stock">Stock</label>

                                                                            <label
                                                                                class="block text-green-400 font-bold pl-16"
                                                                                for="producto[{{ $producto->id_producto }}][almacenes][{{ $producto->repartos->first()->id_almacen }}]">Piezas</label>
                                                                        </div>

                                                                        @foreach ($producto->repartos as $reparto)
                                                                            @if ($reparto->almacen->activo != '0')
                                                                                <input name="stock"
                                                                                    class="w-20 border-blue-400 text-right"
                                                                                    readonly disabled type="text"
                                                                                    value="{{ $reparto->stock }}">
                                                                                <span class="text-lg">+</span>


                                                                                <input class="w-20 border-green-400"
                                                                                    type="number"
                                                                                    name="producto[{{ $producto->id_producto }}][almacenes][{{ $reparto->id_almacen }}]"
                                                                                    id="producto[{{ $producto->id_producto }}][almacenes][{{ $reparto->id_almacen }}]"
                                                                                    value="{{ old('producto.' . $producto->id_producto . '.almacenes.' . $reparto->id_almacen) ?? 0 }}">

                                                                                {{ $reparto->almacen->nombre }}
                                                                                @error('producto.' .
                                                                                    $producto->id_producto . '.almacenes.' .
                                                                                    $reparto->id_almacen)
                                                                                    <div class="text-red-600">
                                                                                        {{ $errors->first() }}
                                                                                    </div>
                                                                                @enderror
                                                                                <br>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>

                                                                    {{-- <div>
                                                                        Restantes: {{$producto->stock - $producto->sumRepartos()}}
                                                                    </div> --}}
                                                                </div>
                                                                @error('producto.' . $producto->id_producto .
                                                                    '.cantidad')
                                                                    <div class="text-red-600 pt-2">
                                                                        {{ $errors->first() }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        <td class="pr-6">
                                                            <div class="flex items-center">
                                                                <div>
                                                                    <label
                                                                        class="block text-yellow-400 font-bold">Inversión</label>

                                                                    @foreach ($producto->repartos as $reparto)
                                                                        @if ($reparto->almacen->activo != '0')
                                                                            <input name="stock"
                                                                                class="w-32 border-yellow-400 text-right"
                                                                                readonly disabled type="text"
                                                                                value="${{ number_format($reparto->stock * $producto->precio, 2) }}">

                                                                            <br>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <div class="flex items-center">
                                                                    <span class="text-lg px-2 pt-4">+</span>
                                                                    <div>
                                                                        <label
                                                                            class="block text-yellow-400 font-bold">A.
                                                                            General </label>
                                                                        <input type="text"
                                                                            class="w-32 border-yellow-400"
                                                                            value="${{ number_format($producto->stock * $producto->precio, 2) }}">
                                                                    </div>
                                                                </div>
                                                                <span class="text-lg px-2 pt-4">=</span>
                                                                <div>
                                                                    <label
                                                                        class="block text-blue-400 font-bold">Total</label>
                                                                    <input readonly disabled type="text"
                                                                        class="w-32 border-blue-400"
                                                                        value="${{ number_format(($producto->stock_suma + $producto->stock) * $producto->precio, 2) }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <button type="submit"
                                        class="fixed z-90 uppercase font-bold bottom-10 right-8 bg-blue-500 p-4 rounded-md drop-shadow-lg flex justify-center items-center text-white text-lg hover:bg-blue-700">
                                        Guardar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
