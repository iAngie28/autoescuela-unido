@extends('layouts.guest-bootstrap')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-bell mr-2"></i> Detalle de Notificación
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6><strong>Usuario:</strong></h6>
                            <p>{{ $notificacion->user->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Fecha:</strong></h6>
                            <p>{{ $notificacion->fecha->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6><strong>Tipo:</strong></h6>
                            <span class="badge bg-{{ $notificacion->tipo == 'Urgente' ? 'danger' : 'primary' }}">
                                {{ $notificacion->tipo }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Estado:</strong></h6>
                            <span class="badge bg-{{ $notificacion->leido ? 'success' : 'warning' }}">
                                {{ $notificacion->leido ? 'Leída' : 'Pendiente' }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6><strong>Mensaje completo:</strong></h6>
                        <div class="border p-3 bg-light">
                            {!! nl2br(e($notificacion->mensaje)) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection