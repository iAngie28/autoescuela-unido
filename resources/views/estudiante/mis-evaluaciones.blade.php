@extends('layouts.guest-bootstrap')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-clipboard-list"></i> Mis Evaluaciones</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Instructor</th>
                        <th>Nota</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evaluaciones as $evaluacion)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($evaluacion->fecha_evaluacion)->format('d/m/Y') }}</td>
                        <td>{{ $evaluacion->instructor->name ?? 'N/A' }}</td>
                        <td>{{ $evaluacion->nota_final }}/100</td>
                        <td>
                            @if($evaluacion->nota_final >= 60)
                                <span class="badge bg-success">Aprobado</span>
                            @else
                                <span class="badge bg-danger">Reprobado</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('estudiante.ver-evaluacion', $evaluacion->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection