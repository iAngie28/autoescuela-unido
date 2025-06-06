<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <select name="id_est" id="id_est" class="form-select @error('id_est') is-invalid @enderror">
            <option value="">Seleccione un estudiante</option>
            @foreach ($usuariosEstudiantes as $usuario)
                <option value="{{ $usuario->estudiante->id }}" {{ old('id_est', $pago->id_est ?? '') == $usuario->estudiante->id ? 'selected' : '' }}>
                    {{ $usuario->name }}
                </option>
            @endforeach
        </select>
        <select name="id_grupo" id="id_grupo" class="form-select @error('id_grupo') is-invalid @enderror">
            <option value="">Seleccione una categoria</option>
            @foreach ($grupos as $grupos)
                <option value="{{ $grupos->id }}" {{ old('id_grupo') == $grupos->id ? 'selected' : '' }}>
                    {{ $grupos->id }}
                </option>
            @endforeach
        </select>
        <div class="form-group mb-2 mb20">
            <label for="nro_intento" class="form-label">{{ __('Nro Intento') }}</label>
            <input type="text" name="nro_intento" class="form-control @error('nro_intento') is-invalid @enderror" value="{{ old('nro_intento', $examenSegip?->nro_intento) }}" id="nro_intento" placeholder="Nro Intento">
            {!! $errors->first('nro_intento', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nota__teorica" class="form-label">{{ __('Nota Teorica') }}</label>
            <input type="text" name="nota_Teorica" class="form-control @error('nota_Teorica') is-invalid @enderror" value="{{ old('nota_Teorica', $examenSegip?->nota_Teorica) }}" id="nota__teorica" placeholder="Nota Teorica">
            {!! $errors->first('nota_Teorica', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nota__practica" class="form-label">{{ __('Nota Practica') }}</label>
            <input type="text" name="nota_Practica" class="form-control @error('nota_Practica') is-invalid @enderror" value="{{ old('nota_Practica', $examenSegip?->nota_Practica) }}" id="nota__practica" placeholder="Nota Practica">
            {!! $errors->first('nota_Practica', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $examenSegip?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <select name="id_categoria" id="id_categoria" class="form-select @error('id_categoria') is-invalid @enderror">
            <option value="">Seleccione una categoria</option>
            @foreach ($categorias as $categorias)
                <option value="{{ $categorias->id }}" {{ old('id_categoria') == $categorias->id ? 'selected' : '' }}>
                    {{ $categorias->nombre }}
                </option>
            @endforeach
        </select>
        

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>