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
    // Buscar la clase que se quiere reprogramar
    $clase = Clase::findOrFail($id);

    // Obtener la nueva fecha desde el formulario
    $nuevaFecha = $request->input('nueva_fecha');

    // Validar que la fecha esté presente, sea válida y no sea en el pasado
    $request->validate([
        'nueva_fecha' => 'required|date|after_or_equal:today',
    ]);

    // Verificar si ya existe una clase ese mismo día para el mismo instructor o estudiante
    $claseConflicto = Clase::where('fecha', $nuevaFecha)
        ->where('id', '!=', $clase->id) // Excluir la clase que estamos editando
        ->where(function($query) use ($clase) {
            // Verificar por instructor
            $query->where('id_inst', $clase->id_inst);

            // Si tu clase tiene estudiante, verificar también por estudiante
            if ($clase->id_estudiante) {
                $query->orWhere('id_estudiante', $clase->id_estudiante);
            }
        })
        ->first();

    if ($claseConflicto) {
        // Si hay conflicto, redirigir con mensaje de error
        return back()->with('error', 'No se puede reprogramar porque el instructor o el estudiante ya tienen una clase en esa fecha.');
    }

    // Si no hay conflicto, actualizar la fecha
    $clase->fecha = $nuevaFecha;
    $clase->save();

    // Mensaje de éxito
    return back()->with('success', 'Clase reprogramada correctamente.');
}



    /**
     * Update the specified resource in storage.
     */
    public function update(ClaseRequest $request, Clase $clase): RedirectResponse
    {
        $clase->update($request->validated());

        return Redirect::route('clases.index')
            ->with('success', 'Clase updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Clase::find($id)->delete();

        return Redirect::route('clases.index')
            ->with('success', 'Clase deleted successfully');
    }
}
