@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white p-6 rounded-lg shadow-lg max-w-xl mx-auto">
                    <h1 class="text-3xl font-bold text-left mb-6">Evaluación de {{ $user->name }}</h1>

                    <!-- Formulario -->
                    <form action="{{ route('examen.guardar', $user->id) }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Estacionamiento -->
                            <div>
                                <label class="block font-semibold">Estacionamiento:</label>
                                <select name="estacionamiento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="Excelente">Excelente</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Regular">Regular</option>
                                </select>
                            </div>

                            <!-- Zigzag -->
                            <div>
                                <label class="block font-semibold">ZigZag:</label>
                                <select name="zigzag" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="Excelente">Excelente</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Regular">Regular</option>
                                </select>
                            </div>

                            <!-- Retroceso -->
                            <div>
                                <label class="block font-semibold">Retroceso:</label>
                                <select name="retroceso" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="Excelente">Excelente</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Regular">Regular</option>
                                </select>
                            </div>

                            <!-- Conducción en vía -->
                            <div>
                                <label class="block font-semibold">Conducción en vía:</label>
                                <select name="conduccion_via" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="Excelente">Excelente</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Regular">Regular</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="w-full bg-green-500 text-white px-6 py-2 rounded-lg mt-4 hover:bg-green-600 transition duration-300">
                            Guardar Evaluación
                        </button>
                    </form>
                </section>
            </main>
        </div>
    </div>
@endsection
