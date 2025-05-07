@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Inscribe</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('inscribes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Insc:</strong>
                                    {{ $inscribe->fecha_Insc }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Categoria Actual:</strong>
                                    {{ $inscribe->categoria_actual }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Categoria:</strong>
                                    {{ $inscribe->id_categoria }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Pago:</strong>
                                    {{ $inscribe->id_pago }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Paquete:</strong>
                                    {{ $inscribe->id_paquete }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
