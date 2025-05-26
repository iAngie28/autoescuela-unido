<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Symfony\Component\HttpFoundation\Response;

class LogUserActions
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (auth()->check()) {
        $bitacora = Bitacora::where('id_user', auth()->id())
            ->whereNull('fecha_salida')
            ->latest()
            ->first();

        if ($bitacora) {
            $action = "Acceso a: " . $request->path() . " (" . $request->method() . ")";
            $bitacora->update([
                'accion' => $bitacora->actions . "\n" . now()->format('Y-m-d H:i:s') . " - " . $action
            ]);
        }
    }

    return $response;
    }
}
