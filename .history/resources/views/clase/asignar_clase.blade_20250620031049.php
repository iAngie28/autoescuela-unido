@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb-4">Asignar Estudiante</h1>

                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 mb-4">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 p-4 mb-4">{{ session('error') }}</div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">ID</th>
                                    <th class="py-3 px-6 text-center">Hora Inicio</th>
                                    <th class="py-3 px-6 text-center">Hora Fin</th>
                                    <th class="py-3 px-6 text-center">Fecha</th>
                                    <th class="py-3 px-6 text-center">Estado</th>
                                    <th class="py-3 px-6 text-center">Instructor</th>
                                    <th class="py-3 px-6 text-center">Estudiante</th>
                                    <th class="py-3 px-6 text-center">Pago</th>
                                    <th class="py-3 px-6 text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($clases as $clase)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $clase->id }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->hora_inicio }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->hora_fin }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->fecha }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->estado }}</td>
                                        <td class="py-3 px-6 text-center">{{ $clase->id_inst }}</td>

                                        <td class="py-3 px-6 text-center">
                                            <select name="nid_est" class="form-select estudiante-select" data-clase-id="{{ $clase->id }}">
                                                <option value="">Seleccione un estudiante</option>
                                                @foreach ($usuariosEstudiante as $usuario)
                                                    @if ($usuario->estudiante)
                                                        <option value="{{ $usuario->estudiante->id }}">
                                                            {{ $usuario->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                            <select name="id_pago" class="form-select pago-select">
                                                <option value="">Seleccione un pago</option>
                                            </select>
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                            <form action="{{ route('clases.asignar_clase', $clase->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="nid_est" class="hidden-nid-est">
                                                <input type="hidden" name="id_pago" class="hidden-id-pago">

                                                <button type="submit" class="text-blue-500 hover:scale-110"
                                                    onclick="return confirm('¿Seguro que desea asignar este estudiante?');">
                                                    🔄<br>Asignar
                                                </button>
                                            </form>

                                            <form action="{{ route('clases.destroy', $clase->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:scale-110"
                                                    onclick="event.preventDefault(); confirm('¿Desea eliminar esta clase?') ? this.closest('form').submit() : false;">
                                                    🗑<br>Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $clases->withQueryString()->links() }}
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        const pagosPorEstudiante = @json($pagosPorEstudiante);

        document.addEventListener('DOMContentLoaded', function () {
            const filas = document.querySelectorAll('tr');

            filas.forEach(fila => {
                const estSelect = fila.querySelector('.estudiante-select');
                const pagoSelect = fila.querySelector('.pago-select');
                const hiddenEst = fila.querySelector('input.hidden-nid-est');
                const hiddenPago = fila.querySelector('input.hidden-id-pago');

                if (!estSelect || !pagoSelect) return;

                estSelect.addEventListener('change', function () {
                    const estudianteId = this.value;

                    // Guardar en input hidden
                    if (hiddenEst) hiddenEst.value = estudianteId;

                    // Reset pago select
                    pagoSelect.innerHTML = '<option value="">Seleccione un pago</option>';

                    if (pagosPorEstudiante[estudianteId]) {
                        pagosPorEstudiante[estudianteId].forEach(pago => {
                            const option = document.createElement('option');
                            option.value = pago.id;
                            option.textContent = `Pago #${pago.id}`;
                            pagoSelect.appendChild(option);
                        });
                    }
                });

                pagoSelect.addEventListener('change', function () {
                    if (hiddenPago) hiddenPago.value = this.value;
                });
            });
        });
    </script>
@endsection
