<div class="mb-4">
    <label for="estado" class="block font-semibold mb-1">Estado</label>
    <input type="text" name="estado" id="estado"
        value="{{ old('estado', $grupoExaman?->estado) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('estado') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Estado">
    @error('estado') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="fecha_inicio" class="block font-semibold mb-1">Fecha Inicio</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio"
        value="{{ old('fecha_inicio', $grupoExaman?->fecha_inicio) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('fecha_inicio') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Fecha Inicio">
    @error('fecha_inicio') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="fecha_fin" class="block font-semibold mb-1">Fecha Fin</label>
    <input type="date" name="fecha_fin" id="fecha_fin"
        value="{{ old('fecha_fin', $grupoExaman?->fecha_fin) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('fecha_fin') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Fecha Fin">
    @error('fecha_fin') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="capacidad" class="block font-semibold mb-1">Capacidad</label>
    <input type="text" name="capacidad" id="capacidad"
        value="{{ old('capacidad', $grupoExaman?->capacidad) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('capacidad') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Capacidad">
    @error('capacidad') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-6">
    <label for="fecha_hora" class="block font-semibold mb-1">Fecha Hora</label>
    <input type="datetime-local" name="fecha_hora" id="fecha_hora"
        value="{{ old('fecha_hora', $grupoExaman?->fecha_hora) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('fecha_hora') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Fecha Hora">
    @error('fecha_hora') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="flex justify-end">
    <a href="{{ route('grupo-examen.index') }}"
        class="bg-gray-700 text-gray-100 px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
        Cancelar
    </a>
    <button type="submit"
        class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded-md transition duration-300">
        Submit
    </button>
</div>
@push('scripts')
<script>
    import flatpickr from "flatpickr";

    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#fecha_inicio", {
            dateFormat: "Y-m-d",
            locale: "es",
            disable: [
                function (date) {
                    // Permitir solo lunes (1 = lunes)
                    return date.getDay() !== 1;
                }
            ],
            onChange: function(selectedDates, dateStr, instance) {
                if (!selectedDates.length) return;
                const fechaInicio = selectedDates[0];
                const fechaFin = new Date(fechaInicio);
                fechaFin.setDate(fechaInicio.getDate() + 6);

                const año = fechaFin.getFullYear();
                const mes = String(fechaFin.getMonth() + 1).padStart(2, '0');
                const dia = String(fechaFin.getDate()).padStart(2, '0');

                document.getElementById('fecha_fin').value = `${año}-${mes}-${dia}`;
            }
        });
    });
</script>
@endpush