@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb- py-3">Asignar Vehículo y Especialidad</h1>

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
                                    <th class="py-3 px-6 text-center">Especialidad </th>
                                    <th class="py-3 px-6 text-center">Vehículo Asignado</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($instructors as $instructor)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $instructor->id }}</td>
                                        <td class="py-3 px-6 text-center">{{ $instructor->usuario->name ?? 'Sin nombre' }}</td>
                                        <td class="py-3 px-6 text-center">{{ $instructor->categ_licencia }}</td>

                                        <form action="{{ route('instructor.asignar_vehiculo', $instructor->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td class="py-3 px-6 text-center">
                                                <input type="text" name="epc" value="{{ $instructor->epc }}"
                                                    class="border rounded px-2 py-1 w-full">
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <select name="vehiculo" class="form-select border rounded px-2 py-1">
                                                    <option value="">Seleccione un vehículo</option>
                                                    @foreach ($vehiculo as $v)
                                                        <option value="{{ $v->id }}"
                                                            {{ $v->id == $instructor->id_vehiculo ? 'selected' : '' }}>
                                                            {{ $v->placa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <button type="submit" class="text-blue-500 hover:text-blue-700"
                                                        onclick="return confirm('¿Seguro que deseas guardar los cambios?')">
                                                        Guardar Cambios
                                                    </button>
                                                </div>
                                            </td>
                                        </form>
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
    </div>
@endsection
