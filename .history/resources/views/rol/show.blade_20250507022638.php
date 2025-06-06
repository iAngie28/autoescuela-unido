@extends('layouts.guest-bootstrap')
@section('content')
    <section class="content container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Rol</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('rols.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $rol->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Permisos:</strong>
                                    {{ $rol->permisos }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
