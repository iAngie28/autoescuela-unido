@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Examen Segip</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('examen-segips.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Est:</strong>
                                    {{ $examenSegip->id_est }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Grupo:</strong>
                                    {{ $examenSegip->id_grupo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nro Intento:</strong>
                                    {{ $examenSegip->nro_intento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nota Teorica:</strong>
                                    {{ $examenSegip->nota_Teorica }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nota Practica:</strong>
                                    {{ $examenSegip->nota_Practica }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    {{ $examenSegip->estado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Categoria:</strong>
                                    {{ $examenSegip->id_categoria }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
