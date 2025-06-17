@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="bg-gray-800 dark:bg-gray-900 px-4 py-5 border-b border-gray-700 sm:px-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Registros de Bitácora</h2>
                <form action="{{ route('bitacora.index') }}" method="GET" class="w-1/2">
                    <div class="flex">
                        <input type="text" name="search" class="flex-grow px-4 py-2 rounded-l focus:outline-none" 
                               placeholder="Buscar por acción, IP o usuario..."
                               value="{{ request('search') }}">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Usuario</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">IP</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acción</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha/Hora</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($bitacoras as $bitacora)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $bitacora->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($bitacora->user)
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $bitacora->user->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $bitacora->id_user }}</div>
                            @else
                                <span class="text-sm font-medium text-red-500">Usuario Eliminado</span>
                                <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $bitacora->id_user }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $bitacora->ip }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 max-w-xs truncate">{{ $bitacora->accion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $bitacora->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('bitacora.show', $bitacora->id) }}" 
                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center">
                                <span class="material-symbols-outlined text-base">visibility</span>
                                Ver
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center py-8">
                                <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">history</span>
                                <h5 class="text-lg font-medium text-gray-900 dark:text-white">No se encontraron registros</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            {{ $bitacoras->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection