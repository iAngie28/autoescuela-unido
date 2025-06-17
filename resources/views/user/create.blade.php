@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-[#293241] text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8">
                    <h1 class="text-3xl font-bold text-left mb-8">Registrar Usuario</h1>

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="block font-semibold mb-1">Nombre</label>
                            <input id="name" name="name" type="text"
                                value="{{ old('name') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
                                required>
                            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Username -->
                        <div class="mb-4">
                            <label for="username" class="block font-semibold mb-1">Username</label>
                            <input id="username" name="username" type="text"
                                value="{{ old('username') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
                                required>
                            @error('username') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block font-semibold mb-1">Email</label>
                            <input id="email" name="email" type="email"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
                                required>
                            @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block font-semibold mb-1">Contraseña</label>
                            <input id="password" name="password" type="password"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
                                required>
                            @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Confirmar Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block font-semibold mb-1">Confirmar Contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
                                required>
                        </div>
                        
                        <!-- Sexo -->
                        <div class="mb-4">
                            <label for="sexo" class="block font-semibold mb-1">Sexo</label>
                            <select id="sexo" name="sexo"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
                                required>
                                <option value="">Seleccione</option>
                                <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('sexo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Teléfono -->
                        <div class="mb-4">
                            <label for="telefono" class="block font-semibold mb-1">Teléfono</label>
                            <input id="telefono" name="telefono" type="text"
                                value="{{ old('telefono') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
                            @error('telefono') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="block font-semibold mb-1">Dirección</label>
                            <input id="direccion" name="direccion" type="text"
                                value="{{ old('direccion') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
                            @error('direccion') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Fecha de Registro -->
                        <div class="mb-4">
                            <label for="fecha_registro" class="block font-semibold mb-1">Fecha de Registro</label>
                            <input id="fecha_registro" name="fecha_registro" type="date"
                                value="{{ old('fecha_registro') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
                            @error('fecha_registro') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- CI -->
                        <div class="mb-4">
                            <label for="ci" class="block font-semibold mb-1">Cédula de Identidad</label>
                            <input id="ci" name="ci" type="text"
                                value="{{ old('ci') }}"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
                            @error('ci') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Tipo de Usuario -->
                        <div class="mb-4">
                            <label for="tipo_usuario" class="block font-semibold mb-1">Tipo de Usuario</label>
                            <select id="tipo_usuario" name="tipo_usuario"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
                                <option value="">Seleccione</option>
                                <option value="A" {{ old('tipo_usuario') == 'A' ? 'selected' : '' }}>Administrador</option>
                                <option value="E" {{ old('tipo_usuario') == 'E' ? 'selected' : '' }}>Estudiante</option>
                                <option value="I" {{ old('tipo_usuario') == 'I' ? 'selected' : '' }}>Instructor</option>
                            </select>
                            @error('tipo_usuario') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Rol -->
                        <div class="mb-6">
                            <label for="id_rol" class="block font-semibold mb-1">Rol</label>
                            <select id="id_rol" name="id_rol"
                                class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                                style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
                                <option value="">Seleccione</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ old('id_rol') == $rol->id ? 'selected' : '' }}>
                                        {{ $rol->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_rol') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end">
                            <a href="{{ route('usuarios.index') }}"
                                class="bg-gray-700 text-gray-100 px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="bg-blue-700 hover:bg-blue-900 text-white px-4 py-2 rounded-md transition duration-300">
                                Registrar usuario
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>
@endsection
