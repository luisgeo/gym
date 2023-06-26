<div>
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataform').submit(function() {
                $('#loader').fadeIn();
            });
        });

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
            @this.set('producto.codigo', decodedText);
            @this.set('scan', false);
            // Html5QrcodeScanner.clear();
            Html5QrcodeScanner.stop();
        }
    </script>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Productos') }}
            </h2>
        </x-slot>

        <div style="position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 10000;"
            class="{{ $scan ? 'show' : 'hidden' }} bg-gray-800 bg-opacity-50">
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="flex items-center justify-center h-screen m-auto {{ $scan ? 'show' : 'hidden' }}">
                <div class="relative w-full max-w-md md:h-auto">
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
        <div class="py-2">

            <div class="flex justify-center">
                <div>
                    <div class="container mx-auto content-center">
                        <div class="sm:mt-0 content-center">
                            <div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form wire:submit.prevent="save" id="dataform">
                                        <div class="shadow overflow-hidden sm:rounded-md">
                                            <div class="px-4 py-5 bg-white sm:p-6">
                                                <div class="grid grid-cols-3 gap-3">

                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="nombre"
                                                            class="block text-sm font-medium text-gray-700">Nombre</label>
                                                        <input type="text" wire:model="producto.nombre"
                                                            name="nombre" id="nombre" autocomplete="given-name"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('producto.nombre')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="modelo"
                                                            class="block text-sm font-medium text-gray-700">Modelo</label>
                                                        <input type="text" name="modelo"
                                                            wire:model="producto.modelo" id="modelo"
                                                            autocomplete="given-name"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('producto.modelo')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="precio"
                                                            class="block text-sm font-medium text-gray-700">Precio
                                                            Costo</label>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">$</span>
                                                            <input type="number" name="precio" id="precio"
                                                                autocomplete="given-name" wire:model="producto.precio"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.precio')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <div class="flex justify-between">
                                                            <label for="precio_unitario"
                                                                class="block text-sm font-medium text-gray-700">Precio
                                                                Unitario
                                                            </label>
                                                            <span class="text-green-500 text-sm">
                                                                ${{ number_format((($producto->precio == '' ? 0 : $producto->precio) * ($producto->precio_unitario == '' ? 0 : $producto->precio_unitario)) / 100 + ($producto->precio == '' ? 0 : $producto->precio), 2) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">%</span>
                                                            <input type="number" step="1" name="precio_unitario"
                                                                id="precio_unitario" autocomplete="given-name"
                                                                wire:model="producto.precio_unitario"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.precio_unitario')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <div class="flex justify-between">
                                                            <label for="precio_medio_mayoreo"
                                                                class="block text-sm font-medium text-gray-700">Precio
                                                                Medio
                                                                Mayoreo
                                                            </label>
                                                            <span class="text-green-500 text-sm">
                                                                ${{ number_format((($producto->precio == '' ? 0 : $producto->precio) * ($producto->precio_medio_mayoreo == '' ? 0 : $producto->precio_medio_mayoreo)) / 100 + ($producto->precio == '' ? 0 : $producto->precio), 2) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">%</span>
                                                            <input type="number" step="1"
                                                                name="precio_medio_mayoreo" id="precio_unitario"
                                                                autocomplete="given-name"
                                                                wire:model="producto.precio_medio_mayoreo"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.precio_medio_mayoreo')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <div class="flex justify-between">
                                                            <label for="precio_mayoreo"
                                                                class="block text-sm font-medium text-gray-700">Precio
                                                                Mayoreo
                                                            </label>
                                                            <span class="text-green-500 text-sm">
                                                                ${{ number_format((($producto->precio == '' ? 0 : $producto->precio) * ($producto->precio_mayoreo == '' ? 0 : $producto->precio_mayoreo)) / 100 + ($producto->precio == '' ? 0 : $producto->precio), 2) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">%</span>
                                                            <input type="number" step="1"
                                                                name="precio_mayoreo" id="precio_mayoreo"
                                                                autocomplete="given-name"
                                                                wire:model="producto.precio_mayoreo"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.precio_mayoreo')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <div class="flex justify-between">
                                                            <label for="precio_super_mayoreo"
                                                                class="block text-sm font-medium text-gray-700">Precio
                                                                Super
                                                                Mayoreo
                                                            </label>
                                                            <span class="text-green-500 text-sm">
                                                                ${{ number_format((($producto->precio == '' ? 0 : $producto->precio) * ($producto->precio_super_mayoreo == '' ? 0 : $producto->precio_super_mayoreo)) / 100 + ($producto->precio == '' ? 0 : $producto->precio), 2) }}
                                                            </span>
                                                        </div>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">%</span>
                                                            <input type="number" step="1"
                                                                name="precio_super_mayoreo" id="precio_super_mayoreo"
                                                                autocomplete="given-name"
                                                                wire:model="producto.precio_super_mayoreo"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.precio_super_mayoreo')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="stock"
                                                            class="block text-sm font-medium text-gray-700">Stock en Almacén General</label>
                                                        <input type="number" step="1" name="stock"
                                                            id="stock" autocomplete="given-name"
                                                            wire:model="producto.stock"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('producto.stock')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="descuento"
                                                            class="block text-sm font-medium text-gray-700">Descuento</label>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">%</span>
                                                            <input type="number" step="0.10" name="descuento"
                                                                id="descuento" autocomplete="given-name"
                                                                wire:model="producto.descuento"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.descuento')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="comision"
                                                            class="block text-sm font-medium text-gray-700">Comisión</label>
                                                        <div class="flex mt-1">
                                                            <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">$</span>
                                                            <input type="number" step="0.10" name="comision"
                                                                id="comision" autocomplete="given-name"
                                                                wire:model="producto.comision"
                                                                class="rounded-none rounded-r-md border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                required autofocus autocomplete="name">
                                                        </div>
                                                        @error('producto.comision')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="codigo"
                                                            class="block text-sm font-medium text-gray-700">Código</label>

                                                        {{-- @if ($scan)
                                                            <div class="py-3">
                                                                <div id="qr-reader" style="width: 600px"></div>
                                                                <script>
                                                                    function onScanSuccess(decodedText, decodedResult) {
                                                                        // console.log(`Code scanned = ${decodedText}`, decodedResult);
                                                                        // @this.producto.codigo = 1991281981;
                                                                        @this.set('producto.codigo', decodedText);
                                                                    }
                                                                    var html5QrcodeScanner = new Html5QrcodeScanner(
                                                                        "qr-reader", {
                                                                            fps: 10,
                                                                            qrbox: 250
                                                                        });
                                                                    html5QrcodeScanner.render(onScanSuccess);
                                                                </script>
                                                            </div>
                                                        @endif --}}
                                                        <div class="flex justify-center items-center ">
                                                            {{-- <span
                                                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">$</span> --}}
                                                            <input type="text" name="codigo" id="codigo"
                                                                autocomplete="given-name" wire:model="producto.codigo"
                                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            @if (!$scan)
                                                                <div class="inline-flex items-center ">
                                                                    <button wire:click="activateScan" type="button"
                                                                        class="text-blue-400 border-blue-400 hover:text-white hover:bg-blue-400 p-1.5 rounded-md">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            fill="currentColor" class="bi bi-upc-scan"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endif

                                                        </div>


                                                        @error('producto.codigo')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="marca"
                                                            class="block text-sm font-medium text-gray-700">Marca</label>
                                                        <select id="marca" name="marca" autocomplete="marca"
                                                            wire:model="producto.id_marca"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white 
                                                    rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option>--Seleccionar--</option>
                                                            @foreach ($marcas as $marca)
                                                                <option value="{{ $marca->id_marca }}">
                                                                    {{ $marca->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('producto.id_marca')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-12 sm:col-span-2">
                                                        <label for="descripcion"
                                                            class="block text-sm font-medium text-gray-700">Descripcion</label>
                                                        <input type="text" name="descripcion" id="descripcion"
                                                            autocomplete="given-name"
                                                            wire:model="producto.descripcion"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('producto.descripcion')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="proveedor"
                                                            class="block text-sm font-medium text-gray-700">Proveedor</label>
                                                        <select id="proveedor" name="proveedor"
                                                            autocomplete="proveedor"
                                                            wire:model="producto.id_proveedor"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option>--Seleccionar--</option>
                                                            @foreach ($proveedores as $proveedor)
                                                                <option value="{{ $proveedor->id_proveedor }}">
                                                                    {{ $proveedor->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('producto.id_proveedor')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="col-span-12 sm:col-span-1">
                                                        <label for="almacen"
                                                            class="block text-sm font-medium text-gray-700">Almacén</label>
                                                        <select id="almacen" name="almacen"
                                                            wire:model="producto.id_almacen" autocomplete="almacen"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            <option>--Seleccionar--</option>
                                                            @foreach ($almacenes as $almacen)
                                                                <option value="{{ $almacen->id_almacen }}">
                                                                    {{ $almacen->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('producto.id_almacen')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="col-span-12 sm:col-span-1">
                                                        <label for="imagen"
                                                            class="block text-sm font-medium text-gray-700">Imagen de
                                                            producto</label>
                                                        <input type="file" accept="image/*" name="imagen"
                                                            id="imagen" autocomplete="given-name"
                                                            wire:model="imagen"
                                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        @error('imagen')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            <script>
                                                                $('#loader').fadeOut();
                                                            </script>
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
                                        {{-- <script>
                                            function onScanSuccess(decodedText, decodedResult) {
                                                console.log(`Code scanned = ${decodedText}`, decodedResult);
                                            }
                                            var html5QrcodeScanner = new Html5QrcodeScanner(
                                                "qr-reader", {
                                                    fps: 10,
                                                    qrbox: 250
                                                });
                                            html5QrcodeScanner.render(onScanSuccess);
                                        </script> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
