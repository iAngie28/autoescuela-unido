<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;

class BitacoraController extends Controller
{
    public function iniciarAccion(Request $request, $accion)
    {
        $fechaHoraActual = now();
        
        $bitacora = Bitacora::create([
            'id_user' => Auth::id(),
            'accion' => $accion,
            'direccion_ip' => $request->ip(),
            'fecha_entrada' => $fechaHoraActual->toDateString(),
            'hora_entrada' => $fechaHoraActual->format('H:i:s'),
        ]);

        return $bitacora->id;
    }

    public function finalizarAccion($id)
    {
        $bitacora = Bitacora::find($id);
        if ($bitacora) {
            $fechaHoraActual = now();
            $bitacora->update([
                'fecha_salida' => $fechaHoraActual->toDateString(),
                'hora_salida' => $fechaHoraActual->format('H:i:s'),
            ]);
        }
        return response()->json(['mensaje' => 'Acción finalizada']);
    }
    public function index(Resquest $Resquest): view
    {
        $bitacoras = Bitacora::with('usuario')->latest()->get();
        return view('bitacoras.index', compact('bitacoras'));
    }
}
