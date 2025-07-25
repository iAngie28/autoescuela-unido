<x-guest-layout>
    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Nombre de Usuario -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Nombre de Usuario')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password (opcional en edición) -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña (solo si deseas cambiarla)')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="mt-4">
            <x-input-label for="sexo" :value="__('Sexo')" />
            <select id="sexo" name="sexo" class="block mt-1 w-full rounded">
                <option value="">Seleccione</option>
                <option value="masculino" {{ old('sexo', $user->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ old('sexo', $user->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ old('sexo', $user->sexo) == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
            <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="number" name="telefono"
                :value="old('telefono', $user->telefono)" required />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div class="mt-4">
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion"
                :value="old('direccion', $user->direccion)" required />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Fecha de Registro -->
        <div class="mt-4">
            <x-input-label for="fecha_registro" :value="__('Fecha de Registro')" />
            <x-text-input id="fecha_registro" class="block mt-1 w-full" type="date" name="fecha_registro"
                :value="old('fecha_registro', $user->fecha_registro)" />
            <x-input-error :messages="$errors->get('fecha_registro')" class="mt-2" />
        </div>

        <!-- CI -->
        <div class="mt-4">
            <x-input-label for="ci" :value="__('Cédula de Identidad')" />
            <x-text-input id="ci" class="block mt-1 w-full" type="number" name="ci"
                :value="old('ci', $user->ci)" required />
            <x-input-error :messages="$errors->get('ci')" class="mt-2" />
        </div>

        <!-- Tipo de Usuario -->
        <div class="mt-4">
            <x-input-label for="tipo_usuario" :value="__('Tipo de Usuario')" />
            <select id="tipo_usuario" name="tipo_usuario" class="block mt-1 w-full rounded" required>
                <option value="">Seleccione</option>
                <option value="A" {{ old('tipo_usuario', $user->tipo_usuario) == 'A' ? 'selected' : '' }}>Administrador</option>
                <option value="E" {{ old('tipo_usuario', $user->tipo_usuario) == 'E' ? 'selected' : '' }}>Estudiante</option>
                <option value="I" {{ old('tipo_usuario', $user->tipo_usuario) == 'I' ? 'selected' : '' }}>Instructor</option>
            </select>
            <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
        </div>

        <!-- Rol -->
        <div class="mt-4">
            <x-input-label for="id_rol" :value="__('Rol')" />
            <select id="id_rol" name="id_rol" class="block mt-1 w-full rounded" required>
                <option value="">Seleccione</option>
