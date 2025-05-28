@extends('layouts.app')

@section('content')

<body class="bg-gray-100 text-gray-800">


    <!-- Hero Section -->
    <section class="bg-green-500 text-white py-20">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl font-bold mb-4">
                Bienvenido Instructor(a)
                @auth
                    @if (Auth::user()->id_rol === 3)
                    {{ strtoupper(Auth::user()->name) }}

                    @else
                        "Nuestros Instructores"
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



</body>
@endsection
