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
        <select name="id_pago" id="id_pago" class="form-select @error('id_pago') is-invalid @enderror">
            <option value="">Seleccione el id del pago</option>
            @foreach ($pagos as $pago)
                <option value="{{ $pago->id }}" {{ old('id_pago') == $pago->id ? 'selected' : '' }}>
                    {{ $pago->id }}
                </option>
            @endforeach
        </select>
        <select name="id_paquete" id="id_paquete" class="form-select @error('id_paquete') is-invalid @enderror">
            <option value="">Seleccione la cantidad de clases</option>
            @foreach ($paquetes as $paquete)
                <option value="{{ $paquete->id }}" {{ old('id_paquete') == $paquete->id ? 'selected' : '' }}>
                    {{ $paquete->cant_class }}
                </option>
            @endforeach
        </select>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>