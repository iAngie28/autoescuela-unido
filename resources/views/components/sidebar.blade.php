<div x-data="{ open: false }">
    <!-- Botón "hamburger" para abrir/cerrar el sidebar -->
    <button @click="open = !open" class="fixed top-4 left-4 z-50 text-white md:hidden bg-blue-600 hover:bg-blue-700 p-2 rounded">
        ☰
    </button>

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 w-64 h-screen bg-gray-800 text-white transition-transform duration-300 z-40 shadow-lg"
        :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        <nav class="p-6 space-y-4">
            <ul class="flex flex-col">
                <li class="px-4 cursor-pointer bg-gray-500 text-gray-800 hover:bg-gray-700 hover:text-white">
                    <a class="py-3 flex items-center" href="{{ url('/admin/dashboard') }}">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M3 9h18M3 15h18M3 21h18"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li class="px-4 cursor-pointer hover:bg-gray-700">
                    <a class="py-3 flex items-center" href="{{ url('/users') }}">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0"></path>
                        </svg>
                        Usuarios
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</div>
