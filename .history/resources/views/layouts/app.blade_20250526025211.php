<body class="font-sans antialiased overflow-x-hidden">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen">
            @include('layouts.sidebarr')
        </aside>

        <!-- Contenido Principal -->
        <div class="flex flex-col flex-1 min-h-screen">
            <!-- Nav superior -->
            <livewire:layout.navigation />

            <!-- Header -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Main contenido -->
            <main class="flex-1 w-full">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white pt-12 pb-8">
                @include('layouts.footer')
            </footer>
        </div>
    </div>
</body>
