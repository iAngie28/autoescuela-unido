@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Sidebar -->


            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb-">Grupos</h1>

                    <div class="flex flex-wrap items-center justify-between mb-6 " style="margin-top: 20px;">
                        <form id="filterForm" method="GET" action="{{ route('grupo-examen.index') }}">
                            <select name="estado" id="estadoSelect"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="document.getElementById('filterForm').submit();">
                                <option value="">Todos los estados</option>
                                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>
                                    Finalizado</option>
                            </select>
                        </form>


                        <a href="{{ route('grupo-examen.create') }}" target="_blank">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                Agregar Nuevo Grupo
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
                        document.getElementById("searchInput").addEventListener("keypress", function(event) {
                            if (event.key === "Enter") {
                                event.preventDefault();
                                let searchValue = this.value.trim();

                                if (searchValue === "") {
                                    window.location.href =
                                        "{{ route('grupo-examen.index') }}"; // Solo recargar si el campo está vacío
                                } else {
                                    document.getElementById("searchForm").submit(); // Realizar búsqueda
                                }
                            }
                        });
                    </script>



                    <!-- Roles Table -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Estado</th>
                                    <th class="py-3 px-6 text-left">Fecha Inicio</th>
                                    <th class="py-3 px-6 text-center">Fecha Fin</th>
                                    <th class="py-3 px-6 text-center">Capacidad</th>
                                    <th class="py-3 px-6 text-center">Fecha Hora</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($grupoExamen as $grupoExaman)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $grupoExaman->id }}</td>
                                        <td class="py-3 px-6 text-left">{{ $grupoExaman->estado }}</td>
                                        <td class="py-3 px-6 text-left">{{ $grupoExaman->fecha_inicio }}</td>
                                        <td class="py-3 px-6 text-left">{{ $grupoExaman->fecha_fin }}</td>
                                        <td class="py-3 px-6 text-left">{{ $grupoExaman->capacidad }}</td>
                                        <td class="py-3 px-6 text-left">{{ $grupoExaman->fecha_hora }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('grupo-examen.edit', $grupoExaman->id) }}"
                                                    class="text-blue-500 hover:scale-110">📝 Editar</a>
                                                <!--<a href="{{ route('grupo-examen.show', $grupoExaman->id) }}"
                                                    class="text-blue-500 hover:scale-110">📝 Notas</a>-->
                                                <form action="{{ route('grupo-examen.destroy', $grupoExaman->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="event.preventDefault(); confirm('Seguro que desea eliminar?') ? this.closest('form').submit() : false;"
                                                        class="text-red-500 hover:scale-110">🗑
                                                        Eliminar</button>
                                                </form>
                                                <form action="{{ route('grupo-examen.exportar-excel', $grupoExaman->id) }}"
                                                    method="POST" target="_blank">
                                                    @csrf
                                                    <button type="submit" class="text-green-500 hover:scale-110">
                                                        📥 <br> Generar Excel
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
                        {{ $grupoExamen->links() }}
                    </div>
                </section>

            </main>

        </div>

        <!-- Footer -->


    </div>
@endsection
