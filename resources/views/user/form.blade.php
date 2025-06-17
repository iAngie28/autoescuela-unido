<form method="POST" action="{{ route('usuarios.update', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- Nombre -->
    <div class="mb-4">
        <label for="name" class="block font-semibold mb-1">Nombre</label>
        <input id="name" name="name" type="text"
            value="{{ old('name', $user->name) }}"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
            required>
        @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- Username -->
    <div class="mb-4">
        <label for="username" class="block font-semibold mb-1">Username</label>
        <input id="username" name="username" type="text"
            value="{{ old('username', $user->username) }}"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
            required>
        @error('username') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input id="email" name="email" type="email"
            value="{{ old('email', $user->email) }}"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
            required>
        @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- Sexo -->
    <div class="mb-4">
        <label for="sexo" class="block font-semibold mb-1">Sexo</label>
        <select id="sexo" name="sexo"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;"
            required>
            <option value="">Seleccione</option>
            <option value="masculino" {{ old('sexo', $user->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="femenino" {{ old('sexo', $user->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="otro" {{ old('sexo', $user->sexo) == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
        @error('sexo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- Teléfono -->
    <div class="mb-4">
        <label for="telefono" class="block font-semibold mb-1">Teléfono</label>
        <input id="telefono" name="telefono" type="text"
            value="{{ old('telefono', $user->telefono) }}"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
        @error('telefono') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- Dirección -->
    <div class="mb-4">
        <label for="direccion" class="block font-semibold mb-1">Dirección</label>
        <input id="direccion" name="direccion" type="text"
            value="{{ old('direccion', $user->direccion) }}"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
        @error('direccion') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- Fecha de Registro -->
    <div class="mb-4">
        <label for="fecha_registro" class="block font-semibold mb-1">Fecha de Registro</label>
        <input id="fecha_registro" name="fecha_registro" type="date"
            value="{{ old('fecha_registro', $user->fecha_registro) }}"
            class="w-full px-4 py-2 rounded-md focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
            style="background-color: #293241; color: #f1f1f1; border: 1px solid #222b38;">
        @error('fecha_registro') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    
    <!-- CI -->
    <div class="mb-4">
        <label for="ci" class="block font-semibold mb-1">Cédula de Identidad</label>
        <input id="ci" name="ci" type="text"
            value="{{ old('ci', $user->ci) }}"
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
            <option value="A" {{ old('tipo_usuario', $user->tipo_usuario) == 'A' ? 'selected' : '' }}>Administrador</option>
            <option value="E" {{ old('tipo_usuario', $user->tipo_usuario) == 'E' ? 'selected' : '' }}>Estudiante</option>
            <option value="I" {{ old('tipo_usuario', $user->tipo_usuario) == 'I' ? 'selected' : '' }}>Instructor</option>
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
                <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol) == $rol->id ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </optioren>
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
            Guardar cambios
        </button>
    </div>
</form>