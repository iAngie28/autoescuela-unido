@extends('layouts.guest-bootstrap')
@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">
                            <i class="fa fa-clipboard-check"></i> {{ __('Detalle del Examen') }}
                        </span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-secondary btn-sm" href="{{ route('estudiante.mis-evaluaciones') }}">
                            <i class="fa fa-arrow-left"></i> {{ __('Volver a Mis Exámenes') }}
                        </a>
                    </div>
                </div>

                <div class="card-body bg-white">
                    <!-- Estado y Nota Final -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-{{ $estado['clase'] }}">
                                <div class="card-body text-center">
                                    <i class="fa {{ $estado['icono'] }} fa-3x text-{{ $estado['clase'] }} mb-3"></i>
                                    <h4 class="text-{{ $estado['clase'] }}">{{ $estado['estado'] }}</h4>
                                    <p class="text-muted">Estado del Examen</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-info">
                                <div class="card-body text-center">
                                    <i class="fa fa-star fa-3x text-info mb-3"></i>
                                    <h4 class="text-info">{{ $evaluacion->nota_final }}/100</h4>
                                    <p class="text-muted">Nota Final</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información General -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="mb-3">
                                <i class="fa fa-info-circle"></i> Información General
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="25%" class="bg-light">
                                            <i class="fa fa-calendar"></i> Fecha de Evaluación:
                                        </th>
                                        <td>{{ \Carbon\Carbon::parse($evaluacion->fecha_evaluacion)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">
                                            <i class="fa fa-user"></i> Instructor:
                                        </th>
                                        <td>{{ $evaluacion->instructor ? $evaluacion->instructor->name : 'No asignado' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">
                                            <i class="fa fa-clock"></i> Registrado el:
                                        </th>
                                        <td>{{ \Carbon\Carbon::parse($evaluacion->created_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Detalle de Calificaciones -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3">
                                <i class="fa fa-list-alt"></i> Detalle de Calificaciones
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Habilidad Evaluada</th>
                                            <th>Calificación</th>
                                            <th>Puntos Obtenidos</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-light">
                                        @php
                                            $puntajes = ['Excelente' => 25, 'Bueno' => 15, 'Regular' => 10];
                                            $habilidades = [
                                                'estacionamiento' => 'Estacionamiento',
                                                'zigzag' => 'Zigzag',
                                                'retroceso' => 'Retroceso',
                                                'conduccion_via' => 'Conducción en Vía'
                                            ];
                                        @endphp

                                        @foreach($habilidades as $campo => $nombre)
                                            @php
                                                $calificacion = $evaluacion->$campo;
                                                $puntos = $puntajes[$calificacion];
                                                $badgeClass = match($calificacion) {
                                                    'Excelente' => 'success',
                                                    'Bueno' => 'warning',
                                                    'Regular' => 'danger'
                                                };
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $nombre }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $badgeClass }} badge-lg">
                                                        {{ $calificacion }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-primary fw-bold">
                                                        {{ $puntos }} puntos
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-info">
                                            <td colspan="2" class="text-end fw-bold">
                                                <strong>TOTAL:</strong>
                                            </td>
                                            <td class="fw-bold text-primary">
                                                <strong>{{ $evaluacion->nota_final }} puntos</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Observaciones o consejos -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h6><i class="fa fa-lightbulb"></i> Información sobre el sistema de calificación:</h6>
                                <ul class="mb-0">
                                    <li><strong>Excelente:</strong> 25 puntos - Dominio completo de la habilidad</li>
                                    <li><strong>Bueno:</strong> 15 puntos - Buen manejo con pequeños detalles por mejorar</li>
                                    <li><strong>Regular:</strong> 10 puntos - Necesita práctica adicional</li>
                                </ul>
                                <hr>
                                <p class="mb-0"><strong>Nota mínima para aprobar:</strong> 60 puntos (de 100 posibles)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge-lg {
        font-size: 0.9em;
        padding: 0.5em 0.8em;
    }
    
    .fa-3x {
        font-size: 2.5em;
    }
    
    .card-header {
        background: linear-gradient(135deg, rgb(171, 180, 218) 0%, rgb(171, 180, 218) 0%);
        color: white;
    }

    .card-header .card-title {
        font-size: 1.2em;
        font-weight: 600;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
    }
    
    /* Estilo mejorado para la tabla principal */
    .table-bordered {
        border-color: #dee2e6;
    }
    
    .table-dark {
        background-color: #343a40;
    }
    
    .table-dark th {
        color: white;
        border-color: #454d55;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    /* Mejora para las filas de la tabla */
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.03);
    }
</style>
@endpush