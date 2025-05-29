@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">
        <main class="flex-1 bg-gray-100 text-gray-800">
            <section class="py-10 text-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-left mb-4">Clases</h1>

                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <select id="filtroEstado" class="form-select" onchange="filtrarPorEstado()">
                            <option value="">Todos</option>
                            <option value="programada">Programada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                        <a href="{{ route('clases.create') }}" target="_blank">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                Agregar Nueva Clase
                            </button>
                        </a>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
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

                    <!-- Solución responsive y sin overflow -->
                    <div class="w-full overflow-x-auto rounded-lg shadow bg-white">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-2 text-left text-xs font-medium text-gray-700 uppercase">ID</th>
                                    <th class="py-3 px-2 text-left text-xs font-medium text-gray-700 uppercase">Fecha</th>
                                    <th class="py-3 px-2 text-left text-xs font-medium text-gray-700 uppercase">Hora Inicio</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Hora Fin</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Estado</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Comentario Instructor</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Reporte</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Id Paquete</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Id Instructor</th>
                                    <th class="py-3 px-2 text-center text-xs font-medium text-gray-700 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @foreach ($clases as $clase)
                                <tr data-estado="{{ strtolower($clase->estado) }}">
                                    <td class="py-2 px-2 text-left">{{ $clase->id }}</td>
                                    <td class="py-2 px-2 text-left">{{ $clase->fecha }}</td>
                                    <td class="py-2 px-2 text-left">{{ $clase->hora_inicio }}</td>
                                    <td class="py-2 px-2 text-center">{{ $clase->hora_fin }}</td>
                                    <td class="py-2 px-2 text-center">{{ $clase->estado }}</td>
                                    <td class="py-2 px-2 text-center">{{ $clase->comentario_Inst }}</td>
                                    <td class="py-2 px-2 text-center">{{ $clase->reporte_estudiante }}</td>
                                    <td class="py-2 px-2 text-center">{{ $clase->id_paquete }}</td>
                                    <td class="py-2 px-2 text-center">{{ $clase->id_inst }}</td>
                                    <td class="py-2 px-2 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('clases.edit', $clase->id) }}" class="text-blue-500 hover:scale-110">📝 Editar</a>
                                            <form action="{{ route('clases.destroy', $clase->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:scale-110"
                                                    onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                    🗑 Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $clases->withQueryString()->links() }}
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
@endsection
