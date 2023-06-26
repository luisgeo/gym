<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
    

</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen dark:bg-gray-900 bg-green-900 sm:items-center">


        <div class="w-full h-screen bg-center bg-no-repeat bg-cover" style="background-color: rgb(58, 58, 58);">
            <div class="w-full h-screen flex justify-center items-center">
                <div class="mx-4 text-center text-white">
                    <div class="text-center max-w-xl mx-auto">
                        <h1 class="text-6xl md:text-7xl font-bold mb-5 text-gray-100">Bienvenido/a al sistema</h1>
                        <div class="text-center mb-10">
                            <span class="inline-block w-1 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                            <span class="inline-block w-3 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                            <span class="inline-block w-6 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                            <span class="inline-block w-40 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                            <span class="inline-block w-6 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                            <span class="inline-block w-3 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                            <span class="inline-block w-1 h-1 rounded-full animate-pulse ml-1"
                                style="background-color:rgb(17, 237, 248)"></span>
                        </div>
                    </div>


                    <div>
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="bg-blue-500 rounded-md font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-2">
                                        Ir
                                        a
                                        AC&Ce</a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="bg-blue-400 rounded-md font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-500 ml-2">
                                        Iniciar
                                        sesión</a>
                                @endauth
                            </div>
                        @endif

                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>
