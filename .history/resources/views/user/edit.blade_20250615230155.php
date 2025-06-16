@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white text-black py-10 text-center shadow-lg rounded-lg max-w-4xl mx-auto">
                    <h1 class="text-3xl font-bold text-left mb-6 px-6">Editar Usuario</h1>

                    @include('user.form')
                </section>
            </main>

        </div>
    </div>
@endsection
