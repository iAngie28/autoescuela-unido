@extends('layouts.guest-bootstrap')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-bell mr-2"></i> Historial de Notificaciones
                        </h5>
                        
                        
                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3 rounded">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                @endif

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th width="20%">Usuario</th>
                                    <th width="40%">Mensaje</th>
                                    <th class="text-center" width="10%">Tipo</th>
                                    <th class="text-center" width="15%">Fecha</th>
                                    <th class="text-center" width="10%">Estado</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notificaciones as $key => $notificacione)
                                <tr class="{{ $notificacione->leido ? '' : 'bg-light-blue' }}">
                                    <td class="text-center">{{ $i + $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            
                                            <div>
                                                <h6 class="mb-0">{{ $notificacione->user->name ?? 'N/A' }}</h6>
                                                <small class="text-muted">{{ $notificacione->user->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-truncate" style="max-width: 100%;">
                                            {{ $notificacione->mensaje }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill bg-{{ $notificacione->tipo == 'Urgente' ? 'danger' : 'info' }}-soft text-{{ $notificacione->tipo == 'Urgente' ? 'danger' : 'info' }}">
                                            {{ $notificacione->tipo }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted">{{ $notificacione->fecha->format('d/m/Y H:i') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill bg-{{ $notificacione->leido ? 'success' : 'warning' }}-soft text-{{ $notificacione->leido ? 'success' : 'warning' }}">
                                            {{ $notificacione->leido ? 'Leída' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox fa-4x text-gray-400 mb-3"></i>
                                            <h4 class="text-muted">No se encontraron notificaciones</h4>
                                            <p class="text-muted">No hay notificaciones registradas en el sistema</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                         

                    <div class="d-flex justify-content-between align-items-center p-3 border-top">
                        <div class="text-muted small">
                            Mostrando <span class="font-weight-bold">{{ $notificaciones->firstItem() }}</span> a 
                            <span class="font-weight-bold">{{ $notificaciones->lastItem() }}</span> de 
                            <span class="font-weight-bold">{{ $notificaciones->total() }}</span> registros
                        </div>
                        

                        <div class="btn-group">
                            <a href="{{ $notificaciones->previousPageUrl() }}" 
                               class="btn btn-outline-primary btn-sm {{ $notificaciones->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-chevron-left"></i> Anterior
                            </a>
                            <a href="{{ $notificaciones->nextPageUrl() }}" 
                               class="btn btn-outline-primary btn-sm {{ !$notificaciones->hasMorePages() ? 'disabled' : '' }}">
                                Siguiente <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush

@push('styles')
<style>
.bg-light-blue {
    background-color: rgba(13, 110, 253, 0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(87deg,rgba(10, 23, 207, 0.83) 0,rgba(10, 23, 207, 0.83) 0) !important;
}

.empty-state {
    padding: 2rem;
    text-align: center;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    border-top: none;
}

.table td {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

.btn-outline-primary.disabled {
    color: #adb5bd;
    border-color: #dee2e6;
    background-color: transparent;
    pointer-events: none;
}

.bg-info-soft {
    background-color: rgba(151, 204, 204, 0.23) !important;
}

.bg-danger-soft {
    background-color: rgba(138, 31, 41, 0.38) !important;
}

.bg-success-soft {
    background-color: rgba(20, 206, 45, 0.1)!important;
}

.bg-warning-soft {
    background-color: rgba(236, 222, 29, 0.32) !important;
}
</style>
@endpush