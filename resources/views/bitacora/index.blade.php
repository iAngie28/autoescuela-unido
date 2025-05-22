@extends('layouts.app')

@section('content')
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
@endsection
