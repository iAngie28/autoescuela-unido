<div class="row p-1">
    <div class="col-md-12">
        <!-- Select de Estudiante -->
        <div class="mb-3">
            <label for="id_est" class="form-label">Estudiante</label>
            <select name="id_est" id="id_est" class="form-select @error('id_est') is-invalid @enderror">
                <option value="">Seleccione un estudiante</option>
                @foreach ($usuariosEstudiantes as $usuario)
                    @if ($usuario->estudiante)
                        <option value="{{ $usuario->estudiante->id }}"
                            {{ old('id_est', $pago->id_est ?? '') == $usuario->estudiante->id ? 'selected' : '' }}>
                            {{ $usuario->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Selección de tipo de pago -->
        <div class="mb-3">
            <label class="form-label">Tipo de pago</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_pago" id="pago_paquete" value="paquete">
                <label class="form-check-label" for="pago_paquete">Paquete</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_pago" id="pago_grupo" value="grupo">
                <label class="form-check-label" for="pago_grupo">Grupo</label>
            </div>
        </div>

        <!-- Select de Paquetes -->
        <div class="mb-3 d-none" id="select_paquete">
            <label for="paquete_id" class="form-label">Seleccione un paquete</label>
            <select name="paquete_id" id="paquete_id" class="form-select">
                <option value="">Seleccione un paquete</option>
                @foreach ($paquetes as $paquete)
                    <option value="{{ $paquete-> }}" data-monto="{{ $paquete->costo }}">
                        {{ $paquete->cant_class }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select de Categorías -->
        <div class="mb-3 d-none" id="select_grupo">
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

    radioPaquete.addEventListener('change', function () {
        if (this.checked) {
            selectPaquete.classList.remove('d-none');
            selectGrupo.classList.add('d-none');
            categoriaSelect.value = '';
            resetMonto();
        }
    });

    radioGrupo.addEventListener('change', function () {
        if (this.checked) {
            selectGrupo.classList.remove('d-none');
            selectPaquete.classList.add('d-none');
            paqueteSelect.value = '';
            resetMonto();
        }
    });

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
