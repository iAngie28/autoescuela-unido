@extends('layouts.app')
@section('background-class', 'bg-gray-900 text-gray-100')
@section('content')
<div class="flex flex-col min-h-screen bg-gray-900 text-gray-100">
    <main class="flex-1 flex flex-col justify-center items-center px-4 py-8">
        @stack('scripts')
        <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg w-full max-w-2xl p-8 border border-gray-700">
            <h1 class="text-3xl font-bold text-left mb-8">Crear Grupo Examen</h1>

            <form method="POST" action="{{ route('grupo-examen.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('grupo-examan.form')
            </form>
        </section>
    </main>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fechaInicioInput = document.getElementById('fecha_inicio');
        const fechaFinInput = document.getElementById('fecha_fin');

        // Solo permitir lunes
        fechaInicioInput.addEventListener('input', function () {
            const fecha = new Date(this.value);
            const diaSemana = fecha.getUTCDay(); // 1 = lunes

            if (diaSemana !== 1) {
                alert('Solo se permite seleccionar un LUNES como fecha de inicio.');
                this.value = '';
                fechaFinInput.value = '';
                return;
            }

            // Calcular 6 días después
            const fechaFin = new Date(fecha);
            fechaFin.setDate(fecha.getDate() + 6);

            const año = fechaFin.getFullYear();
            const mes = String(fechaFin.getMonth() + 1).padStart(2, '0');
            const dia = String(fechaFin.getDate()).padStart(2, '0');

            fechaFinInput.value = `${año}-${mes}-${dia}`;
        });
    });
</script>
@endpush
@endsection
