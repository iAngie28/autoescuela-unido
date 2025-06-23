@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white text-black py-10 px-4 rounded-lg shadow">
                    <!-- Encabezado -->
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-3xl font-bold text-left">Paquetes</h1>
                        <a href="{{ route('paquetes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Crear Nuevo
                        </a>
                    </div>

                    <!-- Mensaje de éxito -->
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                            {{ $message }}
                        </div>
                    @endif

                    <!-- Tabla -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">#</th>
                                    <th class="py-3 px-6 text-center">Cant. Clases</th>
                                    <th class="py-3 px-6 text-center">Capacidad Est.</th>
                                    <th class="py-3 px-6 text-center">Costo</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($paquetes as $i => $paquete)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $i + $paquetes->firstItem() }}</td>
                                        <td class="py-3 px-6 text-center">{{ $paquete->cant_class }}</td>
                                        <td class="py-3 px-6 text-center">{{ $paquete->capacidad_est }}</td>
                                        <td class="py-3 px-6 text-center">{{ $paquete->costo }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('paquetes.show', $paquete->id) }}"
                                                    class="text-blue-500 hover:scale-110">👁 Ver</a>
                                                <a href="{{ route('paquetes.edit', $paquete->id) }}"
                                                    class="text-green-500 hover:scale-110">✏ Editar</a>
                                                <form action="{{ route('paquetes.destroy', $paquete->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="event.preventDefault(); confirm('¿Seguro que deseas eliminar este paquete?') ? this.closest('form').submit() : false;"
                                                        class="text-red-500 hover:scale-110">
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
                        {{ $paquetes->withQueryString()->links() }}
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection

