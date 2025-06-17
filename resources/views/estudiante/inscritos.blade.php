@extends('layouts.app')

@section('content')

    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg md:max-w-2xl lg:max-w-4xl mx-auto">
                    <h1 class="text-3xl font-bold text-left mb-6 sm:text-xl md:text-2xl lg:text-3xl">
                        Lista de Estudiantes Inscritos
                    </h1>

                    <!-- Barra de búsqueda -->
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <form id="searchForm" method="GET" action="{{ route('estudiantes.index') }}">
                            <input type="text" name="search" placeholder="Buscar estudiantes..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm md:text-base"
                                id="searchInput" value="{{ request('search') }}">
                        </form>
                    </div>

                    <!-- Tabla de estudiantes -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase leading-normal">
                                    <th class="py-3 px-6 text-left">Nombre</th>
                                    <th class="py-3 px-6 text-left">Correo</th>
                                    <th class="py-3 px-6 text-center">Mayor Nota</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($estudiantes as $estudiante)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left" >
                                            {{ $estudiante->name }}
                                        </td>
                                        <td class="py-3 px-6 text-left" >
                                            {{ $estudiante->email }}
                                        </td>
                                        <td class="py-3 px-6 text-center" >
                                            {{ $estudiante->evaluaciones()->max('nota_final') }}
                                        </td>
                                        <td class="py-3 px-6 text-center" >
                                            <a href="{{ route('examen.tomar', $estudiante->id) }}"
                                                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition duration-300">
                                                📝 Tomar Examen
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $estudiantes->links() }}
                    </div>
                </section>
            </main>
        </div>
    </div>

<style>
@media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
        width: 100%;
    }
    thead tr {
        display: none;
    }
    tr {
        margin-bottom: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }
    td {
        position: relative;
        padding-left: 55%; /* Aumenta el espacio para el label */
        text-align: left;
        border: none;
        min-height: 2.5rem; /* Opcional: asegura altura mínima */
        word-break: break-word; /* Evita desbordes de texto */
    }
    td:before {
        position: absolute;
        left: 1rem;
        top: 0.75rem;
        width: 48%; /* Un poco más de ancho para el label */
        min-width: 90px; /* Opcional: asegura que el label no se corte */
        white-space: nowrap;
        font-weight: bold;
        color: #6b7280;
        content: attr(data-label);
        overflow: hidden;
        text-overflow: ellipsis;
    }
}
</style>
@endsection
