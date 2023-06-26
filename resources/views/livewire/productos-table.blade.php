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
    <div style="position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 10000;"
        class="{{ $scan ? 'show' : 'hidden' }} bg-gray-800 bg-opacity-50">
        <div id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="flex items-center justify-center h-screen m-auto {{ $scan ? 'show' : 'hidden' }}">
            <div class="relative w-full max-w-md md:h-auto">
                <!-- Modal content -->
                @if ($scan)
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
                @endif
            </div>
        </div>
    </div>
    <div>
        <x-slot name="header">
            <div class="flex inline-block justify-between align-middle">
                <div class=" flex flex-wrap content-center ">
                    <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('PRODUCTOS') }}
                    </h2>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('productos.repartir') }}">
                        <svg class="text-blue-600" height="40px" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zm-6 8A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm6 0A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm6 0a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1z" />
                            <title>Repartir productos</title>
                        </svg>
                    </a>
                    <a class="ml-2" href="{{ route('productos.new') }}">
                        <svg height="40px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            <title>Nuevo producto</title>
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
                    @if ($buscar != '')
                        <button wire:click="clearSearch" class="relative top-0 right-16 text-blue-400 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                    @endif
                    @if (!$scan)
                        <div>
                            <button type="button" wire:click="activateScan"
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
                <div class="bg-white shadow-md text-lg py-2 px-4 font-bold rounded-md">
                    Total de inversión: <span class="text-yellow-500">${{number_format($suma_total, 2)}}</span>
                </div>
                {{-- <div class="flex justify-center py-2">
                    <div class="pr-1">
                        <button wire:click="mostrarNormal" style="outline:none"
                            class="hover:bg-green-100 text-green-500 font-bold py-2 px-2 rounded-full border-2 border-green-500 inline-flex items-center focus:border-3 focus:border-green-700 focus:bg-green-100">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                <title>Ver todos los productos</title>
                            </svg>
                        </button>
                    </div>
                    <div class="pr-1">
                        <button wire:click="mostrarMenosDe20" style="outline:none"
                            class="hover:bg-yellow-100 text-yellow-500 font-bold py-2 px-2 rounded-full border-2 border-yellow-500 inline-flex items-center focus:border-3 focus:border-yellow-700 focus:bg-yellow-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                                <path
                                    d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z" />
                                <title>Ver menos de 20</title>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <button wire:click="mostrarMenosDe5" style="outline:none"
                            class="hover:bg-red-100 text-red-500 font-bold py-2 p-2 rounded-full border-2 border-red-500 inline-flex items-center focus:border-3 focus:border-red-700 focus:bg-red-100">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path
                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                <title>Ver menos de 5</title>
                            </svg>
                        </button>
                    </div>
                </div> --}}
            </div>
            <div {{ $buscar != '' ? 'wire:poll.2s' : '' }}>
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Precio / Descuento
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Descripción
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Inversión / Precio Costo
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Almacén general
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Eliminar</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @if (count($productos) == 0)
                                            <tr>
                                                <td colspan="7"
                                                    class="px-6 py-4 whitespace-nowrap text-red-600 text-center">
                                                    No hay productos para mostrar.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($productos as $producto)
                                                <tr class="{{ $producto->stock <= 0 ? 'bg-red-300' : '' }}">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            {{-- <div> --}}
                                                            <img src="/{{ $producto->imagen ?? 'default.svg' }}"
                                                                width="
                                                                50px"
                                                                class="rounded-full border-2 border-gray-500 mr-2">
                                                            {{-- <img src="{{ $producto->imagen ?? 'default.svg' }}"
                                                                width="
                                                                50px"
                                                                class="rounded-full border-2 border-gray-500 mr-2"> --}}
                                                            <div
                                                                class="text-sm font-medium text-gray-900 inline-block">
                                                                {{ $producto->nombre }}
                                                            </div>
                                                            {{-- </div> --}}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div>
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                ${{ number_format(($producto->precio * $producto->precio_unitario) / 100 + $producto->precio, 2) }}
                                                            </span>
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                {{ $producto->descuento }}%
                                                            </span>
                                                        </div>

                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ substr($producto->descripcion, 0, 30) . (strlen($producto->descripcion) >= 30 ? '...' : '') }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div>
                                                            <div
                                                                class="text-xl text-green-400 font-bold text-gray-900">
                                                                ${{ number_format(($producto->stock + $producto->stock_suma) * $producto->precio, 2) }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $producto->stock }} piezas
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                Repartidas: {{ $producto->stock_suma }} piezas
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('productos.edit', $producto->id_producto) }}"
                                                            class="text-green-600 hover:text-green-900">
                                                            <svg height="40px" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <title>Editar producto</title>
                                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                                    strokeWidth={2}
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <button wire:click="eliminar({{ $producto->id_producto }})"
                                                            class="text-red-600 hover:text-red-900">
                                                            <svg height="40px" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <title>Eliminar producto</title>
                                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                                    strokeWidth={2}
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
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
    </div>
</div>
