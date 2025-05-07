@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Clase</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('clases.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    {{ $clase->fecha }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora Inicio:</strong>
                                    {{ $clase->hora_inicio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora Fin:</strong>
                                    {{ $clase->hora_fin }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $clase->estado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Comentario Inst:</strong>
                                    {{ $clase->comentario_Inst }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reporte Estudiante:</strong>
                                    {{ $clase->reporte_estudiante }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Paquete:</strong>
                                    {{ $clase->id_paquete }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Vehiculo:</strong>
                                    {{ $clase->id_vehiculo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Inst:</strong>
                                    {{ $clase->id_inst }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
