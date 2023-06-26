<nav x-data="{ open: false }" class="border-b border-gray-100" style="background-color: #49deea">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">


                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="rounded-full text-center"
                        style="background-image: url('{{ Storage::url('logo.jpg') }}');background-size:68px; background-position: center; width:50px;height:50px;">
                    </a>
                </div>


                <!-- Nav_UsCliente -->
                @if (session()->get('usuario_rol') == 1)
                    <!-- Navigation Links -->
                    <!-- Ofertas -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                        <x-jet-nav-link href="{{ route('ofertas') }}" :active="request()->routeIs('ofertas')">
                            {{ __('Ofertas') }}
                        </x-jet-nav-link>
                    </div>

                    <!-- Carrito -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('carrito') }}" :active="request()->routeIs('carrito')">
                            {{ __('Carrito') }}
                        </x-jet-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('mis-estadisticas') }}" :active="request()->routeIs('mis-estadisticas')">
                            {{ __('Mis estadísticas') }}
                        </x-jet-nav-link>
                    </div>
                @endif
                <!-- Nav_Admin -->
                @if (session()->get('usuario_rol') == 2)
                    <!-- Mi tienda Dropdown -->
                    <div class="hidden space-x-8 sm:-my-px py-4 sm:ml-10 sm:flex ">
                        <x-jet-dropdown>
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-800 hover:bg-white focus:outline-none focus:bg-white focus:text-gray-800 transition ease-in-out duration-150">
                                        {{ __('Mi tienda') }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>

                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"-->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Mis sucursales') }}
                                </div>

                                <!-- Almacenes -->
                                <x-jet-dropdown-link href="{{ route('almacenes') }}" :active="request()->routeIs('almacenes')">
                                    {{ __('Almacenes') }}
                                </x-jet-dropdown-link>

                                <!-- Clientes -->
                                <x-jet-dropdown-link href="{{ route('clientes') }}" :active="request()->routeIs('clientes')">
                                    {{ __('Clientes') }}
                                </x-jet-dropdown-link>

                                <!-- Productos -->
                                <x-jet-dropdown-link href="{{ route('marcas') }}" :active="request()->routeIs('marcas')">
                                    {{ __('Marcas') }}
                                </x-jet-dropdown-link>

                                <!-- Productos -->
                                <x-jet-dropdown-link href="{{ route('productos') }}" :active="request()->routeIs('productos')">
                                    {{ __('Productos') }}
                                </x-jet-dropdown-link>

                                <!-- Proveedores -->
                                <x-jet-dropdown-link href="{{ route('proveedores') }}" :active="request()->routeIs('proveedores')">
                                    {{ __('Proveedores') }}
                                </x-jet-dropdown-link>

                                <!-- Clientes -->
                                <x-jet-dropdown-link href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')">
                                    {{ __('Usuarios') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-dropdown>
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" 
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-gray-800 hover:bg-white focus:bg-white focus:text-gray-800 focus:outline-none transition ease-in-out duration-150">
                                        {{ __('Mis ventas') }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>

                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"-->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Mis ventas') }}
                                </div>

                                <!-- Control de ventas -->
                                <x-jet-dropdown-link href="{{ route('compras') }}" :active="request()->routeIs('compras')">
                                    {{ __('Ventas') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-nav-link class="text-white hover:text-white focus:outline-none"
                            href="{{ route('notificaciones') }}" :active="request()->routeIs('notificaciones')">
                            {{ __('Notificaciones') }}
                        </x-jet-nav-link>
                    </div>
                @endif
                <!-- Nav_Empl -->
                @if (session()->get('usuario_rol') == 3)
                    <!-- Pedidos -->
                    {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('entregas') }}" :active="request()->routeIs('entregas')">
                            {{ __('Ventas') }}
                        </x-jet-nav-link>
                    </div> --}}
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('compra.new.tienda') }}" :active="request()->routeIs('compra.new.tienda')">
                            {{ __('Caja') }}
                        </x-jet-nav-link>
                    </div>
                @endif
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">

                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-500 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>



                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team" />
                                @endforeach
                            </div>

                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-500 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Ajustes') }}
                            </div>

                            @if (session()->get('usuario_rol') == 2)
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Mi perfil') }}
                                </x-jet-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout.app') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout.app') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-500 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 focus:text-blue-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex text-gray-700"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden text-gray-700"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-white"><b>{{ Auth::user()->name }}</b></div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                @if (session()->get('usuario_rol') == 2)
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Mi perfil') }}
                    </x-jet-responsive-nav-link>
                @endif
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout.app') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout.app') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-jet-responsive-nav-link>
                </form>

            </div>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="pb-3">

                <!-- Nav_UsCliente -->
                @if (session()->get('usuario_rol') == 1)
                    <!-- Ofertas -->

                    <x-jet-responsive-nav-link href="{{ route('ofertas') }}" :active="request()->routeIs('ofertas')">
                        {{ __('Ofertas') }}
                    </x-jet-responsive-nav-link>


                    <!-- Carrito -->

                    <x-jet-responsive-nav-link href="{{ route('carrito') }}" :active="request()->routeIs('carrito')">
                        {{ __('Carrito') }}
                    </x-jet-responsive-nav-link>



                    <x-jet-responsive-nav-link href="{{ route('mis-estadisticas') }}" :active="request()->routeIs('mis-estadisticas')">
                        {{ __('Mis estadísticas') }}
                    </x-jet-responsive-nav-link>
                @endif
                <!-- Nav_Admin -->
                @if (session()->get('usuario_rol') == 2)
                    <div class="pb-3 pl-4 text-gray-500 font-bold ">
                        {{ __('Mis sucursales') }}
                    </div>

                    <!-- Almacenes -->
                    <x-jet-responsive-nav-link href="{{ route('almacenes') }}" :active="request()->routeIs('almacenes')">
                        {{ __('Almacenes') }}
                    </x-jet-responsive-nav-link>

                    <!-- Clientes -->
                    <x-jet-responsive-nav-link href="{{ route('clientes') }}" :active="request()->routeIs('clientes')">
                        {{ __('Clientes') }}
                    </x-jet-responsive-nav-link>

                    <!-- Productos -->
                    <x-jet-responsive-nav-link href="{{ route('marcas') }}" :active="request()->routeIs('marcas')">
                        {{ __('Marcas') }}
                    </x-jet-responsive-nav-link>

                    <!-- Productos -->
                    <x-jet-responsive-nav-link href="{{ route('productos') }}" :active="request()->routeIs('productos')">
                        {{ __('Productos') }}
                    </x-jet-responsive-nav-link>

                    <!-- Proveedores -->
                    <x-jet-responsive-nav-link href="{{ route('proveedores') }}" :active="request()->routeIs('proveedores')">
                        {{ __('Proveedores') }}
                    </x-jet-responsive-nav-link>

                    <!-- Clientes -->
                    <x-jet-responsive-nav-link href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')">
                        {{ __('Usuarios') }}
                    </x-jet-responsive-nav-link>

                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="pb-3 pl-4 text-gray-500 font-bold">
                            {{ __('Mis ventas') }}
                        </div>

                        <!-- Control de ventas -->

                        <x-jet-responsive-nav-link href="{{ route('compras') }}" :active="request()->routeIs('compras')">
                            {{ __('Ventas') }}
                        </x-jet-responsive-nav-link>

                    </div>

                    <div class="border-t border-gray-200">
                        <x-jet-responsive-nav-link href="{{ route('notificaciones') }}" :active="request()->routeIs('notificaciones')">
                            {{ __('Notificaciones') }}
                        </x-jet-responsive-nav-link>
                    </div>
                @endif
                <!-- Nav_Rep -->
                @if (session()->get('usuario_rol') == 3)
                    <!-- Caja -->
                    <x-jet-responsive-nav-link href="{{ route('compra.new.tienda') }}" :active="request()->routeIs('compra.new.tienda')">
                        {{ __('Caja') }}
                    </x-jet-responsive-nav-link>
                @endif
            </div>
        </div>
    </div>
</nav>
