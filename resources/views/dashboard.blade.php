<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido/a') }}
        </h2>
        @if (session()->get('usuario_rol') == -1)
            <h1>
                No tienes permiso para usar esta aplicación. Has sido baneado/a.
            </h1>
        @endif
        @if (session()->get('usuario_rol') == 0)
            <script>
                window.location = "{{ route('completar-registro') }}"

            </script>
        @endif
        @if (session()->get('usuario_rol') == 1)
            <script>
                window.location = "{{ route('ofertas') }}"

            </script>
        @endif
        @if (session()->get('usuario_rol') == 2)
            <script>
                window.location = "{{ route('clientes') }}"

            </script>
        @endif
        @if (session()->get('usuario_rol') == 3)
            <script>
                window.location = "{{ route('compra.new.tienda') }}"

            </script>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
