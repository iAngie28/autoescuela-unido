@extends('layouts.app')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">

            <div
                class="bg-gray-800 dark:bg-gray-900 px-4 py-5 border-b border-gray-700 sm:px-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">Grupo Examen #{{ $grupoExaman->id }}</h2>
                <a href="{{ route('grupo-examen.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition">
                    <span class="material-symbols-outlined mr-2">arrow_back</span>
                    Volver al listado
                </a>
            </div>

            <div class="p-6 text-gray-900 dark:text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</h3>
                        <p class="mt-1 text-sm">{{ $grupoExaman->estado }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Inicio</h3>
                        <p class="mt-1 text-sm">{{ $grupoExaman->fecha_inicio }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha Fin</h3>
                        <p class="mt-1 text-sm">{{ $grupoExaman->fecha_fin }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Capacidad</h3>
                        <p class="mt-1 text-sm">{{ $grupoExaman->capacidad }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Examen</h3>
                        <p class="mt-1 text-sm">{{ $grupoExaman->fecha_hora }}</p>
                    </div>
                </div>

                @if($estudiantes->count())
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Estudiantes Inscritos</h3>
                        <div class="overflow-x-auto rounded-lg shadow ring-1 ring-black ring-opacity-5">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">CI</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha Nacimiento</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($estudiantes as $index => $estudiante)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $estudiante->estudiante->usuario->name ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $estudiante->examenCategoriaAspira->nombre ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $estudiante->estudiante->usuario->ci ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $estudiante->estudiante->fecha_nacimiento ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">No hay estudiantes inscritos en este grupo.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
