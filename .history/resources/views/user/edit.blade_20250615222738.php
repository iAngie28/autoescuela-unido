@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Username</label>
        <input type="text" name="username" value="{{ $user->username }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label>Sexo</label>
        <select name="sexo">
            <option value="masculino" {{ $user->sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="femenino" {{ $user->sexo == 'femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="otro" {{ $user->sexo == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>

        <label>Teléfono</label>
        <input type="number" name="telefono" value="{{ $user->telefono }}" required>

        <label>Dirección</label>
        <input type="text" name="direccion" value="{{ $user->direccion }}" required>

        <label>Fecha de Registro</label>
        <input type="date" name="fecha_registro" value="{{ $user->fecha_registro }}" required>

        <label>CI</label>
        <input type="number" name="ci" value="{{ $user->ci }}" required>

        <label>Tipo de Usuario</label>
        <select name="tipo_usuario">
            <option value="">Ninguno</option>
            <option value="A" {{ $user->tipo_usuario == 'A' ? 'selected' : '' }}>Administrador</option>
            <option value="E" {{ $user->tipo_usuario == 'E' ? 'selected' : '' }}>Estudiante</option>
            <option value="I" {{ $user->tipo_usuario == 'I' ? 'selected' : '' }}>Instructor</option>
        </select>

        <label>Rol</label>
        <select name="id_rol" required>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ $rol->id == $user->id_rol ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>

        <br><br>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
