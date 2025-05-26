@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Sidebar -->


            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-blue-500 text-white py-20 text-center">
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
                    <p class="text-lg mb-6">Cursos personalizados para todos los niveles. ¡Obtén tu licencia fácilmente!
                    </p>
                    <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded shadow hover:bg-gray-100">Ver
                        Cursos</a>
                </section>
            </main>
        </div>


    </div>
@endsection
