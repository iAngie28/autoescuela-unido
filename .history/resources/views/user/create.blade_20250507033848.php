@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} User</span>
                    </div>
                    <div class="card-body bg-white">
                        @include('/resources/views/livewire/pages/auth/register.blade.php')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
