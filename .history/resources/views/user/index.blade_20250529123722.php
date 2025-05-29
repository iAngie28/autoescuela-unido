@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Sidebar -->



            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb-"> Lista de Usuarios</h1>

                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <form id="searchForm" method="GET" action="{{ route('users.index') }}">
                            <input type="text" name="search" placeholder="Buscar usuarios..."
                                class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="searchInput" value="{{ request('search') }}">
                        </form>

                        <a href="{{ route('register') }}" target="_blank">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                Agregar Nuevo Usuario
                            </button>
                        </a>
                    </div>

                    <script>
                        document.getElementById("searchInput").addEventListener("keypress", function(event) {
                            if (event.key === "Enter") {
                                event.preventDefault();
                                let searchValue = this.value.trim();

                                if (searchValue === "") {
                                    window.location.href = "{{ route('users.index') }}"; // Solo recargar si el campo está vacío
                                } else {
                                    document.getElementById("searchForm").submit(); // Realizar búsqueda
                                }
                            }
                        });
                    </script>



                    <!-- User Table -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Nombre</th>
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-left">Rol</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $user->id }}</td>
                                        <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                                        <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                                        <td class="py-3 px-6 text-left">{{ $user->rol->nombre ?? 'Sin rol' }}</td>

                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="text-blue-500 hover:scale-110">📝 Editar</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:scale-110">🗑
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
                        {{ $users->links() }}
                    </div>
                </section>
            </main>

        </div>

        <!-- Footer -->


    </div>
@endsection
