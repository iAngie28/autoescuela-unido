@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <h1>Registros de la Bitácora</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Acción</th>
                <th>IP</th>
                <th>Entrada</th>
                <th>Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bitacoras as $bitacora)
                <tr>
                    <td>{{ $bitacora->usuario->name ?? 'Invitado' }}</td>
                    <td>{{ $bitacora->accion }}</td>
                    <td>{{ $bitacora->direccion_ip }}</td>
                    <td>{{ $bitacora->fecha_entrada }} {{ $bitacora->hora_entrada }}</td>
                    <td>
                        @if ($bitacora->fecha_salida)
                            {{ $bitacora->fecha_salida }} {{ $bitacora->hora_salida }}
                        @else
                            En proceso...
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
=======
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Registros de la Bitácora</h1>

        <!-- Tabla de registros -->
        <table class="table-auto w-full bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                    <th class="px-4 py-2">Usuario</th>
                    <th class="px-4 py-2">Acción</th>
                    <th class="px-4 py-2">IP</th>
                    <th class="px-4 py-2">Fecha de Entrada</th>
                    <th class="px-4 py-2">Última Actualización</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bitacoras as $bitacora)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $bitacora->user->name ?? 'Invitado' }}</td>
                        <td class="px-4 py-2">{{ $bitacora->acciones }}</td>
                        <td class="px-4 py-2">{{ $bitacora->direccion_ip }}</td>
                        <td class="px-4 py-2">{{ $bitacora->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="px-4 py-2">{{ $bitacora->updated_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $bitacoras->links() }}
        </div>
    </div>
>>>>>>> origin/ismael
@endsection
