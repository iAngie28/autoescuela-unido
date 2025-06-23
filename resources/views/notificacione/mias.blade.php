@extends('layouts.guest-bootstrap')

@section('content')
<div class="container mt-5">
    <h4>🔔 Mis Notificaciones</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($notificaciones as $noti)
        <div class="alert {{ $noti->leido ? 'alert-secondary' : 'alert-info' }}">
            <strong>{{ $noti->tipo }}</strong>: {{ $noti->mensaje }}
            <br><small>{{ $noti->fecha }}</small>

            @if (!$noti->leido)
                <form method="POST" action="{{ route('notificaciones.marcar', $noti->id) }}" class="mt-2">
                    @csrf
                    <button class="btn btn-sm btn-success">Marcar como leída</button>
                </form>
            @else
                <span class="badge bg-success">Leída</span>
            @endif
        </div>
    @empty
        <p>No tienes notificaciones.</p>
    @endforelse
    
     @auth
    @php
        $roleId = auth()->user()->id_rol;
        $roleName = \App\Models\Rol::find($roleId)->nombre ?? null;
    @endphp

    @if($roleName == 'Administrador')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Volver al Dashboard
        </a>
    @elseif($roleName == 'Estudiante')
        <a href="{{ route('estudiante.dashboard') }}" class="btn btn-secondary ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Volver al Dashboard
        </a>
    @elseif($roleName == 'Instructor')
        <a href="{{ route('instructor.dashboard') }}" class="btn btn-secondary ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Volver al Dashboard
        </a>
    @else
        <a href="{{ route('dashboard') }}" class="btn btn-secondary ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Volver
        </a>
    @endif
@endauth

</div>
@endsection
