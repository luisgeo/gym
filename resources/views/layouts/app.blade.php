<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ Storage::url('logo.jpg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/flowbite.min.css') }}" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

</head>
<script>
    $(document).ready(function() {
        $(window).on('beforeunload', function() {
            $('#loader').fadeOut();
        });

        $('a').on('click', function() {
            $('#loader').fadeIn();
        });

        $('#loader').fadeOut();

        
    });
</script>

<body class="font-sans antialiased">

    <div id="loader"
        class="absolute top-0 right-0 z-index-9999 w-screen h-screen bg-gray-800 flex justify-center items-center animate-pulse">
        <img src="{{ Storage::url('logo.jpg') }}" alt="Image" class="w-1/4 rounded-full">
    </div>

    <x-jet-banner />

    <div class="min-h-screen bg-gray-50">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="{{ mix('js/flowbite.min.js') }}"></script>

</body>

</html>
