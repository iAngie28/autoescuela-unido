<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class RegistrarBitacora
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        if (Auth::check()) {
            Bitacora::create([
                'id_user' => Auth::id(),
                'ip'      => $request->ip(),
                'accion'  => $this->obtenerAccion($request)
            ]);
        }

        return $response;
    }

    protected function obtenerAccion(Request $request): string
    {
        $ruta = $request->route() ? $request->route()->uri() : $request->path();
        $metodo = $request->method();

        $acciones = [
            'GET' => 'Consulta',
            'POST' => 'Creación',
            'PUT' => 'Actualización',
            'PATCH' => 'Actualización parcial',
            'DELETE' => 'Eliminación',
        ];

        $verbo = $acciones[$metodo] ?? $metodo;

        return "{$verbo} en {$ruta}";
    }
}