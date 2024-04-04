<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NETI-SGA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    
    <main>
        <div
            class="h-screen bg-gradient-to-r from-cyan-500 to-cyan-950
                    grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5">

            <div class="col-span-1 md:col-start-1 lg:col-start-1 flex flex-col justify-center">
                <div class="flex justify-center">
                    <x-welcome-title title="NETI-SGA" />
                </div>
                <div class="flex justify-center md:justify-end lg:justify-end ">
                    @if (Route::has('login'))
                        @auth
                            <x-welcome-button label="Go to vessels" href="{{ url('/vessel/index') }}" />
                        @else
                            <x-welcome-button label="Login" href="{{ route('login') }}" />
                        @endauth
                    @endif
                </div>
            </div>

            <x-welcome-bg-image />

        </div>
    </main>

    @stack('modals')
    @livewireScripts
</body>

</html>
