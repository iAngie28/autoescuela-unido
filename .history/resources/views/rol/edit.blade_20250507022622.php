@extends('layouts.guest-bootstrap')
@section('content')
    <section class="content container-fluid mt-4">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Rol</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('rols.update', $rol->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('rol.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
