<div class="row padding-1 p-1">
    <div class="col-md-12">

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
        
        <div class="form-group mb-2 mb20">
            <label for="monto" class="form-label">{{ __('Monto') }}</label>
            <input type="text" name="monto" class="form-control @error('monto') is-invalid @enderror"
                value="{{ old('monto', $pago?->monto) }}" id="monto" placeholder="Monto">
            {!! $errors->first('monto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descuento" class="form-label">{{ __('Descuento') }}</label>
            <input type="text" name="descuento" class="form-control @error('descuento') is-invalid @enderror"
                value="{{ old('descuento', $pago?->descuento) }}" id="descuento" placeholder="Descuento">
            {!! $errors->first('descuento', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <select name="id_adm" id="id_adm" class="form-select @error('id_adm') is-invalid @enderror">
            <option value="">Seleccione un administrador</option>
            @foreach ($usuariosAdministrador as $usuario)
                @if ($usuario->administrador)
                    <option value="{{ $usuario->administrador->id }}"
                        {{ old('id_adm', $pago->id_adm ?? '') == $usuario->administrador->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endif
            @endforeach

        </select>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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