@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">

        <!-- Contenido principal -->
        <main class="flex-1 bg-gray-100 text-gray-800 p-6">
            <section class="bg-white-500 text-black py-10 text-center">
                <h1 class="text-3xl font-bold text-left mb-"> Clases</h1>

                <div class="flex flex-wrap items-center justify-between mb-6 " style="margin-top: 20px;">
                    <select id="filtroEstado" class="form-select" onchange="filtrarPorEstado()">
                        <option value="">Todos</option>
                        <option value="programada">Programada</option>
                        <option value="cancelada">Cancelada</option>
                        <!-- Agregar más estados si es necesario -->
                    </select>

                    <a href="{{ route('clases.create') }}" target="_blank">
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                            Agregar Nueva Clase
                        </button>
                    </a>
                </div>

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

                <script>
                    function filtrarPorEstado() {
                        const estadoSeleccionado = document.getElementById('filtroEstado').value.toLowerCase();
                        const filas = document.querySelectorAll('table tbody tr');

                        filas.forEach(fila => {
                            const estado = fila.dataset.estado;
                            if (!estadoSeleccionado || estado === estadoSeleccionado) {
                                fila.style.display = '';
                            } else {
                                fila.style.display = 'none';
                            }
                        });
                    }
                </script>

                <!-- Roles Table -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-3 text-center">ID</th>
                                <th class="py-3 px-3 text-center">Fecha</th>
                                <th class="py-3 px-3 text-center">Hora Inicio</th>
                                <th class="py-3 px-3 text-center">Hora Fin</th>
                                <th class="py-3 px-3 text-center">Estado</th>
                                <th class="py-3 px-3 text-center">Observaciones Instructor</th>
                                <th class="py-3 px-3 text-center">Reporte Estudiante</th>
                                <th class="py-3 px-3 text-center">Id Paquete</th>
                                <th class="py-3 px-3 text-center">Id Instructor</th>
                                <th class="py-3 px-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @foreach ($clases as $clase)
                            <tr data-estado="{{ strtolower($clase->estado) }}" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-3 text-center">{{ $clase->id }}</td>
                                <td class="py-3 px-3 text-center">{{ $clase->fecha }}</td>
                                <td class="py-3 px-3 text-center">{{ $clase->hora_inicio}}</td>
                                <td class="py-3 px-3 text-center">{{  $clase->hora_fin}}</td>
                                <td class="py-3 px-3 text-center">{{ $clase->estado}}</td>
                                
                                <!-- Observaciones Instructor -->
                                <td class="py-3 px-3">
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
                                
                                <!-- Reporte Estudiante -->
                                <td class="py-3 px-3">
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
                                
                                <td class="py-3 px-3 text-center">{{  $clase->id_paquete }}</td>
                                <td class="py-3 px-3 text-center">{{ $clase->id_inst }}</td>

                                <td class="py-3 px-3 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <a href="{{ route('clases.edit', $clase->id) }}"
                                            class="text-blue-500 hover:scale-110 hover:text-blue-700">
                                            📝 Editar
                                        </a>
                                        
                                        <form action="{{ route('clases.destroy', $clase->id) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-500 hover:scale-110 hover:text-red-700 w-full"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta clase?')">
                                                🗑 Eliminar
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('clases.cancelar', $clase->id) }}" method="POST" class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-red-500 hover:scale-110 hover:text-red-700 w-full"
                                                onclick="return confirm('¿Cancelar esta clase?')">
                                                ❌ Cancelar
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