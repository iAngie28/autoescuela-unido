<form method="POST" action="{{ route('usuarios.update', $user->id) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <!-- Nombre -->
    <div>
        <label for="name" class="text-gray-600 text-sm">Nombre</label>
        <input id="name"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-1" />
    </div>

    <!-- Nombre de Usuario -->
    <div>
        <label for="username" class="text-gray-600 text-sm">Nombre de Usuario</label>
        <input id="username"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="text" name="username" value="{{ old('username', $user->username) }}" required autocomplete="username" />
        <x-input-error :messages="$errors->get('username')" class="mt-1" />
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="text-gray-600 text-sm">Email</label>
        <input id="email"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-1" />
    </div>

    <!-- Password (opcional) -->
    <div>
        <label for="password" class="text-gray-600 text-sm">Contraseña (dejar vacío para no cambiar)</label>
        <input id="password"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="password" name="password" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-1" />
    </div>

    <!-- Confirmar Password -->
    <div>
        <label for="password_confirmation" class="text-gray-600 text-sm">Confirmar Contraseña</label>
        <input id="password_confirmation"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="password" name="password_confirmation" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
    </div>

    <!-- Sexo -->
    <div>
        <label for="sexo" class="text-gray-600 text-sm">Sexo</label>
        <select id="sexo" name="sexo"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <option value="">Seleccione</option>
            <option value="masculino" {{ old('sexo', $user->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="femenino" {{ old('sexo', $user->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="otro" {{ old('sexo', $user->sexo) == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
        <x-input-error :messages="$errors->get('sexo')" class="mt-1" />
    </div>

    <!-- Teléfono -->
    <div>
        <label for="telefono" class="text-gray-600 text-sm">Teléfono</label>
        <input id="telefono"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="number" name="telefono" value="{{ old('telefono', $user->telefono) }}" required />
        <x-input-error :messages="$errors->get('telefono')" class="mt-1" />
    </div>

    <!-- Dirección -->
    <div>
        <label for="direccion" class="text-gray-600 text-sm">Dirección</label>
        <input id="direccion"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="text" name="direccion" value="{{ old('direccion', $user->direccion) }}" required />
        <x-input-error :messages="$errors->get('direccion')" class="mt-1" />
    </div>

    <!-- Fecha de Registro -->
    <div>
        <label for="fecha_registro" class="text-gray-600 text-sm">Fecha de Registro</label>
        <input id="fecha_registro"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="date" name="fecha_registro" value="{{ old('fecha_registro', $user->fecha_registro) }}" />
        <x-input-error :messages="$errors->get('fecha_registro')" class="mt-1" />
    </div>

    <!-- CI -->
    <div>
        <label for="ci" class="text-gray-600 text-sm">Cédula de Identidad</label>
        <input id="ci"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            type="number" name="ci" value="{{ old('ci', $user->ci) }}" required />
        <x-input-error :messages="$errors->get('ci')" class="mt-1" />
    </div>

    <!-- Tipo de Usuario -->
    <div>
        <label for="tipo_usuario" class="text-gray-600 text-sm">Tipo de Usuario</label>
        <select id="tipo_usuario" name="tipo_usuario"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            <option value="">Seleccione</option>
            <option value="A" {{ old('tipo_usuario', $user->tipo_usuario) == 'A' ? 'selected' : '' }}>Administrador</option>
            <option value="E" {{ old('tipo_usuario', $user->tipo_usuario) == 'E' ? 'selected' : '' }}>Estudiante</option>
            <option value="I" {{ old('tipo_usuario', $user->tipo_usuario) == 'I' ? 'selected' : '' }}>Instructor</option>
        </select>
        <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-1" />
    </div>

    <!-- Rol -->
    <div>
        <label for="id_rol" class="text-gray-600 text-sm">Rol</label>
        <select id="id_rol" name="id_rol"
            class="block w-full mt-1 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            <option value="">Seleccione</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol) == $rol->id ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('id_rol')" class="mt-1" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('usuarios.index') }}"
            class="mr-4 text-sm text-gray-600 hover:text-gray-900 underline transition">
            Cancelar
        </a>
        <button type="submit"
            class="inline-block px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 font-semibold transition">
            Guardar cambios
        </button>
    </div>
</form>
