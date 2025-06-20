@php
    $defaultNotaPract = old('nota_min_pract', $examenCategoriaAspira?->nota_min_pract ?? 51);
    $defaultNotaTeorica = old('nota_min_teorica', $examenCategoriaAspira?->nota_min_teorica ?? 51);
@endphp

<div class="mb-4">
    <label for="nombre" class="block font-semibold mb-1">Nombre</label>
    <input type="text" name="nombre" id="nombre"
        value="{{ old('nombre', $examenCategoriaAspira?->nombre) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('nombre') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Nombre">
    @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="costo" class="block font-semibold mb-1">Costo</label>
    <input type="text" name="costo" id="costo"
        value="{{ old('costo', $examenCategoriaAspira?->costo) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('costo') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Costo">
    @error('costo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label for="nota_min_pract" class="block font-semibold mb-1">Nota Min. Práctica</label>
    <input type="text" name="nota_min_pract" id="nota_min_pract"
        value="{{ old('nota_min_pract', $examenCategoriaAspira?->nota_min_pract) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('nota_min_pract') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Nota Mínima Práctica">
    @error('nota_min_pract') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-6">
    <label for="nota_min_teorica" class="block font-semibold mb-1">Nota Min. Teórica</label>
    <input type="text" name="nota_min_teorica" id="nota_min_teorica"
        value="{{ old('nota_min_teorica', $examenCategoriaAspira?->nota_min_teorica) }}"
        class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition @error('nota_min_teorica') border-red-500 @enderror"
        style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
        placeholder="Nota Mínima Teórica">
    @error('nota_min_teorica') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="flex justify-end">
    <a href="{{ route('examen-categoria-aspiras.index') }}"
        class="bg-gray-700 text-gray-100 px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
        Cancelar
    </a>
    <button type="submit"
        class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded-md transition duration-300">
        Submit
    </button>
</div>
