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

    {{-- <img src="{{ asset('storage/system/IMG_20230623_104514.jpg') }}" class="h-screen absolute w-full opacity-5" /> --}}

    <main>
        <div
            class="h-screen bg-gradient-to-r from-fuchsia-500 to-purple-900
                    grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5">

            <div class="sm:col-span-1 md:col-start-2 lg:col-start-3 mt-60 flex justify-center">
                <h2 class="font-sans font-semibold text-gray-200 text-3xl md:text-4xl lg:text-5xl tracking-wide">
                    NETI-SGA
                </h2>
            </div>
            
            <div class="sm:col-span-1 md:col-start-2 lg:col-start-3 flex justify-center gap-4">

                @if (Route::has('login'))
                    @auth
                        <div>
                            <a href="{{ url('/dashboard') }}"
                                class="text-white bg-gradient-to-r from-neutral-300 to-neutral-600 
                                hover:bg-gradient-to-r focus:ring-4 hover:from-neutral-500 hover:to-neutral-800 
                                focus:outline-none focus:ring-blue-300 shadow-lg shadow-gray-400
                                font-medium rounded-full text-sm px-5 py-2.5 text-center">Dashboard</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('login') }}"
                                class="text-white bg-gradient-to-r from-neutral-300 to-neutral-600 
                                hover:bg-gradient-to-r focus:ring-4 hover:from-neutral-500 hover:to-neutral-800 
                                focus:outline-none focus:ring-blue-300 shadow-lg shadow-gray-400
                                font-medium rounded-full text-sm px-5 py-2.5 text-center">Login</a>
                        </div>

                        @if (Route::has('register'))
                            <div>
                                <a href="{{ route('register') }}"
                                    class="text-zinc-600 bg-gradient-to-r from-slate-50 to-slate-300 
                                    hover:bg-gradient-to-r focus:ring-4 hover:from-slate-200 hover:to-slate-500 hover:text-gray-100 
                                    focus:outline-none focus:ring-blue-300 shadow-lg shadow-gray-400
                                    font-medium rounded-full text-sm px-5 py-2.5 text-center">Register</a>
                            </div>
                        @endif
                    @endauth
                @endif

            </div>

        </div>
    </main>

    @stack('modals')
    @livewireScripts
</body>

</html>
