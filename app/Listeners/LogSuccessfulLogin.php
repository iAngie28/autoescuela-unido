<?php

namespace App\Listeners;

use App\Models\Bitacora; 
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        Log::info('Listener de Login ejecutado');
        Bitacora::create([
            'id_user' => $event->user->id,
            'direccion_ip' => request()->ip(),
            'fecha_entrada' => now(),
            'accion' => 'inicio de sesion'
        ]);
    }
}