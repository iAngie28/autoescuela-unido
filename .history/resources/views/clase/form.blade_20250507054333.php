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
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $clase?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="comentario__inst" class="form-label">{{ __('Comentario Inst') }}</label>
            <input type="text" name="comentario_Inst" class="form-control @error('comentario_Inst') is-invalid @enderror" value="{{ old('comentario_Inst', $clase?->comentario_Inst) }}" id="comentario__inst" placeholder="Comentario Inst">
            {!! $errors->first('comentario_Inst', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="reporte_estudiante" class="form-label">{{ __('Reporte Estudiante') }}</label>
            <input type="text" name="reporte_estudiante" class="form-control @error('reporte_estudiante') is-invalid @enderror" value="{{ old('reporte_estudiante', $clase?->reporte_estudiante) }}" id="reporte_estudiante" placeholder="Reporte Estudiante">
            {!! $errors->first('reporte_estudiante', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <select name="id_paquete" id="id_paquete" class="form-select @error('id_paquete') is-invalid @enderror">
            <option value="">Seleccione la cantidad de clases</option>
            @foreach ($paquetes as $paquete)
                <option value="{{ $paquete->id }}" {{ old('id_paquete') == $paquete->id ? 'selected' : '' }}>
                    {{ $paquete->cant_class }}
                </option>
            @endforeach
        </select>
        <select name="id_paquete" id="id_paquete" class="form-select @error('id_paquete') is-invalid @enderror">
            <option value="">Seleccione la placa de su vehiculo</option>
            @foreach ($vehiculos as $vehiculo)
                <option value="{{ $vehiculo->id }}" {{ old('id_paquete') == $vehiculo->id ? 'selected' : '' }}>
                    {{ $vehiculo->placa }}
                </option>
            @endforeach
        </select>
        <select name="id_inst" id="id_inst" class="form-select @error('id_est') is-invalid @enderror">
            <option value="">Seleccione un instructor</option>
            @foreach ($usuariosInstructor as $usuario)
                <option value="{{ $usuario->instructor->id }}" {{ old('id_est', $clase->id_inst ?? '') == $usuario->instructor->id ? 'selected' : '' }}>
                    {{ $usuario->name }}
                </option>
            @endforeach
        </select>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>