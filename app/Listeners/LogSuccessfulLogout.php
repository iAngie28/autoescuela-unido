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
        
        $lastEntry = Bitacora::where('id_user', $event->user->id)
        ->whereNull('fecha_salida')
        ->latest()
        ->first();

        if ($lastEntry) {
        $lastEntry->update([
            'fecha_salida' => now(),
            'accion' => $lastEntry->actions . "\nCierre de sesión"
        ]);
    }
    }
}
