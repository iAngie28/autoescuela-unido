@extends('layouts.app')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">

            <!-- Contenido principal -->
            <main class="flex-1 bg-gray-100 text-gray-800 p-6">
                <section class="bg-white-500 text-black py-10 text-center">
                    <h1 class="text-3xl font-bold text-left mb- py-3"> Pagos</h1>

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

                    <!-- Roles Table -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">ID</th>
                                    <th class="py-3 px-6 text-center">Fecha</th>
                                    <th class="py-3 px-6 text-center">Detalles</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($pagos as $pago)
                                    <tr data-estado="{{ strtolower($pago->estado) }}"
                                        class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $pago->id }}</td>
                                        <td class="py-3 px-6 text-center">{{ $pago->fecha }}</td>
                                        <td class="py-3 px-6 text-left">{{ $pago->detalle }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pagos->withQueryString()->links() }}
                    </div>
                </section>

            </main>

        </div>
    @endsection