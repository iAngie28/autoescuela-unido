<form method="POST" action="{{ route('usuarios.update', $user->id) }}" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Nombre -->
    <div>
        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
        <input id="name"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-1" />
    </div>

    <!-- Nombre de Usuario -->
    <div>
        <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Nombre de Usuario</label>
        <input id="username"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="text" name="username" value="{{ old('username', $user->username) }}" required autocomplete="username" />
        <x-input-error :messages="$errors->get('username')" class="mt-1" />
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
        <input id="email"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-1" />
    </div>

    <!-- Password (opcional) -->
    <div>
        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Contraseña (dejar vacío para no cambiar)</label>
        <input id="password"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="password" name="password" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-1" />
    </div>

    <!-- Confirmar Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña</label>
        <input id="password_confirmation"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="password" name="password_confirmation" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
    </div>

    <!-- Sexo -->
    <div>
        <label for="sexo" class="block text-sm font-semibold text-gray-700 mb-1">Sexo</label>
        <select id="sexo" name="sexo"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            <option value="">Seleccione</option>
            <option value="masculino" {{ old('sexo', $user->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="femenino" {{ old('sexo', $user->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="otro" {{ old('sexo', $user->sexo) == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
        <x-input-error :messages="$errors->get('sexo')" class="mt-1" />
    </div>

    <!-- Teléfono -->
    <div>
        <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
        <input id="telefono"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="number" name="telefono" value="{{ old('telefono', $user->telefono) }}" required />
        <x-input-error :messages="$errors->get('telefono')" class="mt-1" />
    </div>

    <!-- Dirección -->
    <div>
        <label for="direccion" class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
        <input id="direccion"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="text" name="direccion" value="{{ old('direccion', $user->direccion) }}" required />
        <x-input-error :messages="$errors->get('direccion')" class="mt-1" />
    </div>

    <!-- Fecha de Registro -->
    <div>
        <label for="fecha_registro" class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Registro</label>
        <input id="fecha_registro"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="date" name="fecha_registro" value="{{ old('fecha_registro', $user->fecha_registro) }}" />
        <x-input-error :messages="$errors->get('fecha_registro')" class="mt-1" />
    </div>

    <!-- CI -->
    <div>
        <label for="ci" class="block text-sm font-semibold text-gray-700 mb-1">Cédula de Identidad</label>
        <input id="ci"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            type="number" name="ci" value="{{ old('ci', $user->ci) }}" required />
        <x-input-error :messages="$errors->get('ci')" class="mt-1" />
    </div>

    <!-- Tipo de Usuario -->
    <div>
        <label for="tipo_usuario" class="block text-sm font-semibold text-gray-700 mb-1">Tipo de Usuario</label>
        <select id="tipo_usuario" name="tipo_usuario"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
            <option value="">Seleccione</option>
            <option value="A" {{ old('tipo_usuario', $user->tipo_usuario) == 'A' ? 'selected' : '' }}>Administrador</option>
            <option value="E" {{ old('tipo_usuario', $user->tipo_usuario) == 'E' ? 'selected' : '' }}>Estudiante</option>
            <option value="I" {{ old('tipo_usuario', $user->tipo_usuario) == 'I' ? 'selected' : '' }}>Instructor</option>
        </select>
        <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-1" />
    </div>

    <!-- Rol -->
    <div>
        <label for="id_rol" class="block text-sm font-semibold text-gray-700 mb-1">Rol</label>
        <select id="id_rol" name="id_rol"
            class="block w-full px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
            <option value="">Seleccione</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol) == $rol->id ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('id_rol')" class="mt-1" />
    </div>

    <div class="flex items-center justify-end mt-6">
        <a href="{{ route('usuarios.index') }}"
            class="mr-4 inline-block px-6 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 font-semibold transition">
            Cancelar
        </a>
        <button type="submit"
            class="inline-block px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 font-semibold transition">
            Guardar cambios
        </button>
    </div>
</form>
