@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Encabezado con degradado -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Editar Observaciones de Clase
            </h1>
        </div>

        <!-- Información de la clase -->
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Fecha:</span>
                    <span class="ml-2">{{ $clase->fecha }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Horario:</span>
                    <span class="ml-2">{{ $clase->hora_inicio }} - {{ $clase->hora_fin }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="font-medium">Instructor:</span>
                    <span class="ml-2">{{ $clase->instructor->user->name ?? 'N/A' }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            <form method="POST" action="{{ route('clases.update_observaciones', $clase->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="comentario_Inst" class="block text-gray-700 font-medium mb-2">
                        Observaciones
                        <span class="text-red-500">*</span>
                    </label>
                    
                    <textarea 
                        id="comentario_Inst" 
                        name="comentario_Inst" 
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        placeholder="Describa las observaciones relevantes de la clase..."
                        maxlength="250"
                        required>{{ old('comentario_Inst', $clase->comentario_Inst) }}</textarea>
                    
                    <div class="flex justify-between mt-1">
                        <div>
                            @error('comentario_Inst')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-sm text-gray-500">
                            <span id="char-count">0</span>/250 caracteres
                        </div>
                    </div>
                </div>
                
                <!-- Consejos para observaciones -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
                    <h3 class="font-medium text-blue-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Sugerencias para observaciones útiles:
                    </h3>
                    <ul class="mt-2 text-blue-700 text-sm list-disc pl-5 space-y-1">
                        <li>Progreso del estudiante en maniobras específicas</li>
                        <li>Áreas que requieren práctica adicional</li>
                        <li>Comportamiento durante la conducción</li>
                        <li>Incidentes o situaciones relevantes</li>
                    </ul>
                </div>
                
                <!-- Botones -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-200 pt-6">
                    <a href="{{ route('clases.clase_inst') }}" class="w-full sm:w-auto flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver al listado
                    </a>
                    
                    <button type="submit" class="w-full sm:w-auto flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-medium rounded-lg shadow-md transition duration-200 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Guardar Observaciones
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Contador de caracteres
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('comentario_Inst');
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
            if (textarea.value.length > 250) {
                textarea.value = textarea.value.substring(0, 250);
                updateCharCount();
            }
        });
    });
</script>

<style>
    /* Efecto de enfoque mejorado */
    textarea:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        outline: none;
    }
    
    /* Estado con color distintivo */
    .capitalize {
        text-transform: capitalize;
    }
</style>
@endsection