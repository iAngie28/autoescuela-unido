@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Instructor</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('instructors.update', $instructor->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('instructor.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
