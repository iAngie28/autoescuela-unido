@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">


            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb- py-3"> Asignar Vehiculo</h1>


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
                                <tr>
                                    <th class="py-3 px-6 text-center">ID</th>
                                    <th class="py-3 px-6 text-center">Nombre</th>
                                    <th class="py-3 px-6 text-center">Categoría Licencia</th>
                                    <th class="py-3 px-6 text-center">Vehículo Asignado</th>
                                    <th class="py-3 px-6 text-center">Accion</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($instructors as $instructor)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $instructor->id }}</td>
                                        <td class="py-3 px-6 text-center">traer nombre de user</td>
                                        <td class="py-3 px-6 text-center">{{ $instructor->categ_licencia }}</td>

                                        <form action="{{ route('instructor.asignar_vehiculo', $instructor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="vehiculo" class="form-select">
        <option value="">Seleccione un vehículo</option>
        @foreach ($vehiculo as $v)
            <option value="{{ $v->id }}" {{ $v->id == $instructor->id_vehiculo ? 'selected' : '' }}>
                {{ $v->placa }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="text-blue-500"
        onclick="return confirm('¿Seguro que deseas asignar este vehículo?')">
        🔄 Asignar
    </button>
</form>

                                        <form action="{{ route('admin-instructor.destroy', $instructor->id) }}"
                                            method="POST">
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

        <!-- Al final de la tabla -->
        <div class="mt-6">
            {{ $instructors->withQueryString()->links() }}
        </div>

        </section>

        </main>

    </div>
@endsection
