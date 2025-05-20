@extends('layouts.app')

@section('content')
<!-- Navbar Start -->
<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/admin/dashboard') }}">
                    <h1 class="text-xl font-bold text-gray-800">WUILLANS</h1>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center space-x-8">
                <a href="{{ url('/admin/dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                    Inicio
                </a>
                <a href="{{ url('/admin/dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                    Sobre Nosotros
                </a>
                <a href="{{ url('/cursos') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                    Cursos
                </a>
                <!-- Dropdown Button -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                        Más Opciones
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                        <a href="{{ url('/rols') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Roles</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Registar Usuarios</a>
                        <a href="{{ url('/users') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Usuarios</a>
                        <a href="{{ url('/vehiculos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Vehiculos</a>
                        <a href="{{ url('/clases') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Clases</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->

<body class="bg-gray-100 text-gray-800">


    <!-- Hero Section -->
    <section class="bg-blue-500 text-white py-20">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl font-bold mb-4">
                Bienvenido Administrador(a)
                @auth
                    @if (Auth::user()->id_rol === 1)
                    {{ strtoupper(Auth::user()->name) }}

                    @else
                        "Nuestros Administradores"
                    @endif
                @endauth
            </h2>
            <p class="text-lg mb-6">Cursos personalizados para todos los niveles. ¡Obtén tu licencia fácilmente!</p>
            <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded shadow hover:bg-gray-100">Ver Cursos</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded shadow text-center">
                    <i class="fas fa-car text-blue-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Clases Prácticas</h3>
                    <p>Aprende a conducir con instructores calificados y vehículos modernos.</p>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <i class="fas fa-users text-blue-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Instructores Expertos</h3>
                    <p>Recibe formación de profesionales con años de experiencia.</p>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <i class="fas fa-id-card text-blue-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Licencia Garantizada</h3>
                    <p>Te ayudamos a aprobar tu examen de manejo en el primer intento.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-gray-200 py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Contáctanos</h2>
            <p class="mb-6">¿Tienes preguntas? Estamos aquí para ayudarte.</p>
            <a href="https://web.whatsapp.com/" class="bg-green-500 text-white px-6 py-3 rounded shadow hover:bg-green-600">
                <i class="fab fa-whatsapp mr-2"></i> Contáctanos por WhatsApp
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Autoescuela Unido. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
@endsection
