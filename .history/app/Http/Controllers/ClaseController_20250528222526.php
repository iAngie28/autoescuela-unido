<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClaseRequest;
use App\Models\Paquete;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $clases = Clase::paginate();

        return view('clase.index', compact('clases'))
            ->with('i', ($request->input('page', 1) - 1) * $clases->perPage());
    }
    public function reprogramar(Request $request): View
    {
        $clases = Clase::where('estado', 'cancelada')->paginate();
        return view('clase.reprogramar', compact('clases'));
    }

    public function asingar_estudiante_clase(Request $request): View
    {
        $clases = Clase::where('estado', 'programada')->paginate();
        $usuariosEstudiante = User::where('id_rol', 2)->with('estudiante')->get();
        return view('clase.asignar_clase', compact('clases', 'usuariosEstudiante'));
    }

    public function clase_est(Request $request): View
    {
        $user = auth()->user();

        // Validar que el usuario sea tipo estudiante
        if ($user->tipo_usuario !== 'E') {
            abort(403, 'Acceso no autorizado');
        }

        // Obtener solo clases programadas del estudiante actual
        $clases = Clase::where('estado', 'inscrita')
            ->where('id_est', $user->id)
            ->paginate();

        return view('clase.clase_est', compact('clases'));
    }
    public function clase_inst(Request $request): View
    {
        $user = auth()->user();

        // Validar que el usuario sea tipo instructor
        if ($user->tipo_usuario !== 'I') {
            abort(403, 'Acceso no autorizado');
        }
        return view('clase.clase_int', compact('clases'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $clase = new Clase();
        $paquetes = Paquete::all();
        $usuariosInstructor = User::where('id_rol', 3)->with('instructor')->get();
        return view('clase.create', compact('clase', 'paquetes', 'usuariosInstructor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClaseRequest $request): RedirectResponse
    {
        Clase::create($request->validated());

        return Redirect::route('clases.index')
            ->with('success', 'Clase creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $clase = Clase::find($id);

        return view('clase.show', compact('clase'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $clase = Clase::find($id);
        $paquetes = Paquete::all();
        $usuariosInstructor = User::where('id_rol', 3)->get();

        return view('clase.edit', compact('clase', 'paquetes', 'usuariosInstructor'));
    }
    public function cancelarClase($id): RedirectResponse
    {
        try {
            // 1. Buscar la clase (falla si no existe)
            $clase = Clase::findOrFail($id);
            // 3. Actualizar estado
            $clase->update([
                'estado' => 'cancelada'
            ]);

            // 4. Redirigir con mensaje de éxito
            return back()->with('success', 'Clase cancelada correctamente.');
        } catch (\Exception $e) {
            // 5. Manejar errores inesperados
            return back()->with('error', 'Error al cancelar la clase: ' . $e->getMessage());
        }
    }

    public function reprogramarClase(Request $request, $id)
    {
        $request->validate([
            'nueva_fecha' => 'required|date|after_or_equal:today' // Validación básica
        ]);

        try {
            $clase = Clase::findOrFail($id);

            // --- Validación de conflicto por instructor y estudiante ---
            $conflicto = Clase::where('fecha', $request->nueva_fecha)
                ->where('id', '!=', $clase->id) // Excluir la clase actual
                ->where(function ($query) use ($clase) {
                    $query->where('id_inst', $clase->id_inst);
                    if ($clase->id_estudiante) {
                        $query->orWhere('id_estudiante', $clase->id_estudiante);
                    }
                })
                ->exists();

            if ($conflicto) {
                return back()->with('error', 'No se puede reprogramar: el instructor o el estudiante ya tienen una clase en esa fecha.');
            }

            // Si no hay conflicto, actualizar la clase
            $clase->update([
                'fecha' => $request->nueva_fecha,
                'estado' => 'programada'
            ]);

            return back()->with('success', 'Clase reprogramada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al reprogramar: ' . $e->getMessage());
        }
    }

    public function asignar_clase(Request $request, $id)
    {
        try {
            $clase = Clase::findOrFail($id);

            // Si no hay conflicto, actualizar la clase
            $clase->update([
                'id_est' => $request->nid_est,
                'estado' => 'inscrita'
            ]);

            return back()->with('success', 'Clase asignada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al asignar: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClaseRequest $request, Clase $clase): RedirectResponse
    {
        $clase->update($request->validated());

        return back()->with('success', 'Clase updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Clase::find($id)->delete();
        return back()->with('success', 'Clase eliminada correctamente.');
    }
}
