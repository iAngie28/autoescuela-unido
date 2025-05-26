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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">
        <livewire:layout.navigation />

        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-800 min-h-screen sticky top-16 md:static">
                @include('layouts.sidebarr')
            </aside>

            <!-- Contenido Principal -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

        <!-- Footer fijo en móviles -->
        <footer class="bg-gray-900 text-white pt-12 pb-8 mt-auto">

            @include('layouts.footer')
        </footer>
    </div>
</body>

</html>
