@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registros de Bitácora</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>IP</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registros as $registro)
            <tr>
                <td>
            @if($registro->relacionUsuario)
                {{ $registro->relacionUsuario->name }}
            @else
                <span class="text-danger">Usuario Eliminado</span>
            @endif
            </td>
            <td>{{ $registro->direccion_ip }}</td>
            <td>{{ $registro->fecha_entrada->format('d/m/Y H:i:s') }}</td>
            <td>
            @if($registro->fecha_salida)
                {{ $registro->fecha_salida->format('d/m/Y H:i:s') }}
            @else
                <span class="text-success">Sesión Activa</span>
            @endif
            </td>
        <td>
            <pre>{{ $registro->accion }}</pre>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">No hay registros en la bitácora</td>
    </tr>
    @endforelse
</tbody>
    </table>
    
    <div class="d-flex justify-content-center">
        {{ $registros->links() }}
    </div>
</div>
@endsection