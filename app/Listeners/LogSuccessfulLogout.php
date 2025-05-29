<?php

namespace App\Listeners;

use App\Models\Bitacora; 
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        $bitacora = Bitacora::where('id_user', $event->user->id)
            ->whereNull('fecha_salida')
            ->latest()
            ->first();

        if ($bitacora) {
            $bitacora->update([
                'fecha_salida' => now(),
                'accion' => $bitacora->accion . "\n" . now()->format('Y-m-d H:i:s') . ': Cierre de sesión'
            ]);
        }
    }
}
