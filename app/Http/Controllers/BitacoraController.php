<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;

class BitacoraController extends Controller
{
    public function index(Request $request)
    {
        $query = Bitacora::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('accion', 'like', "%$search%")
                  ->orWhere('ip', 'like', "%$search%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
            });
        }

        $bitacoras = $query->paginate(15);
        
        return view('bitacora.index', compact('bitacoras'));
    }

    public function show($id)
    {
        $bitacora = Bitacora::with('user')->findOrFail($id);
        return view('bitacora.show', compact('bitacora'));
    }
}