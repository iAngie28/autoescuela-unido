@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Instructor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('instructors.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Categ Licencia:</strong>
                                    {{ $instructor->categ_licencia }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
