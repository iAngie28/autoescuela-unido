@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white text-black py-10 px-4 rounded-lg shadow">
                    <h1 class="text-3xl font-bold mb-6 text-left">Inscribir a Grupo</h1>

                    <!-- Mensajes de éxito -->
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

                    <!-- Tabla -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Nombre</th>
                                    <th class="py-3 px-6 text-center">Categoría</th>
                                    <th class="py-3 px-6 text-center">Grupo Activo</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($estudiantes as $estudiante)
                                    @php
                                        $inscripcion = $inscripciones[$estudiante->id] ?? null;
                                    @endphp
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $estudiante->id }}</td>
                                        <td class="py-3 px-6 text-left">{{ $estudiante->name }}</td>

                                        <td class="py-3 px-6 text-center">
                                            <form action="{{ route('inscribir_grupo') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                                                <select name="categoria_id"
                                                    class="w-full px-2 py-1 border border-gray-300 rounded-md" required>
                                                    <option value="">Seleccionar</option>
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"
                                                            {{ $inscripcion && $inscripcion->id_categoria == $categoria->id ? 'selected' : '' }}>
                                                            {{ $categoria->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                            <select name="grupo_id"
                                                class="w-full px-2 py-1 border border-gray-300 rounded-md" required>
                                                <option value="">Seleccionar</option>
                                                @foreach ($grupoExamenActivos as $grupo)
                                                    <option value="{{ $grupo->id }}"
                                                        {{ $inscripcion && $inscripcion->id_grupo == $grupo->id ? 'selected' : '' }}>
                                                        {{ $grupo->id }} - {{ $grupo->fecha_inicio }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                            <select name="id_pago"
                                                class="w-full px-2 py-1 border border-gray-300 rounded-md" required>
                                                <option value="">Seleccionar</option>
                                                @foreach ($pagosPorEstudiante[$estudiante->id] ?? [] as $pago)
                                                    <option value="{{ $pago->id }}">
                                                        Pago #{{ $pago->id }} -
                                                        {{ \Illuminate\Support\Str::limit($pago->detalle, 40) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>


                                        <td class="py-3 px-6 text-center">
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition duration-300">
                                                Inscribir
                                            </button>
                                            </form>
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
