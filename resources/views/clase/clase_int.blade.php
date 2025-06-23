@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb- py-3"> Clases</h1>

                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 p-4 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Roles Table -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">ID</th>
                                    <th class="py-3 px-6 text-center">Fecha</th>
                                    <th class="py-3 px-6 text-center">Hora Inicio</th>
                                    <th class="py-3 px-6 text-center">Hora Fin</th>
                                    <th class="py-3 px-6 text-center">Id Instructor</th>
                                    <th class="py-3 px-6 text-center">Estado</th>
                                    <th class="py-3 px-6 text-center">Observaciones</th>
                                    <th class="py-3 px-6 text-center">Reporte Estudiante</th> <!-- Nueva columna -->
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($clases as $clase)
                                    <tr data-estado="{{ strtolower($clase->estado) }}"
                                        class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $clase->id }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->fecha }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->hora_inicio }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->hora_fin }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->id_inst }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->estado }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="mb-2 min-w-[200px] max-w-[300px] mx-auto">
                                                <div class="text-left break-words">
                                                    {{ $clase->comentario_Inst ?? 'Sin observaciones' }}
                                                </div>
                                            </div>
                                            <a href="{{ route('clases.edit_observaciones', $clase->id) }}" 
                                               class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                Editar
                                            </a>
                                        </td>
                                        
                                        <!-- Columna de Reporte Estudiante -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="max-w-xs mx-auto">
                                                <div class="text-left break-words bg-gray-50 p-2 rounded">
                                                    @if($clase->reporte_estudiante)
                                                        {{ $clase->reporte_estudiante }}
                                                    @else
                                                        <span class="text-gray-400 italic">Sin reporte</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $clases->withQueryString()->links() }}
                    </div>
                </section>

            </main>

        </div>
    @endsection