<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
            font-size: 20px;
            padding-right: 5px;
        }
    </style>
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">
        <livewire:layout.navigation class="relative z-40" />


        <!-- Botón de menú para móvil SIEMPRE visible arriba -->
        <div class="md:hidden flex items-center bg-gray-800 px-4 py-2">
            <label for="menu-toggle" class="text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
        </div>
        <div class="flex flex-1">
            <input type="checkbox" id="menu-toggle" class="hidden peer" />
            <!-- Sidebar -->
            <aside
                class="hidden peer-checked:flex md:flex flex-col left-0 top-0 min-h-screen w-64 bg-gray-800 transition-all duration-300 ease-in-out z-30">
                <!-- Botón de cierre para móvil -->
                <div class="flex items-center justify-between bg-gray-900 px-4 py-3">
                    <span class="text-white font-bold uppercase">Menú</span>
                    <label for="menu-toggle" class="text-white cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l-12 12" />
                        </svg>
                    </label>
                </div>

                <!-- Contenido del Sidebar -->
                @if (Auth::user()->tipo_usuario === 'A')
                    @include('layouts.sidebarAdmin')
                @elseif (Auth::user()->tipo_usuario === 'E')
                    @include('layouts.sidebarStudent')
                @elseif (Auth::user()->tipo_usuario === 'I')
                    @include('layouts.sidebarInstructor')
                @else
                    @include('layouts.sidebar-default')
                @endif
            </aside>

            <!-- Contenido Principal -->
            <div class="flex-1 @yield('background-class', 'bg-gray-100')">  {{-- yyield funciona como condicional --}}
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="flex-1 w-full overflow-x-auto h-auto">
                    @yield('content')
                </main>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-gray-900 text-white pt-4 pb-4">
            @include('layouts.footer')
        </footer>
    </div>
    @stack('scripts')

    <style>
    body * {
        pointer-events: auto !important;
    }
</style>
</body>

</html>