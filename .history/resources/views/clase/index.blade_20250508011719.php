@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary btn-sm float-left"  data-placement="left">
                                {{ __('Volver') }}
                              </a>
                              
                            <span id="card_title">
                                {{ __('Clases') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clases.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        
									<th >Fecha</th>
									<th >Hora Inicio</th>
									<th >Hora Fin</th>
									<th >Estado</th>
									<th >Comentario Inst</th>
									<th >Reporte Estudiante</th>
									<th >Id Paquete</th>
									<th >Id Vehiculo</th>
									<th >Id Inst</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clases as $clase)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $clase->fecha }}</td>
										<td >{{ $clase->hora_inicio }}</td>
										<td >{{ $clase->hora_fin }}</td>
										<td >{{ $clase->estado }}</td>
										<td >{{ $clase->comentario_Inst }}</td>
										<td >{{ $clase->reporte_estudiante }}</td>
										<td >{{ $clase->id_paquete }}</td>
										<td >{{ $clase->id_vehiculo }}</td>
										<td >{{ $clase->id_inst }}</td>

                                            <td>
                                                <form action="{{ route('clases.destroy', $clase->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('clases.show', $clase->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('clases.edit', $clase->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $clases->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
