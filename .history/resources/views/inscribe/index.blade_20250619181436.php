@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Inscribe') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inscribes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Fecha Insc</th>
									<th >Categoria Actual</th>
									<th >Id Categoria</th>
									<th >Id Pago</th>
									<th >Id Paquete</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscribes as $inscribe)
                                        <tr>
                                            
										<td >{{ $inscribe->fecha_Insc }}</td>
										<td >{{ $inscribe->categoria_actual }}</td>
										<td >{{ $inscribe->id_categoria }}</td>
										<td >{{ $inscribe->id_pago }}</td>
										<td >{{ $inscribe->id_paquete }}</td>

                                            <td>
                                                <form action="{{ route('inscribes.destroy', $inscribe->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('inscribes.show', $inscribe->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('inscribes.edit', $inscribe->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $inscribes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
