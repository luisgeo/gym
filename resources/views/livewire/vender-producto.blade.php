<div>
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script>
        function clickedFirstButton() {
            // console.log("SECOND HTML: " + document.getElementById('qr-reader').innerHTML);
            document.getElementById('qr-reader').getElementsByTagName('span')[0].innerHTML =
                "<span style='font-size: 14px'>Después selecciona tu cámara y da clic en \'Escanear\'</span>";

            console.log("SECOND HTML: " + document.getElementById('qr-reader').innerHTML);
            document.getElementById('qr-reader').getElementsByTagName('div')[0].getElementsByTagName('div')[0].innerHTML =
                "Por favor acepta los permisos para continuar..."
        }

        function onScanSuccess(decodedText, decodedResult) {
            @this.set('showNewClientModal', false);
            @this.set('buscar', decodedText);
            @this.set('scan', false);
            // Html5QrcodeScanner.clear();
            Html5QrcodeScanner.stop();
        }
    </script>
    @if (session()->has('message'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Atención: </strong>
            <span class="block sm:inline">{{ session('message') }}</span>
            <button wire:click="cerrarAlerta()">
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </button>
        </div>
        <br>
    @endif
    @if ($scan)
        <div style="position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 10000;"
            class="{{ $scan ? 'show' : 'hidden' }} bg-gray-800 bg-opacity-50">
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="flex items-center justify-center h-screen m-auto {{ $scan ? 'show' : 'hidden' }}">
                <div class="relative w-full max-w-md md:h-auto">
                    <!-- Modal content -->

                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" wire:click="closeScanQr"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-toggle="authentication-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
                                Escanear código de barras
                            </h3>
                        </div>

                        <div class="bg-white">
                            <div id="qr-reader" class="w-full"></div>
                            <script>
                                var html5QrcodeScanner = new Html5QrcodeScanner(
                                    "qr-reader", {
                                        fps: 10,
                                        qrbox: 250
                                    });
                                html5QrcodeScanner.render(onScanSuccess);

                                console.log("GENERATED HTML: " + document.getElementById('qr-reader').innerHTML);
                                // console.log("SECOND HTML: " + document.getElementById('qr-shaded-region').innerHTML);
                                document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('button')[0].innerHTML =
                                    "Continuar";
                                document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('button')[0].onclick =
                                    clickedFirstButton;

                                document.getElementById('qr-reader').getElementsByTagName('span')[0].innerHTML =
                                    "<span style='font-size: 14px'>Para escanear el código de un producto dar clic en 'Continuar'.</span>";

                                document.getElementById('qr-reader__dashboard_section_swaplink').innerHTML = "";
                                document.getElementById('qr-reader__status_span').innerHTML = "";
                                document.getElementById('qr-reader__status_span').style.background = 'white';

                                // document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[0].innerHTML = "Seleccionar cámara";

                                console.log("CHILD ID QR: " + document.getElementById('qr-reader').innerHTML);

                                var targetNode = document.getElementById('qr-reader__dashboard_section_csr');
                                var observer = new MutationObserver(function() {
                                    console.log("THIRD HTML: " + document.getElementById('qr-reader').innerHTML);
                                    // document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[0].innerHTML = document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[0].innerHTML.replace(/(?<=\>).+(?=\<select)/, '')
                                    // console.log(document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[0].childNodes[0].nodeValue)

                                    document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[0].childNodes[
                                        0].nodeValue = "Seleccionar cámara: "
                                    document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[1]
                                        .getElementsByTagName('button')[0].innerHTML = "Escanear"
                                    document.getElementById('qr-reader__dashboard_section_csr').getElementsByTagName('span')[1]
                                        .getElementsByTagName('button')[1].innerHTML = "Dejar de escanear"
                                });

                                observer.observe(targetNode, {
                                    attributes: true,
                                    childList: true
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div style="position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 10000;"
            class="{{ $showNewClientModal ? 'show' : 'hidden' }} bg-gray-800 bg-opacity-50">
            <div tabindex="-1" aria-hidden="true"
                class="flex items-center justify-center h-screen m-auto {{ $showNewClientModal ? 'show' : 'hidden' }}">
                <div class="relative w-full max-w-md md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" wire:click="closeNewClientModal"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
                                Nuevo cliente
                            </h3>

                            <form class="space-y-6" wire:submit.prevent="registrarCliente">
                                {{ csrf_field() }}
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nombre del cliente
                                    </label>
                                    <input type="name" name="name" id="name" wire:model="clienteNuevo.nombre"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Nombre del cliente" required>
                                    @error('clienteNuevo.nombre')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="phone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Teléfono
                                    </label>
                                    <input type="phone" name="phone" id="phone"
                                        wire:model="clienteNuevo.telefono"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Número de teléfono" required>
                                    @error('clienteNuevo.telefono')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email" wire:model="clienteNuevo.correo"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="(Opcional)">
                                    @error('clienteNuevo.correo')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    wire:click="registrarCliente">
                                    Registrar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($this->cantidadVentas == 0 && $this->caja->abierta == 0)
        <div class="px-6 flex justify-center py-4">
            <div class="inline-block mr-2 mt-2">
                <form wire:submit.prevent="abrirCaja">
                    <div class="flex justify-center">
                        <input type="number" wire:model="cantidad_apertura"
                            placeholder="Ingresa cantidad de inicio y da clic en abrir caja"
                            class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                        <button type="submit"
                            class="focus:outline-none text-white text-sm py-1 px-7 border-b-4 border-green-600 rounded-md bg-green-500 hover:bg-green-400">
                            Abrir caja
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif
    @if ($caja->abierta)
        <div class="grid grid-cols-12 gap-4 p-4 bg-gray-100">
            <div class="md:col-span-9 col-span-12 bg-gray-100">
                <div class="grid grid-cols-12 gap-4 h-full flex content-start">
                    {{-- Buscar --}}
                    <div class="col-span-12 bg-white">
                        <div class="md:flex md:justify-between md:items-center p-4">
                            <div class="relative text-gray-600 flex items-center justify-center">
                                <input type="search" wire:model="buscar" name="search"
                                    {{ (is_numeric($phase) ? $phase : 0) >= 1 ? 'disabled' : '' }}
                                    placeholder="Realiza tu búsqueda..."
                                    class="bg-white h-10 px-5 pr-10 rounded-full text-sm w-full">
                                <button disabled class="relative top-0 right-8">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                        x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                        style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                        width="512px" height="512px">

                                        <path
                                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                    </svg>
                                </button>
                                @if ($buscar != '')
                                    <button wire:click="clearSearch"
                                        class="relative top-0 right-16 text-blue-400 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path
                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </button>
                                @endif
                                @if (!$scan)
                                    <div>
                                        <button wire:click="activateScan"
                                            class="text-blue-400 border-2 border-blue-400 hover:text-white hover:bg-blue-400 p-1.5 rounded-md">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="py-4 text-center">

                                <b>Total de ventas: ${{ number_format($this->total_ventas, 2) }}</b>

                            </div>
                            <div>
                                <form method="POST" action="{{ route('logout.app') }}" class="flex justify-center">
                                    @csrf
                                    <button type="submit" wire:click="cerrarCaja"
                                        {{ (is_numeric($phase) ? $phase : 0) >= 1 ? 'disabled' : '' }}
                                        class="ml-4 focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400">
                                        Cerrar caja
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if ($showCart)
                        {{-- Lista de compra --}}
                        <div class="col-span-12 bg-white p-4">
                            <div class="w-full">
                                <div class="shadow overflow-auto border-b border-gray-200 w-full">
                                    <table class="divide-y divide-gray-200 min-w-full">
                                        <thead>
                                            <tr>
                                                <th class="py-2 text-black text-left text-sm font-bold font-bold"
                                                    style="background-color: rgb(145, 242, 237)">
                                                    <span class="pl-2">
                                                        Nombre
                                                    </span>
                                                </th>
                                                <th class="py-2 text-black text-sm text-left font-bold"
                                                    style="background-color: rgb(145, 242, 237)">
                                                    <span class="pl-2">
                                                        Precio
                                                    </span>
                                                </th>
                                                <th class="py-2 text-black text-sm text-left font-bold"
                                                    style="background-color: rgb(145, 242, 237)">
                                                    <span class="pl-2">
                                                        Cantidad
                                                    </span>
                                                </th>
                                                <th class="py-2 text-black text-sm text-left font-bold"
                                                    style="background-color: rgb(145, 242, 237)">
                                                    <span class="pl-2">
                                                        Descuento
                                                    </span>
                                                </th>
                                                <th class="py-2 text-black text-sm text-left font-bold"
                                                    style="background-color: rgb(145, 242, 237)">
                                                    <span class="pl-2">
                                                        Subtotal
                                                    </span>
                                                </th>
                                                <th class="py-2 text-black text-sm text-left font-bold"
                                                    style="background-color: rgb(145, 242, 237)">
                                                    <span class="pl-2">
                                                        Quitar
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (session()->get('total') == 0)
                                                <tr>
                                                    <td colspan="6" class="text-gray-500 py-4 text-center">No
                                                        hay
                                                        productos</td>
                                                </tr>
                                            @else
                                                @if (session('cart'))
                                                    @foreach (session('cart') as $id => $item)
                                                        <tr>
                                                            <td class="px-3 py-3">
                                                                <div class="flex items-center">
                                                                    <div>
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ mb_strtoupper($item['descripcion']) }}
                                                                        </div>
                                                                        <div class="text-xs text-gray-400">
                                                                            {{ $item['nombre'] }}
                                                                        </div>
                                                                        <div class="text-xs text-gray-400">
                                                                            {{ $item['codigo'] ?? '' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-3">
                                                                <span class="text-gray-500 font-bold">
                                                                    ${{ number_format($item['precio'], 2) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <div
                                                                    class="flex bg-gray-200 w-full text-gray-500 font-bold rounded-full  justify-between items-center">
                                                                    <button
                                                                        {{ session()->get('phase') >= 1 || session()->get('phase') == -1 ? 'disabled' : '' }}
                                                                        wire:click="quitar({{ $item['id'] }})"
                                                                        style="color: #33F0FF;"
                                                                        class="rounded-full bg-gray-100 hover:bg-gray-300 w-8 h-8">
                                                                        <span
                                                                            class='flex justify-center items-center font-bold text-2xl'>
                                                                            -
                                                                        </span>
                                                                    </button>
                                                                    <span class="px-2">
                                                                        {{ $item['cantidad'] }}
                                                                    </span>
                                                                    <button
                                                                        {{ session()->get('phase') >= 1 || session()->get('phase') == -1 ? 'disabled' : '' }}
                                                                        wire:click="agregar({{ $item['id'] }})"
                                                                        style="color: #33F0FF;"
                                                                        class="rounded-full bg-gray-100 hover:bg-gray-300 w-8 h-8">
                                                                        <span
                                                                            class='flex justify-center items-center font-bold text-2xl'>
                                                                            +
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td class="px-3">
                                                                @if ($item['descuento'] > 0)
                                                                    <span
                                                                        class='flex flex-col justify-center items-center h-full font-bold text-lg bg-green-200 text-green-600'>
                                                                        -{{ $item['descuento'] }}%
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td class="px-3">
                                                                <span class="text-gray-500 font-bold">
                                                                    ${{ number_format($item['subtotal'], 2) }}
                                                                </span>
                                                            </td>
                                                            <td class="px-3">
                                                                <div class="flex items-stretch justify-left">
                                                                    <div>
                                                                        <button
                                                                            {{ session()->get('phase') >= 1 || session()->get('phase') == -1 ? 'disabled' : '' }}
                                                                            wire:click="borrar({{ $id }})"
                                                                            style="color: #f6402f;"
                                                                            class="rounded-full bg-gray-100 hover:bg-gray-300 w-9 h-9">
                                                                            <span
                                                                                class='flex justify-center items-center font-bold text-2xl'>
                                                                                x
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Tabla de productos --}}
                        <div class="col-span-12 bg-white p-4">
                            <div wire:poll.2s>
                                <!-- This example requires Tailwind CSS v2.0+ -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                                            <div class="shadow border-b border-gray-200 w-full">
                                                <table class="divide-y divide-gray-200 min-w-full divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th class="py-2 text-black text-left text-sm font-bold font-bold"
                                                                style="background-color: rgb(145, 242, 237)">
                                                                <span class="pl-2">
                                                                    Nombre
                                                                </span>
                                                            </th>
                                                            <th class="py-2 text-black text-sm text-left font-bold"
                                                                style="background-color: rgb(145, 242, 237)">
                                                                <span class="pl-2">
                                                                    Precio
                                                                </span>
                                                            </th>
                                                            <th class="py-2 text-black text-sm text-left font-bold"
                                                                style="background-color: rgb(145, 242, 237)">
                                                                <span class="pl-2">
                                                                    Existencia
                                                                </span>
                                                            </th>
                                                            <th class="py-2 text-black text-sm text-left font-bold"
                                                                style="background-color: rgb(145, 242, 237)">
                                                                <span class="pl-2">
                                                                    Descuento
                                                                </span>
                                                            </th>
                                                            <th class="py-2 text-black text-sm text-left font-bold"
                                                                style="background-color: rgb(145, 242, 237)">
                                                                <span class="pl-2">
                                                                    Agregar
                                                                </span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white">
                                                        @if (count($productos) == 0)
                                                            <tr>
                                                                <td colspan="5"
                                                                    class="px-6 py-4 whitespace-nowrap text-red-600 text-center">
                                                                    No hay productos para mostrar.
                                                                </td>
                                                            </tr>
                                                        @else
                                                            @foreach ($productos as $producto)
                                                                <tr
                                                                    class="{{ $producto->stock <= 0 ? 'bg-gray-200' : '' }}">
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="flex items-center">
                                                                            <div>
                                                                                <div
                                                                                    class="text-sm text-gray-900 font-bold">
                                                                                    {{ mb_strtoupper($producto->descripcion) }}
                                                                                </div>
                                                                                <div class="text-sm text-gray-700">
                                                                                    {{ $producto->nombre }}
                                                                                </div>
                                                                                <div class="text-sm text-gray-500">
                                                                                    {{ $producto->codigo }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pl-2 py-4 whitespace-nowrap">
                                                                        <span class="text-gray-400 block">
                                                                            Unitario:
                                                                            <b>${{ number_format(($producto->precio_unitario / 100) * $producto->precio + $producto->precio, 2) }}</b>
                                                                        </span>
                                                                    </td>
                                                                    <td
                                                                        class="pl-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        <div class="flex justify-left">
                                                                            <div class="font-bold">
                                                                                {{ $producto->stock }} pzas
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-3">
                                                                        @if ($producto['descuento'] > 0)
                                                                            <span
                                                                                class='flex flex-col justify-center items-center h-full font-bold text-lg bg-green-200 text-green-600'>
                                                                                -{{ $producto['descuento'] }}%
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td
                                                                        class="pl-2 py-4 whitespace-nowrap text-left text-sm font-medium">

                                                                        @if ($producto->stock <= 0)
                                                                            <button disabled
                                                                                class="rounded-full bg-gray-100 text-gray-800 w-10 h-10">
                                                                                <span
                                                                                    class='flex justify-center items-center font-bold text-2xl'>
                                                                                    +
                                                                                </span>
                                                                            </button>
                                                                        @else
                                                                            <button
                                                                                wire:click="agregar({{ $producto->id_producto }})"
                                                                                style="color: #33F0FF;"
                                                                                class="rounded-full bg-gray-100 hover:bg-gray-300 w-10 h-10">
                                                                                <span
                                                                                    class='flex justify-center items-center font-bold text-2xl'>
                                                                                    +
                                                                                </span>
                                                                            </button>
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ $productos->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div class="md:col-span-3 col-span-12 bg-white">

                <div class="grid grid-cols-12 gap-1">
                    <div class="col-span-12 grid grid-cols-12 p-3 bg-white shadow-md">
                        <div class="col-span-4 text-md font-bold text-red-400 flex items-center">
                            TOTAL
                        </div>
                        <div class="col-span-8 text-xl font-bold text-right">
                            ${{ number_format(session()->get('total'), 2) }}
                        </div>
                    </div>
                    <div class="col-span-12 grid grid-cols-12 p-3 bg-white shadow-md">
                        <div class="col-span-4 text-md text-gray-600 flex items-center">
                            Productos
                        </div>
                        <div class="col-span-8 text-xl font-bold text-right">
                            <span>{{ $totalProductos }}</span>
                            @if ($totalProductos >= getenv('MIN_MEDIO_MAYOREO') && $totalProductos < getenv('MIN_MAYOREO'))
                                <span class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-400"
                                    style="height: 10px; width: 10px;">
                                    <svg>
                                        <title>Venta de medio mayoreo</title>
                                    </svg>
                                </span>
                            @elseif ($totalProductos >= getenv('MIN_MAYOREO') && $totalProductos < getenv('MIN_SUPER_MAYOREO'))
                                <span
                                    class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-400"
                                    style="height: 10px; width: 10px;">
                                    <svg>
                                        <title>Venta de mayoreo</title>
                                    </svg>
                                </span>
                            @elseif($totalProductos >= getenv('MIN_SUPER_MAYOREO'))
                                <span
                                    class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-400"
                                    style="height: 10px; width: 10px;">
                                    <svg>
                                        <title>Venta de súper mayoreo</title>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if ((is_numeric($phase) ? $phase : 0) == 0)
                        <div class="col-span-12 bg-white shadow-md">
                            {{-- @if ($totalProductos > 0) --}}
                            <div>
                                <button wire:click="mostrarCliente" {{ $totalProductos > 0 ? '' : 'disabled' }}
                                    class="{{ $totalProductos > 0
                                        ? 'w-full bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded'
                                        : 'w-full bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 border-b-4 border-gray-700 hover:border-gray-500 rounded' }}">
                                    SIGUIENTE
                                </button>
                            </div>
                        </div>
                    @endif
                    @if ((is_numeric($phase) ? $phase : 0) == 1)
                        <div class="col-span-12 grid grid-cols-12 p-3 bg-white shadow-md">
                            <div class="col-span-12 text-xs flex justify-between items-center">
                                <span>No. Cliente</span>
                                <div>
                                    @if (session('cliente_nombre'))
                                        <button wire:click="cambiarCliente"
                                            class="block underline text-red-600 hover:text-red-800" type="button"
                                            data-modal-toggle="authentication-modal">
                                            Cambiar cliente
                                        </button>
                                    @else
                                        <button wire:click="openNewClientModal"
                                            class="block underline text-blue-600 hover:text-blue-800" type="button"
                                            data-modal-toggle="authentication-modal">
                                            Nuevo cliente
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="flex mt-1 col-span-12">
                                <span
                                    class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                    </svg>
                                </span>
                                <input type="text" value="{{ session('cliente_nombre') }}" id="cliente"
                                    wire:model="cliente_nombre_buscar"
                                    class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required autofocus autocomplete="cliente"
                                    {{ session('cliente_nombre') ? 'disabled' : '' }}>
                            </div>
                            @if ($cliente_nombre_buscar != '' && !session('cliente_nombre'))
                                <div wire:poll.2s class="flex col-span-12 grid grid-cols-12">
                                    @foreach ($clientes as $client)
                                        <button wire:click="seleccionarCliente({{ $client->id_cliente }})"
                                            class="col-span-12 hover:bg-gray-200 hover:text-gray-600 text-gray-500 bg-gray-100 w-full text-sm text-left">
                                            {{ $client->id_cliente ?? '' }} |
                                            {{ substr($client->nombre, 0, 27) . (strlen($client->nombre) > 27 ? '...' : '') }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                        <div class="col-span-12 bg-white shadow-md">
                            {{-- @if ($totalProductos > 0) --}}
                            <div>
                                <button wire:click="terminarCompra"
                                    {{ $totalProductos > 0 && (is_numeric($phase) ? $phase : 0) >= 1 && session()->has('cliente_id') ? '' : 'disabled' }}
                                    class="{{ $totalProductos > 0 && (is_numeric($phase) ? $phase : 0) >= 1 && session()->has('cliente_id')
                                        ? 'w-full bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded'
                                        : 'w-full bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 border-b-4 border-gray-700 hover:border-gray-500 rounded' }}">
                                    COBRAR
                                </button>
                            </div>
                        </div>

                    @endif
                    @if ($phase == 2)
                        <div class="col-span-12 grid grid-cols-12 p-3 bg-white shadow-md">
                            <div class="col-span-6 text-sm text-gray-600 px-1">
                                <span class="text-center justify-center block">Recibido</span>
                                <div class="flex mt-1 col-span-12">
                                    <span
                                        class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                        $
                                    </span>
                                    <input type="number" id="recibido" step="100" wire:model="recibido"
                                        class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required autofocus autocomplete="recibido">
                                </div>
                            </div>
                            <div class="col-span-6 text-sm text-gray-600 px-1">
                                <span class="text-center justify-center block">Cambio</span>
                                <div class="flex items-center align-center justify-center">
                                    <input type="text" id="recibido" step="100" disabled
                                        value="${{ number_format(!is_numeric($recibido) ? 0 : ($recibido - session()->get('total') >= 0 ? $recibido - session()->get('total') : 0), 2) }}"
                                        class="{{ (!is_numeric($recibido)
                                                ? false
                                                : ($recibido - session()->get('total') >= 0
                                                    ? true
                                                    : false))
                                            ? 'border border-b-3 border-l-0 border-t-0 border-r-0 text-blue-800 border-blue-600 text-center block flex-1 min-w-0 w-full text-md font-bold p-2'
                                            : 'border border-b-3 border-l-0 border-t-0 border-r-0 text-red-700 border-red-600 text-center block flex-1 min-w-0 w-full text-md font-bold p-2' }}"
                                        required autofocus autocomplete="recibido">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 bg-white shadow-md">
                            <button
                                {{ (is_numeric($recibido) ? $recibido : 0) >= session()->get('total') ? '' : 'disabled' }}
                                wire:click='prelimpieza'
                                class="{{ (is_numeric($recibido) ? $recibido : 0) >= session()->get('total')
                                    ? 'w-full bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded'
                                    : 'w-full bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 border-b-4 border-gray-700 hover:border-gray-500 rounded' }}">
                                CONTINUAR
                            </button>
                        </div>
                    @endif
                    @if ($phase == 3)
                        <div class="col-span-6 bg-white shadow-md">
                            <a href="{{ route('empleado.ticket') }}" target="_blank">
                                <button
                                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 border-b-4 border-yellow-700 hover:border-yellow-500 rounded">
                                    TICKET
                                </button>
                            </a>
                        </div>
                        <div class="col-span-6 bg-white shadow-md">
                            <button wire:click="limpiar"
                                class="w-full bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded">
                                TERMINAR
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endif
</div>
@section('custom_scripts')
    window.addEventListener('openNewClientModal', event => {
    $("#newClientModal").modal('show');
    })
@endsection
