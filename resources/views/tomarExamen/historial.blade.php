@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="flex flex-1">
        <main class="flex-1 bg-gray-100 text-gray-800 p-6">
            <section class="bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-6">Historial de Evaluaciones</h1>
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Estudiante</th>
                                <th class="py-3 px-6 text-left">Fecha del Examen</th>
                                <th class="py-3 px-6 text-center">Nota</th>
                                <th class="py-3 px-6 text-left">Instructor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse($evaluaciones as $eva)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $eva->estudiante->name ?? '-' }}</td>
                                    <td class="py-3 px-6 text-left">{{ $eva->fecha_evaluacion ? \Carbon\Carbon::parse($eva->fecha_evaluacion)->format('d/m/Y H:i') : '-' }}</td>
                                    <td class="py-3 px-6 text-center">{{ $eva->nota_final }}</td>
                                    <td class="py-3 px-6 text-left">{{ $eva->instructor->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-3 px-6 text-center">No hay evaluaciones registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $evaluaciones->links() }}
                </div>
            </section>
        </main>
    </div>
</div>
@endsection
