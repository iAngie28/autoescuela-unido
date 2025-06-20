<div class="row p-1">
    <div class="col-md-12">
        <!-- Select de Estudiante -->
        <div class="mb-3">
            <label for="id_est" class="form-label">Estudiante</label>
            <select name="id_est" id="id_est" class="form-select @error('id_est') is-invalid @enderror">
                <option value="">Seleccione un estudiante</option>
                @foreach ($usuariosEstudiantes as $usuario)
                    @if ($usuario->estudiante)
                        <option value="{{ $usuario->estudiante->id }}">
                            {{ $usuario->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Selección de tipo de pago -->
        <div class="mb-3">
    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de pago</label>
    <div class="flex items-center gap-6">
        <div class="inline-flex items-center space-x-2">
            <input type="radio" name="tipo_pago" id="pago_paquete" value="paquete"
                class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500 checked:ring-2 checked:ring-offset-1 transition">
            <label for="pago_paquete" class="text-sm text-gray-800 cursor-pointer">Paquete</label>
        </div>
        <div class="inline-flex items-center space-x-2">
            <input type="radio" name="tipo_pago" id="pago_grupo" value="grupo"
                class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500 checked:ring-2 checked:ring-offset-1 transition">
            <label for="pago_grupo" class="text-sm text-gray-800 cursor-pointer">Grupo</label>
        </div>
    </div>
</div>


        <!-- Select de Paquetes -->
        <div class="mb-3 hidden" id="select_paquete">
            <label for="paquete_id" class="form-label">Seleccione un paquete</label>
            <select name="paquete_id" id="paquete_id" class="form-select">
                <option value="">Seleccione un paquete</option>
                @foreach ($paquetes as $paquete)
                    <option value="{{ $paquete->id }}" data-monto="{{ $paquete->costo }}">
                        {{ $paquete->cant_class }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select de Categorías -->
        <div class="mb-3 hidden" id="select_grupo">
            <label for="categoria_id" class="form-label">Seleccione una categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-select">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" data-monto="{{ $categoria->costo }}">
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Monto (automático) -->
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="text" name="monto" id="monto" class="form-control" readonly>
        </div>

        <!-- Botón -->
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Registrar pago</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radioPaquete = document.getElementById('pago_paquete');
        const radioGrupo = document.getElementById('pago_grupo');
        const selectPaquete = document.getElementById('select_paquete');
        const selectGrupo = document.getElementById('select_grupo');
        const paqueteSelect = document.getElementById('paquete_id');
        const categoriaSelect = document.getElementById('categoria_id');
        const montoInput = document.getElementById('monto');

        function resetMonto() {
            montoInput.value = '';
        }

        function toggleSelects() {
            if (radioPaquete.checked) {
                selectPaquete.classList.remove('hidden');
                selectGrupo.classList.add('hidden');
                categoriaSelect.value = '';
            } else if (radioGrupo.checked) {
                selectGrupo.classList.remove('hidden');
                selectPaquete.classList.add('hidden');
                paqueteSelect.value = '';
            } else {
                selectPaquete.classList.add('hidden');
                selectGrupo.classList.add('hidden');
                paqueteSelect.value = '';
                categoriaSelect.value = '';
            }
            resetMonto();
        }

        // Inicializar el estado
        toggleSelects();

        // Listeners
        radioPaquete.addEventListener('change', toggleSelects);
        radioGrupo.addEventListener('change', toggleSelects);

        paqueteSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            montoInput.value = selected.getAttribute('data-monto') || '';
        });

        categoriaSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            montoInput.value = selected.getAttribute('data-monto') || '';
        });
    });
</script>

