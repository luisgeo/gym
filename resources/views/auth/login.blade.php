<x-guest-layout>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px rgb(169, 226, 255) inset !important;
        }
    </style>
    <section class="h-screen">
        <div class="pr-6 h-full text-gray-800">
            <div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6">
                <div class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0">
                    <img src="{{ Storage::url('logo.jpg') }}"
                        class="w-full rounded-r-full border-r-2 border-gray-500 shadow-xl" alt="Sample image" />
                </div>
                <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
                    <div>
                        @foreach ($errors->all() as $message)
                            <div class="text-center py-4 px-6">
                                <div class="p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex"
                                    role="alert">
                                    <span
                                        class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Oops</span>
                                    <span class="font-semibold mr-2 text-left flex-auto">{{ $message }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form method="POST" action="{{ route('usuario.login') }}">
                        {{ csrf_field() }}
                        <!-- Phone input -->
                        <div class="mb-6">
                            <input type="text"
                                class="shadow-xl form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="phone" name="phone" :value="old('phone')" required autofocus
                                placeholder="Número de teléfono" />
                        </div>

                        <!-- Password input -->
                        <div class="mb-6">
                            <input type="password"
                                class="shadow-xl form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="password" name="password" required placeholder="Contraseña" />
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-7 py-3 bg-blue-600 text-white text-sm leading-snug uppercase rounded shadow-xl hover:bg-white hover:text-gray-700 hover:font-bold hover:shadow-lg focus:bg-white focus:text-gray-700 focus:font-bold focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                Ingresar
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- <x-jet-authentication-card> --}}


    {{-- 
        <x-slot name="logo">
            <div class="flex justify-center py-2">
                <div class="rounded-full border-2 border-gray-500" style="background-image: url('{{ Storage::url('logo.jpg') }}');background-size:150px; background-position: center; width:130px;height:130px;">
                </div>
            </div>
        </x-slot>

        @foreach ($errors->all() as $message)
            <div class="text-center py-4 px-6">
                <div class="p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Oops</span>
                    <span class="font-semibold mr-2 text-left flex-auto">{{ $message }}</span>
                </div>
            </div>
        @endforeach

        <form method="POST" action="{{ route('usuario.login') }}">
            {{ csrf_field() }}

            
            <div>
                <x-jet-label for="phone" value="{{ __('Número de teléfono') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required autofocus />
            </div>
            @error('phone')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>
            @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4" style="color: rgb(255, 255, 255)">
                    {{ __('Entrar') }}
                </x-jet-button>
            </div>
        </form> --}}
    {{-- </x-jet-authentication-card> --}}
</x-guest-layout>
