@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">


            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb- py-3"> Reprogramar Clases</h1>


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
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">ID</th>
                                    <th class="py-3 px-6 text-center">Hora Inicio</th>
                                    <th class="py-3 px-6 text-center">Hora Fin</th>
                                    <th class="py-3 px-6 text-center">Id Instructor</th>
                                    <th class="py-3 px-6 text-center">Estado</th>
                                    <th class="py-3 px-6 text-center">Fecha</th>
                                    <th class="py-3 px-6 text-center">Accion</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($clases as $clase)
                                    <tr data-estado="{{ strtolower($clase->estado) }}"
                                        class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $clase->id }}</td>

                                        

                                        <td class="py-3 px-6 text-center">{{ $clase->hora_inicio }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->hora_fin }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->id_inst }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->estado }}</td>

                                        <td class="py-3 px-6 text-center">
                                            <form action="{{ route('clases.reprogramar', $clase->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="date" name="nueva_fecha"
                                                    value="{{ old('nueva_fecha', $clase->fecha) }}"
                                                    min="{{ date('Y-m-d') }}" class="border rounded p-1 text-sm w-full"
                                                    onchange="this.form.submit()">
                                            </form>
                                        </td>

                                        <td class="py-3 px-3 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <form action="{{ route('clases.reprogramar', $clase->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-blue-500 hover:scale-110" onclick="event.preventDefault(); confirm('Seguro que desea reprogramar?') ? this.closest('form').submit() : false;">
                                                        🔄 Reprogramar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>


                                        //
                                        
        <form action="{{ route('clases.reprogramar', $clase->id) }}" method="POST" class="flex items-center gap-2">
            @csrf
            @method('PUT')
            <td class="py-3 px-6 text-center">
            <input 
                type="date"
                name="nueva_fecha"
                value="{{ old('nueva_fecha', $clase->fecha) }}"
                min="{{ date('Y-m-d') }}"
                class="border rounded p-1 text-sm"
            >
                </td>
                <td class="py-3 px-6 text-center">
            <button type="submit" 
                    class="ml-2 text-blue-500 hover:scale-110"
                    onclick="return confirm('Seguro que desea reprogramar?');">
                🔄 Reprogramar
            </button>
                </td>
        </form>


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
