@extends('layouts.app')

@section('content')


<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Historial de Pagos QR</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Curso</th>
                    <th class="px-4 py-2">Monto (Bs.)</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Ver QR</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagos as $pago)
                <tr>
                    <td class="border px-4 py-2">{{ $pago->created_at->format('d/m/Y H:i') }}</td>
                    <td class="border px-4 py-2">{{ $pago->description }}</td>
                    <td class="border px-4 py-2">{{ number_format($pago->amount, 2) }}</td>
                    <td class="border px-4 py-2">
                        @if($pago->status === 'COMPLETED')
                            <span class="text-green-600 font-bold">Completado</span>
                        @elseif($pago->status === 'FAILED')
                            <span class="text-red-600 font-bold">Fallido</span>
                        @else
                            <span class="text-yellow-600 font-bold">Pendiente</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('qr.display', $pago->id) }}" target="_blank" class="text-blue-500 underline">Ver QR</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No tienes pagos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
