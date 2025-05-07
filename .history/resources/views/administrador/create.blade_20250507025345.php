@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Administrador</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('administradors.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('administrador.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
