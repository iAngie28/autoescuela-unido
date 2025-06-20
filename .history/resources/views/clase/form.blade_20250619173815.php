{{-- Validación de errores --}}
@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Fecha --}}
<div class="mb-4">
    <label for="fecha" class="block font-semibold mb-1">Fecha</label>
    <input type="date" name="fecha" id="fecha"
        value="{{ old('fecha', $clase?->fecha) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('fecha') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
    @error('fecha') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

{{-- Hora inicio --}}
<div class="mb-4">
    <label for="hora_inicio" class="block font-semibold mb-1">Hora Inicio</label>
    <input type="time" name="hora_inicio" id="hora_inicio"
        value="{{ old('hora_inicio', $clase?->hora_inicio) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('hora_inicio') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
    @error('hora_inicio') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

{{-- Hora fin --}}
<div class="mb-4">
    <label for="hora_fin" class="block font-semibold mb-1">Hora Fin</label>
    <input type="time" name="hora_fin" id="hora_fin"
        value="{{ old('hora_fin', $clase?->hora_fin) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('hora_fin') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
    @error('hora_fin') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

{{-- Estado --}}
<div class="mb-4">
    <label for="estado" class="block font-semibold mb-1">Estado</label>
    <select name="estado" id="estado"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('estado') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
        <option value="">Seleccione el estado de la clase</option>
        <option value="programada" {{ old('estado', $clase?->estado) == 'programada' ? 'selected' : '' }}>Programada</option>
        <option value="cancelada" {{ old('estado', $clase?->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
        <option value="inscrita" {{ old('estado', $clase?->estado) == 'inscrita' ? 'selected' : '' }}>Inscrita</option>
    </select>
    @error('estado') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

{{-- Paquete --}}
<div class="mb-4">
    <label for="id_paquete" class="block font-semibold mb-1">Cantidad de Clases</label>
    <select name="id_paquete" id="id_paquete"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('id_paquete') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
        <option value="">Seleccione la cantidad de clases</option>
        @foreach ($paquetes as $paquete)
            <option value="{{ $paquete->id }}" {{ old('id_paquete', $clase?->id_paquete) == $paquete->id ? 'selected' : '' }}>
                {{ $paquete->cant_class }}
            </option>
        @endforeach
    </select>
    @error('id_paquete') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

{{-- Instructor --}}
<div class="mb-6">
    <label for="id_inst" class="block font-semibold mb-1">Instructor</label>
    <select name="id_inst" id="id_inst"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('id_inst') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
        <option value="">Seleccione un instructor</option>
        @foreach ($usuariosInstructor as $usuario)
            @if ($usuario->instructor)
                <option value="{{ $usuario->instructor->id }}" {{ old('id_inst', $clase?->id_inst) == $usuario->instructor->id ? 'selected' : '' }}>
                    {{ $usuario->name }}
                </option>
            @endif
        @endforeach
    </select>
    @error('id_inst') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

{{-- Botones --}}
<div class="flex justify-end">
    <a href="{{ route('clases.index') }}"
        class="bg-gray-700 text-gray-100 px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
        Volver
    </a>
    <button type="submit"
        class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded-md transition duration-300">
        Guardar
    </button>
</div>
