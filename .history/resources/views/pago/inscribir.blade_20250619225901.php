@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Inscribir Pago #{{ $pago->id }}</h2>
        
        <p class="mb-4">Detalle: {{ $pago->detalle }}</p>
        <p class="mb-4">Monto: {{ $pago->monto }} Bs</p>

        {{-- Acá podés poner el formulario para inscripción según si es grupo o paquete --}}
        <div class="mt-6">
            <a href="{{ route('pagos.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
               Volver
            </a>
        </div>
    </div>
</div>
@endsection
