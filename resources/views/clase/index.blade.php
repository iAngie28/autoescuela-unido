@extends('layouts.guest-bootstrap')
    @section('content')

    <!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top" style="background-color: #111827;">
    <div class="container-fluid">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-2"></i>WUILLANS</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link active text-white">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="about.html" class="nav-link text-white">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a href="courses.html" class="nav-link text-white">Cursos</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menú</a>
                    <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                        <li><a href="feature.html" class="dropdown-item">Features</a></li>
                        <li><a href="appointment.html" class="dropdown-item">Appointment</a></li>
                        <li><a href="team.html" class="dropdown-item">Our Team</a></li>
                        <li><a href="testimonial.html" class="dropdown-item">Testimonial</a></li>
                        <li><a href="404.html" class="dropdown-item">404 Page</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="https://web.whatsapp.com/" class="nav-link text-white">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->
<!-- Navbar End -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

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
