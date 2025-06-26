@extends('layouts.guest-bootstrap')
@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Crear') }} Notificación</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('notificaciones.store') }}" role="form">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="user_id" class="form-label">Destinatario</label>
                            <select name="user_id" class="form-select" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} - 
                                        {{ $user->tipo_usuario === 'E' ? 'Estudiante' : 'Instructor' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mb-2 mb20">
                            <label for="mensaje" class="form-label">{{ __('Mensaje') }}</label>
                            <input type="text" name="mensaje" class="form-control @error('mensaje') is-invalid @enderror" 
                                   value="{{ old('mensaje') }}" id="mensaje" placeholder="Mensaje" required>
                            @error('mensaje')
                                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-2 mb20">
                            <label for="tipo" class="form-label">{{ __('Tipo') }}</label>
                            <input type="text" name="tipo" class="form-control @error('tipo') is-invalid @enderror" 
                                   value="{{ old('tipo') }}" id="tipo" placeholder="Tipo" required>
                            @error('tipo')
                                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection