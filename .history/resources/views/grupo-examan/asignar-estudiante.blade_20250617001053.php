@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white text-black py-10 px-4 rounded-lg shadow">
                    <h1 class="text-3xl font-bold mb-6 text-left">Estudiantes</h1>

                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <!-- Botón de Crear -->
                        <a href="{{ route('estudiantes.create') }}">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                Agregar Nuevo Estudiante
                            </button>
                        </a>
                    </div>

                    <!-- Mensajes de éxito -->
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                            {{ $message }}
                        </div>
                    @endif

                    <!-- Tabla -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">#</th>
                                    <th class="py-3 px-6 text-left">Fecha de Registro</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($estudiantes as $estudiante)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $estudiante->id }}</td>
                                        <td class="py-3 px-6 text-left">{{ $estudiante->fecha_reg }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('estudiantes.show', $estudiante->id) }}"
                                                    class="text-blue-500 hover:scale-110">👁 Ver</a>
                                                <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                                                    class="text-green-500 hover:scale-110">✏ Editar</a>
                                                <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="event.preventDefault(); confirm('¿Seguro que desea eliminar?') ? this.closest('form').submit() : false;"
                                                        class="text-red-500 hover:scale-110">🗑 Eliminar</button>
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
                        {!! $estudiantes->withQueryString()->links() !!}
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection
