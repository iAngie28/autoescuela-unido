@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">

                {{-- ========== FORMULARIO DE NUEVO PAGO (reutilizado) ========== --}}
                <section class="bg-white text-black p-6 rounded-lg shadow mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Registrar Nuevo Pago</h2>

                    <form method="POST" action="{{ route('pagos.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pago.form')
                    </form>
                </section>

                {{-- ========== MENSAJE DE ÉXITO ========== --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-4 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-4 mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- ========== TABLA DE PAGOS ========== --}}
                <section class="bg-white text-black py-6 px-4 rounded-lg shadow">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-3xl font-bold">Pagos Registrados</h1>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">ID</th>
                                    <th class="py-3 px-6 text-center">Fecha</th>
                                    <th class="py-3 px-6 text-center">Detalle</th>
                                    <th class="py-3 px-6 text-center">Monto</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($pagos as $pago)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $pago->id }}</td>
                                        <td class="py-3 px-6 text-center">{{ $pago->fecha }}</td>
                                        <td class="py-3 px-6 text-center">{{ $pago->detalle }}</td>
                                        <td class="py-3 px-6 text-center">{{ $pago->monto }} Bs</td>
                                        <td class="py-3 px-2 text-right">
                                            <div class="flex items-end justify-end space-x-4">
                                                <div class="flex flex-col items-center">
                                                    <span>👁</span>
                                                    <a href="{{ route('pagos.show', $pago->id) }}"
                                                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition">👁</a>
                                                </div>
                                                @if ($pago->estado !== 'anulado')
                                                    @if ($pago->estado === 'Finalizado')
                                                        {{-- Solo mostrar botón de anular --}}
                                                        <div class="flex flex-col items-center">
                                                            <span>↩️</span>
                                                            <form action="{{ route('pagos.anular', $pago->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('¿Seguro que deseas anular este pago?');">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="text-red-500 text-sm">Anular</button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        {{-- Mostrar ambos botones --}}
                                                        <div class="flex flex-col items-center">
                                                            <span>✏</span>
                                                            <a href="{{ route('pagos.inscribir', $pago->id) }}"
                                                                class="text-green-500 text-sm">Inscribir</a>
                                                        </div>

                                                        <div class="flex flex-col items-center">
                                                            <span>↩️</span>
                                                            <form action="{{ route('pagos.anular', $pago->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('¿Seguro que deseas anular este pago?');">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="text-red-500 text-sm">Anular</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación --}}
                    <div class="mt-6">
                        {{ $pagos->withQueryString()->links() }}
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection
