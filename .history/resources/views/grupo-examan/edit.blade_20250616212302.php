@extends('layouts.app') {{-- Cambia guest-bootstrap por app para usar los estilos del segundo formulario --}}
@section('background-class', 'bg-gray-900 text-gray-100')
@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">
        <main class="flex-1 bg-gray-900 text-gray-100 p-6">
            @stack('scripts')
            <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-700">
                <h1 class="text-3xl font-bold text-left mb-8">Actualizar Grupo Examen</h1>

                <form method="POST" action="{{ route('grupo-examen.update', $grupoExaman->id) }}" role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    @include('grupo-examan.form')
                </form>
            </section>
        </main>
    </div>
</div>
@endsection
