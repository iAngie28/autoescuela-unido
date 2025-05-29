<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Symfony\Component\HttpFoundation\Response;

class LogUserActions
{
    public function handle($request, Closure $next)
    {
    $response = $next($request);
    
    if (Auth::check()) {
        try {
            $bitacora = Bitacora::where('id_user', Auth::id())
                ->whereNull('fecha_salida')
                ->latest()
                ->first();

            if ($bitacora) {
                $action = $request->method() . ' ' . $request->path();
                
                // Registrar acciones importantes incluso si son GET
                $importantPaths = ['/admin', '/profile', '/settings'];
                $isImportant = in_array($request->path(), $importantPaths);
                
                if (!$request->isMethod('get') || $isImportant) {
                    $newAction = now()->format('Y-m-d H:i:s') . ': ' . $action;
                    $bitacora->update([
                        'accion' => $bitacora->accion . "\n" . $newAction
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error en LogUserActions: ' . $e->getMessage());
        }
    }

    return $response;
    }
}