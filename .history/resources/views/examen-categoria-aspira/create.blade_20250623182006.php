@extends('layouts.app')

@section('background-class', 'bg-gray-900 text-gray-100')

@section('content')
<div class="flex flex-col min-h-screen bg-gray-900 text-gray-100">
    <main class="flex-1 flex flex-col justify-center items-center px-4 py-8">
        <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg w-full max-w-2xl p-8 border border-gray-700">
            <h1 class="text-3xl font-bold text-left mb-8">Crear Categoría de Examen</h1>

            <form method="POST" action="{{ route('examen-categoria-aspiras.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('examen-categoria-aspira.form')
            </form>
        </section>
    </main>
</div>
@endsection
