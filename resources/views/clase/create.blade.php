@extends('layouts.guest-bootstrap')
    @section('content')
    <div class="container-fluid mt-5">
    @if (session('error'))
    <!-- Modal Bootstrap visible inmediatamente -->
    <div class="modal fade show" id="modalClaseRepetida" tabindex="-1" aria-labelledby="modalLabel" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Conflicto de Clase</h5>
        </div>
        <div class="modal-body">
            {{ session('error') }}
        </div>
        <div class="modal-footer">
            <a href="{{ route('clases.create') }}" class="btn btn-secondary">Cerrar</a>
        </div>
        </div>
    </div>
    </div>
    @endif


        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Clase</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('clases.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('clase.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Modal de conflicto -->
<div class="modal fade" id="conflictoModal" tabindex="-1" role="dialog" aria-labelledby="conflictoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="conflictoModalLabel">Conflicto de horario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        Ya existe una clase programada en la misma fecha y horario. Por favor, elige otra fecha u hora.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>

@if (session('clase_duplicada'))
<script>
    const conflictoModal = new bootstrap.Modal(document.getElementById('conflictoModal'));
    conflictoModal.show();
</script>
@endif

@endsection
