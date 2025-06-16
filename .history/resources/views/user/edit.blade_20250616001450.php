@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white text-gray-900 shadow-lg rounded-lg max-w-2xl mx-auto p-8">
                    <h1 class="text-3xl font-bold text-left mb-8">Editar Usuario</h1>
                    
                    @include('user.form')
                </section>
            </main>
        </div>
    </div>
@endsection
