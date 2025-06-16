@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-900 text-gray-100 p-6">
                <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-700">
                    <section class="bg-gray-900 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-800">
    <h1 class="text-3xl font-bold text-left mb-8">Editar Usuario</h1>

    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition" required>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block font-semibold mb-1">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition" required>
            @error('username') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition" required>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Sexo -->
        <div class="mb-4">
            <label for="sexo" class="block font-semibold mb-1">Sexo</label>
            <select id="sexo" name="sexo"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition" required>
                <option value="">Seleccione</option>
                <option value="masculino" {{ old('sexo', $user->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ old('sexo', $user->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ old('sexo', $user->sexo) == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('sexo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Teléfono -->
        <div class="mb-4">
            <label for="telefono" class="block font-semibold mb-1">Teléfono</label>
            <input id="telefono" type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
            @error('telefono') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Dirección -->
        <div class="mb-4">
            <label for="direccion" class="block font-semibold mb-1">Dirección</label>
            <input id="direccion" type="text" name="direccion" value="{{ old('direccion', $user->direccion) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
            @error('direccion') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Fecha de Registro -->
        <div class="mb-4">
            <label for="fecha_registro" class="block font-semibold mb-1">Fecha de Registro</label>
            <input id="fecha_registro" type="date" name="fecha_registro" value="{{ old('fecha_registro', $user->fecha_registro) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
            @error('fecha_registro') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- CI -->
        <div class="mb-4">
            <label for="ci" class="block font-semibold mb-1">Cédula de Identidad</label>
            <input id="ci" type="text" name="ci" value="{{ old('ci', $user->ci) }}"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
            @error('ci') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Tipo de Usuario -->
        <div class="mb-4">
            <label for="tipo_usuario" class="block font-semibold mb-1">Tipo de Usuario</label>
            <select id="tipo_usuario" name="tipo_usuario"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                <option value="">Seleccione</option>
                <option value="A" {{ old('tipo_usuario', $user->tipo_usuario) == 'A' ? 'selected' : '' }}>Administrador</option>
                <option value="E" {{ old('tipo_usuario', $user->tipo_usuario) == 'E' ? 'selected' : '' }}>Estudiante</option>
                <option value="I" {{ old('tipo_usuario', $user->tipo_usuario) == 'I' ? 'selected' : '' }}>Instructor</option>
            </select>
            @error('tipo_usuario') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Rol -->
        <div class="mb-6">
            <label for="id_rol" class="block font-semibold mb-1">Rol</label>
            <select id="id_rol" name="id_rol"
                class="w-full px-4 py-2 rounded-md bg-gray-800 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                <option value="">Seleccione</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol) == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_rol') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <!-- Botones -->
        <div class="flex justify-end">
            <a href="{{ route('usuarios.index') }}" class="bg-gray-700 text-gray-100 px-4 py-2 rounded-md hover:bg-gray-600 mr-2">Cancelar</a>
            <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded-md transition duration-300">
                Guardar cambios
            </button>
        </div>
    </form>
</section>

                </section>
            </main>
        </div>
    </div>
@endsection
