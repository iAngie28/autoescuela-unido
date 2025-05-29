@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">


        <!-- Contenido principal -->
        <main class="flex-1 bg-gray-100 text-gray-800 p-6">
            <section class="bg-white-500 text-black py-10 text-center">
                <h1 class="text-3xl font-bold text-left mb- py-3"> Reprogramar Clases</h1>


                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <!-- Roles Table -->
                <div class="overflow-x-auto max-w-full bg-white rounded-lg shadow">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Fecha</th>
                                <th class="py-3 px-6 text-left">Hora Inicio</th>
                                <th class="py-3 px-6 text-left">Hora Fin</th>
                                <th class="py-3 px-6 text-left">Id Instructor</th>
                                <th class="py-3 px-6 text-left">Estado</th>
                                <th class="py-3 px-6 text-center">Accion</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @foreach ($clases as $clase)
                            <tr data-estado="{{ strtolower($clase->estado) }}" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $clase->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->fecha }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->hora_inicio}}</td>
                                <td class="py-3 px-6 text-left">{{  $clase->hora_fin}}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->id_inst }}</td>
                                <td class="py-3 px-6 text-left">{{ $clase->estado}}</td>

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

    </div>


@endsection