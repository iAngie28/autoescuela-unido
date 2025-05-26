@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Sidebar -->

            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb-"> Lista de Vehiculos</h1>

                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <form id="searchForm" method="GET" action="{{ route('vehiculo.index') }}">
                            <input type="text" name="search" placeholder="Buscar Vehiculo..."
                                class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="searchInput" value="{{ request('search') }}">
                        </form>

                        <a href="{{ route('vehiculo.create') }}" target="_blank">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                Agregar Nuevo Vehiculo
                            </button>
                        </a>
                    </div>
<!-- Script para búsqueda con Enter -->
            <script>
                document.getElementById("searchInput").addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        let searchValue = this.value.trim();

                        if (searchValue === "") {
                            window.location.href = "{{ route('vehiculo.index') }}";
                        } else {
                            document.getElementById("searchForm").submit();
                        }
                    }
                });
            </script>

            <!-- Tabla de Vehículos -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Placa</th>
                            <th class="py-3 px-6 text-left">Modelo</th>
                            <th class="py-3 px-6 text-left">Características</th>
                            <th class="py-3 px-6 text-left">Tipo de Vehículo</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($vehiculos as $vehiculo)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $vehiculo->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $vehiculo->placa }}</td>
                                <td class="py-3 px-6 text-left">{{ $vehiculo->modelo }}</td>
                                <td class="py-3 px-6 text-left">{{ $vehiculo->caracteristicas }}</td>
                                <td class="py-3 px-6 text-left">{{ $vehiculo->tipoVehiculo->nombre }}</td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('vehiculo.edit', $vehiculo->id) }}" class="text-blue-500 hover:scale-110">📝 Editar</a>
                                        <form action="{{ route('vehiculo.destroy', $vehiculo->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:scale-110">🗑 Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $vehiculos->links() }}
            </div>
        </section>
            </main>

        </div>

        <!-- Footer -->


    </div>
@endsection
