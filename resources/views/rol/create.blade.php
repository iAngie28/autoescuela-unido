@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen bg-gray-100">
        <div class="flex flex-1 justify-center p-6">

            <!-- Contenido principal -->
            <main class="w-full max-w-2xl">
                <h1 class="text-3xl font-bold text-gray-700 mb-6">Crear Nuevo Rol</h1>

                <div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('rols.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Campo Nombre del Rol -->
                            <div class="mb-5">
                                <label for="nombre" class="block text-lg font-bold text-gray-600">Nombre del Rol</label>
                                <input type="text" id="nombre" name="nombre"
                                    class="w-full border border-gray-300 shadow-md p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('nombre') border-red-500 @enderror"
                                    placeholder="Ingrese el nombre del rol"
                                    required>
                                @error('nombre')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Campo Permisos -->
                            <div class="mb-5">
                                <label for="permisos" class="block text-lg font-bold text-gray-600">Permisos</label>
                                <textarea id="permisos" name="permisos"
                                    class="w-full border border-gray-300 shadow-md p-3 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 @error('permisos') border-red-500 @enderror"
                                    placeholder="Ingrese los permisos del rol"
                                    required></textarea>
                                @error('permisos')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Botón de envío -->
                            <div class="text-center mt-6">
                                <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-300 font-bold">
                                    Crear Rol
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

        </div>
    </div>
@endsection
