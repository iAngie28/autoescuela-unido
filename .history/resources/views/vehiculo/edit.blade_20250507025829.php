<div class="container-fluid mt-5">

        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Vehiculo</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('vehiculos.update', $vehiculo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('vehiculo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
