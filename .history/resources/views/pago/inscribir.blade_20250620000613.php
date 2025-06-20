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
                    <div class="space-y-4">
                        @foreach ($clases as $clase)
                            <label for="clase_{{ $clase->id }}"
                                class="clase-label block border border-gray-300 rounded px-4 py-3 cursor-pointer text-center bg-white text-black transition">
                                <input type="checkbox" name="clases[]" value="{{ $clase->id }}"
                                    id="clase_{{ $clase->id }}" class="hidden clase-checkbox">
                                {{ $clase->fecha }} ({{ $clase->hora_inicio }} - {{ $clase->hora_fin }}
                                {{ $clase->instructor?->usuario?->name ?? 'Sin instructor asignado' }})
                            </label>
                        @endforeach
                    </div>
                @elseif ($pago->estado === 'PIG')
                    <h3 class="text-lg font-semibold mb-3">Seleccione un grupo activo</h3>
                    <div class="space-y-2">
                        @foreach ($grupos as $grupo)
                            <label for="grupo_{{ $grupo->id }}"
                                class="peer-checked:bg-[#1E293B] peer-checked:text-white peer-checked:border-[#1E293B]
                       border border-gray-300 rounded px-4 py-2 cursor-pointer flex items-center justify-between transition">
                                <input type="radio" name="grupo_id" value="{{ $grupo->id }}"
                                    id="grupo_{{ $grupo->id }}" class="peer hidden">
                                <span>{{ $grupo->id }} - Fecha Examen: {{ $grupo->fecha_hora }}</span>
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.estilo-checkbox');
        const radios = document.querySelectorAll('.estilo-radio');

        function actualizarEstilos(elementos) {
            elementos.forEach(el => {
                const label = document.querySelector(`label[for="${el.id}"]`);
                if (!label) return;

                if (el.checked) {
                    label.classList.remove('bg-white', 'text-black', 'border-gray-300');
                    label.classList.add('bg-gray-800', 'border-gray-400', 'text-white');
                } else {
                    label.classList.remove('bg-gray-800', 'border-gray-400', 'text-white');
                    label.classList.add('bg-white', 'text-black', 'border-gray-300');
                }
            });
        }

        // Control máximo si es para clases (PIP)
        const max = {{ $pago->estado === 'PIP' ? $maxClases : 'null' }};

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                if (max !== null) {
                    const seleccionados = document.querySelectorAll('.estilo-checkbox:checked').length;
                    if (seleccionados > max) {
                        cb.checked = false;
                        alert(`Solo puedes seleccionar hasta ${max} clases.`);
                        return;
                    }
                }
                actualizarEstilos(checkboxes);
            });
        });

        radios.forEach(rb => {
            rb.addEventListener('change', () => actualizarEstilos(radios));
        });

        // Inicializa todo
        actualizarEstilos(checkboxes);
        actualizarEstilos(radios);
    });
</script>


@endsection
