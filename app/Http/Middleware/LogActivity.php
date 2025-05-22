<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Middleware LogActivity ejecutado'); // Confirmación de ejecución

        if (Auth::check()) {
            try {
                $bitacora = Bitacora::create([
                    'id_user' => Auth::id(),
                    'direccion_ip' => $request->ip(),
                    'visitas' => $request->url(),
                    'acciones' => 'Página visitada'
                ]);

                Log::info('Registro guardado en bitacora con ID: ' . $bitacora->id);
            } catch (\Exception $e) {
                Log::error('Error al guardar en bitacora: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}
