@extends('layouts.app')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div
                class="bg-gray-800 dark:bg-gray-900 px-4 py-5 border-b border-gray-700 sm:px-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">Detalle del Pago</h2>
                <a href="{{ route('pagos.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition">
                    <span class="material-symbols-outlined mr-2">arrow_back</span>
                    Volver al listado
                </a>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Monto</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pago->monto }} Bs</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pago->fecha }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Descuento</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $pago->descuento ?? 0 }} Bs</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            @switch($pago->estado)
                                @case('PIP')
                                    Pendiente de inscribir paquete
                                @break

                                @case('PIG')
                                    Pendiente de inscribir grupo
                                @break

                                @default
                                    {{ $pago->estado }}
                            @endswitch
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Estudiante</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ optional($pago->estudiante)->name ?? 'Estudiante no encontrado' }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Administrador</h3>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ optional($pago->administrador)->name ?? 'Admin no encontrado' }}
                        </p>
                    </div>
                </div>

                @if ($pago->detalle)
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Detalle</h3>
                        <div class="mt-1 bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                            <p class="text-sm text-gray-800 dark:text-gray-200 whitespace-pre-wrap">{{ $pago->detalle }}</p>
                        </div>
                    </div>
                @endif

                <div class="flex justify-end">
                    <a href="{{ route('pagos.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition">
                        <span class="material-symbols-outlined mr-2">arrow_back</span>
                        Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
