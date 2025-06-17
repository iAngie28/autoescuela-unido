<tbody class="text-gray-600 text-sm">
    @foreach ($estudiantes as $estudiante)
        <form action="{{ route('inscribir_grupo') }}" method="POST">
            @csrf
            <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $estudiante->id }}</td>
                <td class="py-3 px-6 text-left">{{ $estudiante->name }}</td>

                <!-- Select Categoría -->
                <td class="py-3 px-6 text-center">
                    <select name="categoria_id"
                        class="w-full px-2 py-1 border border-gray-300 rounded-md" required>
                        <option value="">Seleccionar</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </td>

                <!-- Select Grupo activo -->
                <td class="py-3 px-6 text-center">
                    <select name="grupo_id"
                        class="w-full px-2 py-1 border border-gray-300 rounded-md" required>
                        <option value="">Seleccionar</option>
                        @foreach ($grupoExamenActivos as $grupo)
                            <option value="{{ $grupo->id }}">
                                {{ $grupo->id }} - {{ $grupo->fecha_inicio }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <!-- Acciones -->
                <td class="py-3 px-6 text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition duration-300">
                        Inscribir
                    </button>
                </td>
            </tr>
        </form>
    @endforeach
</tbody>
