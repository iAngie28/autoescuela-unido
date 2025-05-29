<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Instructor;

class AdminInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): View
{
    $search = $request->input('search');

    $instructors = Instructor::query()
        ->when($search, function ($query, $search) {
            return $query->where('categ_licencia', 'like', "%$search%");
        })
        ->paginate(20);

    return view('instructores.index', compact('instructors'))
        ->with('i', ($request->input('page', 1) - 1) * $instructors->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $vehiculos = Vehiculo::all(); // Obtener todos los vehículos disponibles
    return view('instructores.create', compact('vehiculos'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'categ_licencia' => 'required|string|max:255',
        'id_vehiculo' => 'nullable|integer|exists:vehiculo,id' // Debe ser un vehículo existente
    ]);

    Instructor::create([
        'categ_licencia' => $request->categ_licencia,
        'id_vehiculo' => $request->id_vehiculo ?? null, // Manejar si es opcional
    ]);

    return Redirect::route('instructores.index')
        ->with('success', 'Instructor creado correctamente.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Instructor $instructor): View
{
    $vehiculos = Vehiculo::all();
    return view('instructores.edit', compact('instructor', 'vehiculos'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Instructor $instructor): RedirectResponse
{
    $request->validate([
        'categ_licencia' => 'required|string|max:255',
        'id_vehiculo' => 'nullable|integer|exists:vehiculo,id'
    ]);

    $instructor->update([
        'categ_licencia' => $request->categ_licencia,
        'id_vehiculo' => $request->id_vehiculo ?? null,
    ]);

    return Redirect::route('instructores.index')
        ->with('success', 'Instructor actualizado correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Instructor $instructor): RedirectResponse
{
    $instructor->delete();

    return Redirect::route('instructores.index')
        ->with('success', 'Instructor eliminado correctamente.');
}
}
