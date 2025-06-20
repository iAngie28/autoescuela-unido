@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white text-black py-10 px-4 rounded-lg shadow">
                    <h1 class="text-3xl font-bold mb-6 text-left">Categorías de Examen</h1>
                    <div class="flex items-center justify-between mb-6">
                        <div></div>

                    <div class="flex items-center justify-between mb-6">
                        <a href="{{ route('examen-categoria-aspiras.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Crear Nueva Categoría
                        </a>
                    </div>
                    </div>
                    

                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                            {{ $message }}
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">#</th>
                                    <th class="py-3 px-6 text-left">Nombre</th>
                                    <th class="py-3 px-6 text-left">Costo</th>
                                    <th class="py-3 px-6 text-left">Nota Mín. Práctica</th>
                                    <th class="py-3 px-6 text-left">Nota Mín. Teórica</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($examenCategoriaAspiras as $i => $examenCategoriaAspira)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $i + $examenCategoriaAspiras->firstItem() }}</td>
                                        <td class="py-3 px-6 text-center">{{ $examenCategoriaAspira->nombre }}</td>
                                        <td class="py-3 px-6 text-center">{{ $examenCategoriaAspira->costo }}</td>
                                        <td class="py-3 px-6 text-center">{{ $examenCategoriaAspira->nota_min_pract }}</td>
                                        <td class="py-3 px-6 text-center">{{ $examenCategoriaAspira->nota_min_teorica }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('examen-categoria-aspiras.show', $examenCategoriaAspira->id) }}"
                                                    class="text-blue-500 hover:scale-110">👁 Ver</a>
                                                <a href="{{ route('examen-categoria-aspiras.edit', $examenCategoriaAspira->id) }}"
                                                    class="text-green-500 hover:scale-110">✏ Editar</a>
                                                <form action="{{ route('examen-categoria-aspiras.destroy', $examenCategoriaAspira->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="event.preventDefault(); confirm('¿Seguro que deseas eliminar esta categoría?') ? this.closest('form').submit() : false;" class="text-red-500 hover:scale-110">
                                                        🗑 Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $examenCategoriaAspiras->withQueryString()->links() }}
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection