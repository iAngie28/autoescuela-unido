@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <h1 class="text-3xl font-bold text-left mb-6">Actualizar Rol</h1>

                <section>
                    <div>
                        <form method="POST" action="{{ route('rols.update', $rol->id) }}" class="space-y-6">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="mb-5">
                                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Rol</label>
                                <input type="text" id="nombre" name="nombre" value="{{ $rol->nombre }}"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>

                            <div class="mb-5">
                                <label for="permisos" class="block text-gray-700 font-bold mb-2">Permisos</label>
                                <textarea id="permisos" name="permisos"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>{{ $rol->permisos }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <a href="{{ route('rol.index') }}"
                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 mr-2">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                    Guardar cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>


        </div>

        <!-- Footer -->

    </div>
@endsection
