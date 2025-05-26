<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $clase?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_inicio" class="form-label">{{ __('Hora Inicio') }}</label>
            <input type="time" name="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value="{{ old('hora_inicio', $clase?->hora_inicio) }}" id="hora_inicio" placeholder="Hora Inicio">
            {!! $errors->first('hora_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_fin" class="form-label">{{ __('Hora Fin') }}</label>
            <input type="time" name="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror" value="{{ old('hora_fin', $clase?->hora_fin) }}" id="hora_fin" placeholder="Hora Fin">
            {!! $errors->first('hora_fin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        <select name="id_paquete" id="id_paquete" class="form-select @error('id_paquete') is-invalid @enderror">
            <option value="">Seleccione la cantidad de clases</option>
            @foreach ($paquetes as $paquete)
                <option value="{{ $paquete->id }}" {{ old('id_paquete') == $paquete->id ? 'selected' : '' }}>
                    {{ $paquete->cant_class }}
                </option>
            @endforeach
        </select>
        
        <select name="id_inst" id="id_inst" class="form-select @error('id_inst') is-invalid @enderror">
            <option value="">Seleccione un instructor</option>
            @foreach ($usuariosInstructor as $usuario)
    @if ($usuario->instructor)
        <option value="{{ $usuario->instructor->id }}"
            {{ old('id_inst', $clase->id_inst ?? '') == $usuario->instructor->id ? 'selected' : '' }}>
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