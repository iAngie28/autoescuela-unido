@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Grupo Examan</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('grupo-examen.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $grupoExaman->estado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Inicio:</strong>
                                    {{ $grupoExaman->fecha_inicio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Fin:</strong>
                                    {{ $grupoExaman->fecha_fin }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Capacidad:</strong>
                                    {{ $grupoExaman->capacidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Hora:</strong>
                                    {{ $grupoExaman->fecha_hora }}
                                </div>
                    </div>
                    @if($estudiantes->count())
    <div class="card-body mt-3 bg-white">
        <h5>Estudiantes Inscritos</h5>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>CI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $index => $estudiante)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $estudiante->estudiante->usuario->name ?? '-' }}</td>
                        <td>{{ $estudiante->examenCategoriaAspira->nombre ?? '-' }}</td>
                        <td>{{ $estudiante->estudiante->ci ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="card-body mt-3 bg-white">
        <p class="text-muted">No hay estudiantes inscritos en este grupo.</p>
    </div>
@endif

                </div>
            </div>
        </div>
    </section>
@endsection
