<div class="p-10 rounded-lg mx-auto max-w-xl">
    <form method="POST" action="{{ route('usuarios.update', $user->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label for="name" class="block text-gray-700 font-bold mb-2 text-left">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div>
            <label for="username" class="block text-gray-700 font-bold mb-2 text-left">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 font-bold mb-2 text-left">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Teléfono -->
        <div>
            <label for="telefono" class="block text-gray-700 font-bold mb-2 text-left">Teléfono</label>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('telefono')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Dirección -->
        <div>
            <label for="direccion" class="block text-gray-700 font-bold mb-2 text-left">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $user->direccion) }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('direccion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fecha de Registro -->
        <div>
            <label for="fecha_registro" class="block text-gray-700 font-bold mb-2 text-left">Fecha de Registro</label>
            <input type="date" id="fecha_registro" name="fecha_registro" value="{{ old('fecha_registro', $user->fecha_registro) }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('fecha_registro')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- CI -->
        <div>
            <label for="ci" class="block text-gray-700 font-bold mb-2 text-left">Cédula de Identidad</label>
            <input type="number" id="ci" name="ci" value="{{ old('ci', $user->ci) }}" required
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('ci')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tipo de Usuario -->
        <div>
            <label for="tipo_usuario" class="block text-gray-700 font-bold mb-2 text-left">Tipo de Usuario</label>
            <select id="tipo_usuario" name="tipo_usuario"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sin asignar</option>
                <option value="A" {{ old('tipo_usuario', $user->tipo_usuario) == 'A' ? 'selected' : '' }}>Administrador</option>
                <option value="E" {{ old('tipo_usuario', $user->tipo_usuario) == 'E' ? 'selected' : '' }}>Estudiante</option>
                <option value="I" {{ old('tipo_usuario', $user->tipo_usuario) == 'I' ? 'selected' : '' }}>Instructor</option>
            </select>
            @error('tipo_usuario')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rol -->
        <div>
            <label for="id_rol" class="block text-gray-700 font-bold mb-2 text-left">Rol</label>
            <select id="id_rol" name="id_rol"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol) == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_rol')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('usuarios.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition">Cancelar</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Guardar cambios</button>
        </div>
    </form>
</div>
