<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            Bitacora::create([
                'id_user' => Auth::id(),
                'direccion_ip' => $request->ip(),
                'visitas' => $request->url(),
                'acciones' => 'Página visitada'
            ]);
        }

        return $next($request);
    }
}
