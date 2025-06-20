@extends('layouts.app')
@section('background-class', 'bg-gray-900 text-gray-100')

@section('content')
<div class="flex flex-col min-h-screen">
    <main class="flex-1 bg-gray-900 text-gray-100 p-6">
        
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

        <section class="bg-gray-800 text-gray-100 shadow-lg rounded-lg max-w-2xl mx-auto p-8 border border-gray-700">
            <h1 class="text-3xl font-bold text-left mb-8">Crear Clase</h1>

            <form method="POST" action="{{ route('clases.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                @include('clase.form')

            </form>
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

    </main>
</div>
@endsection
