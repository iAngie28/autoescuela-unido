@extends('layouts.app')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Inscribir Pago #{{ $pago->id }}</h2>

            <p class="mb-2">Detalle: {{ $pago->detalle }}</p>
            <p class="mb-6">Monto: {{ $pago->monto }} Bs</p>

            <form method="POST" action="{{ route('pagos.procesarInscripcion', $pago->id) }}">
                @csrf

                @if ($pago->estado === 'PIP')
                    <h3 class="text-lg font-semibold mb-3">Seleccione las clases programadas (máx. {{ $maxClases }})</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($clases as $clase)
                            <label for="clase_{{ $clase->id }}"
                                class="clase-label block border rounded px-4 py-3 cursor-pointer text-center">
                                <input type="checkbox" name="clases[]" value="{{ $clase->id }}"
                                    id="clase_{{ $clase->id }}" class="hidden clase-checkbox">
                                {{ $clase->fecha }} ({{ $clase->hora_inicio }} - {{ $clase->hora_fin }})
                            </label>
                        @endforeach




                    </div>
                @elseif ($pago->estado === 'PIG')
                    <h3 class="text-lg font-semibold mb-3">Seleccione un grupo activo</h3>
                    <div class="space-y-2">
                        @foreach ($grupos as $grupo)
                            <label
                                class="peer-checked:bg-gray-800 peer-checked:text-white peer-checked:border-gray-700 transition border rounded px-4 py-2 cursor-pointer flex items-center space-x-2">
                                <input type="radio" name="grupo_id" value="{{ $grupo->id }}" class="peer hidden">
                                <span>{{ $grupo->nombre }}</span>
                            </label>
                        @endforeach
                    </div>
                @endif

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('pagos.index') }}" class="mr-4 text-gray-700 hover:underline">Cancelar</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Confirmar inscripción
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($pago->estado === 'PIP')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const max = {{ $maxClases }};
                const checkboxes = document.querySelectorAll('.clase-checkbox');

                function actualizarEstilos() {
                    checkboxes.forEach(cb => {
                        const label = cb.closest('.clase-label');
                        if (!label) return;

                        if (cb.checked) {
                            label.classList.remove('bg-white', 'text-black', 'border-gray-300');
                            label.classList.add('bg-[#1E293B]', 'text-white', 'border-[#1E293B]');
                        } else {
                            label.classList.remove('bg-[#1E293B]', 'text-white', 'border-[#1E293B]');
                            label.classList.add('bg-white', 'text-black', 'border-gray-300');
                        }
                    });
                }

                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener('change', () => {
                        const seleccionados = document.querySelectorAll('.clase-checkbox:checked')
                            .length;
                        if (seleccionados > max) {
                            checkbox.checked = false;
                            alert(`Solo puedes seleccionar hasta ${max} clases.`);
                            return;
                        }
                        actualizarEstilos();
                    });
                });

                // Inicializar estilos en caso de preselección
                actualizarEstilos();
            });
        </script>
    @endif


@endsection
