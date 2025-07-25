@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-900 text-gray-100 p-6">
                <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-700">
                    <h1 class="text-3xl font-bold text-left mb-8">Editar Usuario</h1>
                    
                    @include('user.form')
                </section>
            </main>
        </div>
    </div>
@endsection