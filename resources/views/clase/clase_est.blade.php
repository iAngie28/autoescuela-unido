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
                                    <th class="py-3 px-6 text-center">Reporte</th> <!-- Nueva columna -->
                                    <th class="py-3 px-6 text-center">Acciones</th>
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
                                        
                                        <!-- Columna de Observaciones -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="max-w-xs mx-auto">
                                                <div class="text-left break-words bg-gray-50 p-2 rounded">
                                                    @if($clase->comentario_Inst)
                                                        {{ $clase->comentario_Inst }}
                                                    @else
                                                        <span class="text-gray-400 italic">Sin observaciones</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Columna de Reporte -->
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

                                        <td class="py-3 px-3 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <!-- Botón para reportar incidente -->
                                                <a href="{{ route('clases.edit_reporte_estudiante', $clase->id) }}" 
                                                   class="text-red-500 hover:scale-110 hover:text-red-700 text-sm">
                                                    Reportar Incidente
                                                </a>
                                                
                                                <!-- Botón para cancelar clase -->
                                                <form action="{{ route('clases.cancelar', $clase->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-red-500 hover:scale-110 hover:text-red-700 text-sm"
                                                        onclick="return confirm('¿Cancelar esta clase?')">
                                                        Cancelar Clase
                                                    </button>
                                                </form>
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