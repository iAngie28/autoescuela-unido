@extends('layouts.app')

@section('background-class', 'bg-gray-900 text-gray-100')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">
        <main class="flex-1 bg-gray-900 text-gray-100 p-6">
            <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-700">
                <h1 class="text-3xl font-bold text-left mb-8">Actualizar Categoría de Examen</h1>

                <form method="POST" action="{{ route('examen-categoria-aspiras.update', $examenCategoriaAspira->id) }}" role="form" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    @include('examen-categoria-aspira.form')
                </form>
            </section>
        </main>
    </div>
</div>
@endsection
