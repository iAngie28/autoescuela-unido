@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Usuario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Ci:</strong>
                                    {{ $usuario->CI }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>User:</strong>
                                    {{ $usuario->user }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombrecompleto:</strong>
                                    {{ $usuario->NombreCompleto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Sexo:</strong>
                                    {{ $usuario->sexo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono:</strong>
                                    {{ $usuario->telefono }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Direccion:</strong>
                                    {{ $usuario->direccion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fch Reg:</strong>
                                    {{ $usuario->fch_reg }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Rol:</strong>
                                    {{ $usuario->id_rol }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
