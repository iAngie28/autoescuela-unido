@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Detalles del Reporte #{{ $reporteFalla->id }}</h2>
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                    @if($reporteFalla->estado == 'pendiente') bg-red-100 text-red-800
                    @elseif($reporteFalla->estado == 'revisado') bg-yellow-100 text-yellow-800
                    @else bg-green-100 text-green-800 @endif">
                    {{ ucfirst($reporteFalla->estado) }}
                </span>
            </div>
        </div>

        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Vehículo</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-800"><span class="font-semibold">Placa:</span> {{ $reporteFalla->vehiculo->placa }}</p>
                        <p class="text-gray-800"><span class="font-semibold">Modelo:</span> {{ $reporteFalla->vehiculo->modelo }}</p>
                        <p class="text-gray-800"><span class="font-semibold">Tipo:</span> {{ $reporteFalla->vehiculo->tipoVehiculo->nombre ?? 'N/A' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Reportado por</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-800"><span class="font-semibold">Nombre:</span> {{ $reporteFalla->instructor->name }}</p>
                        <p class="text-gray-800"><span class="font-semibold">Fecha:</span> {{ $reporteFalla->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Descripción de la falla</h3>
                <div class="bg-gray-50 p-4 rounded-lg whitespace-pre-line">{{ $reporteFalla->descripcion }}</div>
            </div>

            @if(auth()->user()->id_rol == 1) {{-- Solo admin --}}
            <div class="mt-6 border-t border-gray-200 pt-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Cambiar Estado</h3>
                <form method="POST" action="{{ route('reporte-fallas.cambiar-estado', $reporteFalla->id) }}" class="flex items-center space-x-4">
                    @csrf
                    @method('PATCH')
                    <select name="estado" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="pendiente" {{ $reporteFalla->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="revisado" {{ $reporteFalla->estado == 'revisado' ? 'selected' : '' }}>Revisado</option>
                        <option value="solucionado" {{ $reporteFalla->estado == 'solucionado' ? 'selected' : '' }}>Solucionado</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Actualizar Estado
                    </button>
                </form>
            </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
            <a href="{{ route('reporte-fallas.index') }}" 
               class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection