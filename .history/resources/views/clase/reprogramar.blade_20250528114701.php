@foreach ($clases as $clase)
<tr data-estado="{{ strtolower($clase->estado) }}" class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-6 text-center">{{ $clase->id }}</td>
    <td class="py-3 px-6 text-center">{{ $clase->hora_inicio }}</td>
    <td class="py-3 px-6 text-center">{{ $clase->hora_fin }}</td>
    <td class="py-3 px-6 text-center">{{ $clase->id_inst }}</td>
    <td class="py-3 px-6 text-center">{{ $clase->estado }}</td>
    <td class="py-3 px-6 text-center">
        <!-- Input de fecha en celda sola -->
        <form action="{{ route('clases.reprogramar', $clase->id) }}" method="POST" class="inline-flex">
            @csrf
            @method('PUT')
            <input type="date" name="nueva_fecha"
                   value="{{ old('nueva_fecha', $clase->fecha) }}"
                   min="{{ date('Y-m-d') }}"
                   class="border rounded p-1 text-sm">
            <button type="submit" class="ml-2 text-blue-500 hover:scale-110"
                    onclick="return confirm('Seguro que desea reprogramar?');">
                <svg ...> <!-- tu icono SVG aquí --> </svg>
                Reprogramar
            </button>
        </form>
    </td>
    <td class="py-3 px-6 text-center">
        <!-- Botón eliminar en celda sola -->
        <form action="{{ route('clases.destroy', $clase->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:scale-110"
                    onclick="return confirm('¿Seguro que desea eliminar?');">
                <svg ...> <!-- tu icono SVG para eliminar --> </svg>
                Eliminar
            </button>
        </form>
    </td>
</tr>
@endforeach

    @endsection
