<div class="mb-4">
    <label for="cant_class" class="block font-semibold mb-1">Cantidad de Clases</label>
    <input type="text" name="cant_class" id="cant_class"
        value="{{ old('cant_class', $paquete?->cant_class) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('cant_class') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Cantidad de clases">
    @error('cant_class') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="capacidad_est" class="block font-semibold mb-1">Capacidad de Estudiantes</label>
    <input type="text" name="capacidad_est" id="capacidad_est"
        value="{{ old('capacidad_est', $paquete?->capacidad_est ?? 1) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('capacidad_est') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Capacidad de estudiantes">
    @error('capacidad_est') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>


<div class="mb-6">
    <label for="costo" class="block font-semibold mb-1">Costo</label>
    <input type="text" name="costo" id="costo"
        value="{{ old('costo', $paquete?->costo) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('costo') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Costo">
    @error('costo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="flex justify-end">
    <a href="{{ route('paquetes.index') }}"
        class="bg-gray-700 text-gray-100 px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
        Cancelar
    </a>
    <button type="submit"
        class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded-md transition duration-300">
        Guardar
    </button>
</div>
