@extends('layouts.app')

@section('content')
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
                    </select>

                    <a href="{{ route('clases.create') }}" target="_blank">
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
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



                <!-- Roles Table -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Fecha</th>
                                <th class="py-3 px-6 text-left">Hora Inicio</th>
                                <th class="py-3 px-6 text-center">Hora Fin</th>
                                <th class="py-3 px-6 text-center">Estado</th>
                                <th class="py-3 px-6 text-center">Comentario Instructor</th>
                                <th class="py-3 px-6 text-center">Reporte</th>
                                <th class="py-3 px-6 text-center">Id Paquete</th>
                                <th class="py-3 px-6 text-center">Id Instructor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @foreach ($clases as $clase)
                            <tr data-estado="{{ strtolower($clase->estado) }}" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $clase->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->hora_inicio}}</td>
                                <td class="py-3 px-6 text-left">{{  $clase->hora_fin}}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->estado}}</td>
                                <td class="py-3 px-6 text-left">{{$clase->comentario_Inst }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->reporte_estudiante }}</td>
                                <td class="py-3 px-6 text-left">{{  $clase->id_paquete }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->id_inst }}</td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('clases.edit', $clase->id) }}"
                                            class="text-blue-500 hover:scale-110">📝 Editar</a>
                                        <form action="{{ route('clases.destroy', $clase->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:scale-110" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">🗑
                                                Eliminar</button>
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

@endsection