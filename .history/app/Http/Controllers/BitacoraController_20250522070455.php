<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;

class BitacoraController extends Controller
{
    /**
     * Registrar una acción en la bitácora.
     */
    public function iniciarAccion(Request $request, $accion)
    {
        $bitacora = Bitacora::create([
            'id_user' => Auth::id(),
            'direccion_ip' => $request->ip(),
            'visitas' => $request->url(),
            'acciones' => $accion
        ]);

        return response()->json(['mensaje' => 'Acción registrada', 'id' => $bitacora->id]);
    }

    /**
     * Finalizar una acción en la bitácora.
     */
    public function finalizarAccion($id)
    {
        Bitacora::where('id', $id)->update([
            'acciones' => 'Acción finalizada',
            'updated_at' => now(),
        ]);

        return response()->json(['mensaje' => 'Acción finalizada']);
    }

    /**
     * Mostrar la bitácora con filtros y paginación.
     */
    public function index(Request $request)
    {
        $query = Bitacora::with('user')->latest();

        // Filtrar por usuario
        if ($request->filled('user_id')) {
            $query->where('id_user', $request->user_id);
        }

        // Filtrar por fecha
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $bitacoras = $query->paginate(20);

       return view('bitacora.index', compact('bitacoras'));
    }
}
