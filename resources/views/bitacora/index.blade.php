@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registros de la Bitácora</h2>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>IP</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registros as $registro)
            <tr>
                <td>
                    @if($registro->user)
                        {{ $registro->user->name }} (ID: {{ $registro->user_id }})
                    @else
                        <span class="text-danger">Usuario Eliminado</span>
                    @endif
                </td>
                <td>{{ $registro->ip_address }}</td>
                <td>{{ $registro->entry_date->format('d/m/Y H:i') }}</td>
                <td>{{ $registro->exit_date?->format('d/m/Y H:i') ?? 'N/A' }}</td>
                <td><pre>{{ $registro->actions }}</pre></td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay registros.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $registros->links() }} <!-- Paginación -->
</div>
@endsection