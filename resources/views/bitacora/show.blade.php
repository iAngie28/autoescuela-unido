@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="bg-gray-800 dark:bg-gray-900 px-4 py-5 border-b border-gray-700 sm:px-6">
            <h2 class="text-xl font-semibold text-white">Detalle del Registro de Bitácora</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $bitacora->id }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Usuario</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                        @if($bitacora->user)
                            {{ $bitacora->user->name }} (ID: {{ $bitacora->id_user }})
                        @else
                            <span class="text-red-500">Usuario Eliminado (ID: {{ $bitacora->id_user }})</span>
                        @endif
                    </p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Dirección IP</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $bitacora->ip }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha y Hora</h3>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $bitacora->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Acción</h3>
                <div class="mt-1 bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                    <p class="text-sm text-gray-800 dark:text-gray-200 whitespace-pre-wrap">{{ $bitacora->accion }}</p>
                </div>
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('bitacora.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    <span class="material-symbols-outlined mr-2">arrow_back</span>
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>
@endsection