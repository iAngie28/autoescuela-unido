<div class="bg-white p-10 rounded-lg shadow mx-auto max-w-xl">
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-6">
        {{ method_field('PATCH') }}
        @csrf

        <!-- Nombre -->
        <div class="mb-5">
            <label for="name" class="block text-gray-700 font-bold text-left mb-2">Nombre</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Nombre de usuario -->
        <div class="mb-5">
            <label for="username" class="block text-gray-700 font-bold text-left mb-2">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="{{ $user->username }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label for="email" class="block text-gray-700 font-bold text-left mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Teléfono -->
        <div class="mb-5">
            <label for="telefono" class="block text-gray-700 font-bold text-left mb-2">Teléfono</label>
            <input type="text" id="telefono" name="telefono" value="{{ $user->telefono }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Dirección -->
        <div class="mb-5">
            <label for="direccion" class="block text-gray-700 font-bold text-left mb-2">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="{{ $user->direccion }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Fecha de Registro -->
        <div class="mb-5">
            <label for="fecha_registro" class="block text-gray-700 font-bold text-left mb-2">Fecha de Registro</label>
            <input type="date" id="fecha_registro" name="fecha_registro" value="{{ $user->fecha_registro }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- CI -->
        <div class="mb-5">
            <label for="ci" class="block text-gray-700 font-bold text-left mb-2">Cédula de Identidad</label>
            <input type="text" id="ci" name="ci" value="{{ $user->ci }}"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tipo de Usuario -->
        <div class="mb-5">
            <label for="tipo_usuario" class="block text-gray-700 font-bold text-left mb-2">Tipo de Usuario</label>
            <select id="tipo_usuario" name="tipo_usuario"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="A" {{ $user->tipo_usuario == 'A' ? 'selected' : '' }}>Administrador</option>
                <option value="E" {{ $user->tipo_usuario == 'E' ? 'selected' : '' }}>Estudiante</option>
                <option value="I" {{ $user->tipo_usuario == 'I' ? 'selected' : '' }}>Instructor</option>
            </select>
        </div>

        <!-- Rol -->
        <div class="mb-5">
            <label for="id_rol" class="block text-gray-700 font-bold text-left mb-2">Rol</label>
            <select id="id_rol" name="id_rol"
                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $user->id_rol == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-end">
            <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 mr-2">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                Guardar cambios
            </button>
        </div>
    </form>
</div>
