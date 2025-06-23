@extends('layouts.guest-bootstrap')
  

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Editar') }} Notificación</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('notificaciones.update', $notificacione->id) }}" role="form">
                        @method('PATCH')
                        @csrf
                        
                        <!-- Dropdown de Destinatarios (Solo para Admin) -->
                       
                        <div class="form-group mb-3">
                            <label for="user_id" class="form-label">Destinatario</label>
                            <select name="user_id" class="form-select" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $notificacione->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} - 
                                        {{ $user->tipo_usuario === 'E' ? 'Estudiante' : 'Instructor' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        @include('notificacione.form')
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar Notificación') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
