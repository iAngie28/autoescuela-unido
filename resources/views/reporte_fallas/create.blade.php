@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Reportar Falla en Vehículo</h1>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('reporte-fallas.store') }}" class="space-y-6">
            @csrf

            <div class="mb-4">
                <label for="vehiculo_id" class="block text-gray-700 font-medium mb-2">Vehículo</label>
                <select name="vehiculo_id" id="vehiculo_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Seleccione un vehículo</option>
                    @foreach($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}" 
                                {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                            {{ $vehiculo->placa }} - {{ $vehiculo->modelo }} ({{ $vehiculo->tipoVehiculo->nombre ?? 'Sin tipo' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-medium mb-2">Descripción de la falla</label>
                <textarea name="descripcion" id="descripcion" rows="5"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Describa detalladamente el problema..."
                          required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('reporte-fallas.index') }}" 
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Guardar Reporte
                </button>
            </div>
        </form>
    </div>
</div>
@endsection