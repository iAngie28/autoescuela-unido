<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha__insc" class="form-label">{{ __('Fecha Insc') }}</label>
            <input type="date" name="fecha_Insc" class="form-control @error('fecha_Insc') is-invalid @enderror" value="{{ old('fecha_Insc', $inscribe?->fecha_Insc) }}" id="fecha__insc" placeholder="Fecha Insc">
            {!! $errors->first('fecha_Insc', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="categoria_actual" class="form-label">{{ __('Categoria Actual') }}</label>
            <input type="text" name="categoria_actual" class="form-control @error('categoria_actual') is-invalid @enderror" value="{{ old('categoria_actual', $inscribe?->categoria_actual) }}" id="categoria_actual" placeholder="Categoria Actual">
            {!! $errors->first('categoria_actual', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <select name="id_categoria" id="id_categoria" class="form-select @error('id_categoria') is-invalid @enderror">
            <option value="">Seleccione una categoria</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
        <div class="form-group mb-2 mb20">
            <label for="id_pago" class="form-label">{{ __('Id Pago') }}</label>
            <input type="text" name="id_pago" class="form-control @error('id_pago') is-invalid @enderror" value="{{ old('id_pago', $inscribe?->id_pago) }}" id="id_pago" placeholder="Id Pago">
            {!! $errors->first('id_pago', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_paquete" class="form-label">{{ __('Id Paquete') }}</label>
            <input type="text" name="id_paquete" class="form-control @error('id_paquete') is-invalid @enderror" value="{{ old('id_paquete', $inscribe?->id_paquete) }}" id="id_paquete" placeholder="Id Paquete">
            {!! $errors->first('id_paquete', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>