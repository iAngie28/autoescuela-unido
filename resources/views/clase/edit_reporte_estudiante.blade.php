@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Encabezado -->
        <div class="bg-gradient-to-r from-red-500 to-orange-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Reportar Incidente en Clase
            </h1>
        </div>

        <!-- Información de la clase -->
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Fecha:</span>
                    <span class="ml-2">{{ $clase->fecha }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Horario:</span>
                    <span class="ml-2">{{ $clase->hora_inicio }} - {{ $clase->hora_fin }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="font-medium">Instructor:</span>
                    <span class="ml-2">{{ $clase->instructor->user->name ?? 'N/A' }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium">Estado:</span>
                    <span class="ml-2 capitalize px-2 py-1 rounded-full text-xs font-bold 
                        @if($clase->estado == 'completada') bg-green-100 text-green-800
                        @elseif($clase->estado == 'cancelada') bg-red-100 text-red-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ $clase->estado }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <div class="px-6 py-5">
            <form method="POST" action="{{ route('clases.update_reporte_estudiante', $clase->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="reporte_estudiante" class="block text-gray-700 font-medium mb-2">
                        Descripción del Incidente
                        <span class="text-red-500">*</span>
                    </label>
                    
                    <textarea 
                        id="reporte_estudiante" 
                        name="reporte_estudiante" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                        placeholder="Describa el incidente ocurrido durante la clase..."
                        maxlength="100"
                        required>{{ old('reporte_estudiante', $clase->reporte_estudiante) }}</textarea>
                    
                    <div class="flex justify-between mt-1">
                        <div>
                            @error('reporte_estudiante')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-sm text-gray-500">
                            <span id="char-count">0</span>/100 caracteres
                        </div>
                    </div>
                </div>
                
                <!-- Tipos comunes de incidentes -->
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <h3 class="font-medium text-red-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Ejemplos de incidentes a reportar:
                    </h3>
                    <ul class="mt-2 text-red-700 text-sm list-disc pl-5 space-y-1">
                        <li>Comportamiento inapropiado del instructor</li>
                        <li>Problemas con el vehículo durante la clase</li>
                        <li>Incumplimiento del horario establecido</li>
                        <li>Situaciones de inseguridad vial</li>
                        <li>Falta de material didáctico necesario</li>
                    </ul>
                </div>
                
                <!-- Botones -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-200 pt-6">
                    <a href="{{ route('clases.clase_est') }}" class="w-full sm:w-auto flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver al listado
                    </a>
                    
                    <button type="submit" class="w-full sm:w-auto flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-red-600 to-orange-700 hover:from-red-700 hover:to-orange-800 text-white font-medium rounded-lg shadow-md transition duration-200 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Enviar Reporte
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Contador de caracteres
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('reporte_estudiante');
        const charCount = document.getElementById('char-count');
        
        // Actualizar contador
        function updateCharCount() {
            charCount.textContent = textarea.value.length;
        }
        
        // Inicializar
        updateCharCount();
        
        // Escuchar cambios
        textarea.addEventListener('input', updateCharCount);
        
        // Validación de longitud
        textarea.addEventListener('input', function() {
            if (textarea.value.length > 100) {
                textarea.value = textarea.value.substring(0, 100);
                updateCharCount();
            }
        });
    });
</script>

<style>
    /* Efecto de enfoque mejorado */
    textarea:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25);
        outline: none;
    }
    
    /* Estado con color distintivo */
    .capitalize {
        text-transform: capitalize;
    }
</style>
@endsection