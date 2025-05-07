@extends('layouts.app')

@section('template_title')
    Examen Segips
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Examen Segips') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('examen-segips.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Id Est</th>
									<th >Id Grupo</th>
									<th >Nro Intento</th>
									<th >Nota Teorica</th>
									<th >Nota Practica</th>
									<th >Estado</th>
									<th >Id Categoria</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examenSegips as $examenSegip)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $examenSegip->id_est }}</td>
										<td >{{ $examenSegip->id_grupo }}</td>
										<td >{{ $examenSegip->nro_intento }}</td>
										<td >{{ $examenSegip->nota_Teorica }}</td>
										<td >{{ $examenSegip->nota_Practica }}</td>
										<td >{{ $examenSegip->estado }}</td>
										<td >{{ $examenSegip->id_categoria }}</td>

                                            <td>
                                                <form action="{{ route('examen-segips.destroy', $examenSegip->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('examen-segips.show', $examenSegip->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('examen-segips.edit', $examenSegip->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $examenSegips->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
