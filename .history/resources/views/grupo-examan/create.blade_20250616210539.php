@extends('layouts.app') {{-- Cambio de layout para heredar el estilo del formulario oscuro --}}

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">
        <main class="flex-1 bg-gray-900 text-gray-100 p-6 min-h-screen">

            <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-700">
                <h1 class="text-3xl font-bold text-left mb-8">Crear Grupo Examen</h1>

                <form method="POST" action="{{ route('grupo-examen.store') }}" role="form" enctype="multipart/form-data">
                    @csrf

                    @include('grupo-examan.form')
                </form>
            </section>
        </main>
    </div>
</div>
@endsection
