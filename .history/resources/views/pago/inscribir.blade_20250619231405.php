@extends('layouts.app')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Inscribir Pago #{{ $pago->id }}</h2>
                <p class="text-gray-600 mt-2">Detalle: <span class="font-medium">{{ $pago->detalle }}</span></p>
                <p class="text-gray-600">Monto: <span class="font-medium">{{ $pago->monto }} Bs</span></p>
            </div>

            <form method="POST" action="{{ route('pagos.procesarInscripcion', $pago->id) }}">
                @csrf

                @if ($pago->estado === 'PIP')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">
                            Seleccione las clases programadas (máx. {{ $maxClases }})
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse ($clases as $clase)
                                <label
                                    class="flex items-center space-x-2 px-3 py-2 border rounded cursor-pointer transition peer-checked:bg-blue-100 peer-checked:border-blue-500 peer-checked:text-blue-700">
                                    <input type="checkbox" name="clases[]" value="{{ $clase->id }}" class="hidden peer">
                                    <span>{{ $clase->fecha }} ({{ $clase->hora_inicio }} - {{ $clase->hora_fin }})</span>
                                </label>
                            @empty
                                <p class="text-sm text-red-500">No hay clases programadas disponibles.</p>
                            @endforelse
                        </div>
                    </div>
                @elseif ($pago->estado === 'PIG')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">
                            Seleccione un grupo activo
                        </h3>
                        <div class="space-y-3">
                            @forelse ($grupos as $grupo)
                                <label
                                    class="flex items-center space-x-2 px-3 py-2 border rounded cursor-pointer transition peer-checked:bg-blue-100 peer-checked:border-blue-500 peer-checked:text-blue-700">
                                    <input type="radio" name="grupo_id" value="{{ $grupo->id }}" class="hidden peer">
                                    <span>{{ $grupo->nombre }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-red-500">No hay grupos activos disponibles.</p>
                            @endforelse
                        </div>
                    </div>
                @endif

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('pagos.index') }}" class="mr-4 text-gray-700 hover:underline">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
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

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', () => {
                        const seleccionados = document.querySelectorAll('.clase-checkbox:checked')
                            .length;
                        if (seleccionados > max) {
                            checkbox.checked = false;
                            alert(`Solo puedes seleccionar hasta ${max} clases.`);
                        }
                    });
                });
            });
        </script>
    @endif
@endsection
