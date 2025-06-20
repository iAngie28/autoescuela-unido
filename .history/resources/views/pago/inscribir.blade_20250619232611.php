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
                            <label
                                class="clase-label border rounded px-4 py-2 cursor-pointer flex items-center space-x-2 transition"
                                data-id="{{ $clase->id }}">
                                <input type="checkbox" name="clases[]" value="{{ $clase->id }}"
                                    class="hidden clase-checkbox">
                                <span>{{ $clase->fecha }} ({{ $clase->hora_inicio }} - {{ $clase->hora_fin }})</span>
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
                const labels = document.querySelectorAll('.clase-label');

                checkboxes.forEach((checkbox, i) => {
                    checkbox.addEventListener('change', function() {
                        const seleccionados = document.querySelectorAll('.clase-checkbox:checked')
                            .length;

                        if (seleccionados > max) {
                            checkbox.checked = false;
                            alert(`Solo puedes seleccionar hasta ${max} clases.`);
                            return;
                        }

                        // Quitar estilos anteriores
                        labels.forEach(label => {
                            label.classList.remove('text-white', 'bg-[#1E293B]',
                                'border-[#1E293B]');
                            label.classList.add('bg-white', 'text-black', 'border-gray-300');
                        });

                        // Estilos nuevos para seleccionados
                        checkboxes.forEach((cb, idx) => {
                            if (cb.checked) {
                                labels[idx].classList.remove('bg-white', 'text-black',
                                    'border-gray-300');
                                labels[idx].classList.add('bg-[#1E293B]', 'text-white',
                                    'border-[#1E293B]');
                            }
                        });
                    });
                });
            });
        </script>
    @endif

@endsection
