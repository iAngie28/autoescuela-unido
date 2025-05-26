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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overflow-x-hidden">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen">
            @include('layouts.sidebarr')
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <livewire:layout.navigation />

            <!-- Encabezado opcional -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Contenido -->
            <main class="flex-1 p-6 overflow-x-auto">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white pt-12 pb-8 mt-auto">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
</body>
</html>
