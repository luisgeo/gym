<div>
    <script>
        $(document).ready(function() {


            var capture = $("#deleteModal")
                .attr("tabindex", "-1")
                .focus()
                .keydown(function handleKeydown(event) {

                    if (event.key.toLowerCase() !== "tab") return;

                    var tabbable = $()
                        .add(capture.find("button"))
                        .add(capture.find("[href]"));
                    var target = $(event.target);

                    if (event.shiftKey) {
                        if (target.is(capture) || target.is(tabbable.first())) {
                            event.preventDefault();
                            tabbable.last().focus();
                        }
                    } else {
                        if (target.is(tabbable.last())) {
                            event.preventDefault();
                            tabbable.first().focus();
                        }
                    }
                });

            $(document).on('click', '#openModal', function(e) {

                var id = $(this).data('id');
                var username = $(this).data('username');

                $('#deleteModal #deleteButton').click(function() {
                    @this.eliminar(id).then(function() {
                        $('#loader').fadeIn();
                        $('#reload').html('');
                        $('#reload').load(location.href + ' #reload');
                        $('#loader').fadeOut();
                    });
                });

                $('#deleteModal #cancelButton').click(function() {
                    $('#loader').fadeIn();
                    $('#reload').load(location.href + ' #reload');
                    document.getElementById('dark-screen').classList.remove('scale-100');
                    document.getElementById('dark-screen').classList.add('scale-0');
                    e.preventDefault();
                    $('#loader').fadeOut();
                });

                $('#deleteModal #closeButton').click(function() {
                    $('#loader').fadeIn();
                    $('#reload').load(location.href + ' #reload');
                    document.getElementById('dark-screen').classList.remove('scale-100');
                    document.getElementById('dark-screen').classList.add('scale-0');
                    $('#loader').fadeOut();
                });

                document.getElementById('dark-screen').classList
                    .remove('scale-0');
                document.getElementById('dark-screen').classList.add('scale-100');

                $('#deleteModal #modalUserName').text('(' + username + ')')
                $('#deleteModal #deleteButton').focus();

                $('#reload').html('');
            });

            $('#refreshButton').on('click', function() {
                $('#loader').fadeIn();
                $('#reload').html('');
                @this.refr();
                $('#loader').fadeOut();
            });

            $('#shiftUsers').on('click', function() {
                $('#loader').fadeIn();
                $('#reload').html('');
                @this.mostrarEliminados();
                $('#loader').fadeOut();
            });

            $('#unshiftUsers').on('click', function() {
                $('#loader').fadeIn();
                $('#reload').html('');
                @this.mostrarActivos();
                $('#loader').fadeOut();
            });

        });
    </script>


    <x-slot name="header">
        <div class="flex inline-block justify-between align-middle">
            <div class=" flex flex-wrap content-center ">
                <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('USUARIOS') }}
                </h2>
            </div>
            <div class="flex">

                <a href="{{ route('registrar-usuario') }}" style="outline:none"
                    class="ml-2 hover:bg-green-100 rounded-full border-2 border-green-500 flex items-center justify-center px-2 py-2 focus:bg-green-100 focus:border-2 focus:border-green-500 ">
                    <svg height="25px" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                        class="text-green-500">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        <path
                            d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                        <title>Nuevo usuario</title>
                    </svg>
                </a>
            </div>
        </div>
    </x-slot>


    {{-- @if (session()->has('message'))
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
    @endif --}}
    <div class="flex justify-between py-4">
        <div class="relative text-gray-600">
            <input type="search" wire:model="buscar" name="search" placeholder="Realiza tu búsqueda..."
                class="bg-white h-10 px-5 pr-10 rounded-full text-sm">
            <button disabled class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                    y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                    xml:space="preserve" width="512px" height="512px">
                    <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                </svg>
            </button>
        </div>
        <div>
            <div class="flex">
                <button id="refreshButton" style="outline:none"
                    class="mr-2 hover:bg-gray-100 rounded-full border-2 border-gray-500 flex items-center justify-center px-2 py-2 focus:bg-gray-100 focus:border-2 focus:border-gray-500 ">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="currentColor"
                        class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                        <path
                            d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                        <title>Actualizar</title>
                    </svg>
                </button>

                <button id="shiftUsers" style="outline:none; {{ $comparacion == '!=' ? '' : 'display:none' }}"
                    class="hover:bg-red-100 text-red-500 font-bold py-2 px-2 rounded-full border-2 border-red-500 inline-flex items-center focus:border-3 focus:border-red-700 focus:bg-red-100">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-person-fill-x" viewBox="0 0 16 16">
                        <path
                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z" />
                        <title>Ver usuarios eliminados</title>
                    </svg>
                </button>

                <button id="unshiftUsers" style="outline: none; {{ $comparacion == '!=' ? 'display:none' : '' }}"
                    class="hover:bg-gray-200  rounded-full border-2 border-gray-500 flex items-center justify-center px-2 py-2 text-gray-500 focus:bg-gray-200 focus:border-3 focus:border-gray-700">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                        <path fill-rule="evenodd"
                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        <title>Volver</title>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="dark-screen"
        class="absolute top-0 right-0 w-screen h-screen bg-gray-700 flex justify-center items-center transform transition ease-in-out duration-150 scale-0">
        <div id="deleteModal" tabindex="0" class="">
            <div class="relative w-full h-full max-w-lg md:h-auto bg-gray-700">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" id="closeButton"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Cerrar ventana</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            ¿Estás seguro/a de eliminar este usuario?
                            <span id="modalUserName" class="block text-center font-bold"></span>
                        </h3>
                        <button id="deleteButton" data-modal-hide="deleteModal"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Sí, estoy seguro
                        </button>
                        <button id="cancelButton" data-modal-hide="deleteModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="reload">

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
                                        Usuario
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teléfono
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha de conexión
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rol
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Editar</span>
                                    </th>

                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Eliminar</span>
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($usuarios) == 0)
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 whitespace-nowrap text-blue-600 text-center">
                                            No hay usuarios.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div
                                                    class="text-sm font-medium text-gray-900 flex inline-block items-center">
                                                    @if ($usuario->estado_usuario == 0)
                                                        <span
                                                            class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500"
                                                            style="height: 10px; width: 10px;">
                                                            <svg>
                                                                <title>Usuario desconectado</title>
                                                            </svg>
                                                        </span>
                                                    @elseif($usuario->estado_usuario == 1)
                                                        <span
                                                            class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500"
                                                            style="height: 10px; width: 10px;">
                                                            <svg>
                                                                <title>Usuario conectado</title>
                                                            </svg>
                                                        </span>
                                                    @elseif($usuario->estado_usuario == 2)
                                                        <span
                                                            class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500"
                                                            style="height: 10px; width: 10px;">
                                                            <svg>
                                                                <title>Usuario dado de baja</title>
                                                            </svg>
                                                        </span>
                                                    @endif

                                                    <span>
                                                        &nbsp;
                                                        {{ $usuario->name }}
                                                        <b>{{ $usuario->name == Auth::user()->name ? '(Yo)' : '' }}</b>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $usuario->phone ?? $usuario->old_phone }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $usuario->fecha_ultima_actividad }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($usuario->rol == 0)
                                                    @if ($usuario->estado_usuario == 2)
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            No asignado
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                            No asignado
                                                        </span>
                                                    @endif
                                                @elseif ($usuario->rol == 1)
                                                    @if ($usuario->estado_usuario == 2)
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Vendedor
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            Vendedor
                                                        </span>
                                                    @endif
                                                @elseif ($usuario->rol == 2)
                                                    @if ($usuario->estado_usuario == 2)
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Administrador
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Administrador
                                                        </span>
                                                    @endif
                                                @elseif ($usuario->rol == 3)
                                                    @if ($usuario->estado_usuario == 2)
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Empleado
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-300 text-sky-800">
                                                            Empleado
                                                            <a href="{{ route('cajas.edit', $usuario->id) }}"
                                                                class="text-green-600 hover:text-green-900 inline-flex">
                                                                <svg height="20px" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <title>Editar caja</title>
                                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                                        strokeWidth={2}
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>

                                                        </span>
                                                    @endif
                                                @endif

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex flex-col items-center">
                                                    @if ($usuario->estado_usuario == 2)
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                            height="30" fill="currentColor" class="text-gray-300"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                                            <title>Editar usuario (Deshabilitado)</title>
                                                        </svg>
                                                    @else
                                                        <a href="{{ route('usuario.edit', $usuario->id) }}"
                                                            class="text-blue-600 hover:text-blue-900">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                height="30" fill="currentColor"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                                                <title>Editar usuario</title>
                                                            </svg>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                                <div class="flex flex-col items-center">

                                                    @if ($usuario->estado_usuario == 2 || Auth::id() == $usuario->id)
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                            height="30" fill="currentColor" class="text-gray-300"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                                                            <path
                                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z" />
                                                            <title>Dar de baja usuario (Deshabilitado)</title>
                                                        </svg>
                                                    @else
                                                        <button id="openModal" data-id="{{ $usuario->id }}"
                                                            data-username="{{ $usuario->name }}"
                                                            class="text-red-600 hover:text-red-900">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                height="30" fill="currentColor"
                                                                class="bi bi-person-fill-x" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                                                                <path
                                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z" />
                                                                <title>Dar de baja usuario</title>
                                                            </svg>
                                                        </button>
                                                    @endif



                                                </div>
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
    </div>

    {{ $usuarios->links() }}

</div>
