<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EstudianteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboards.estudiante');
    }

    public function listForInstructor()
{
    // Filtra los usuarios que tienen el rol de 'Estudiante'
    $estudiantes = User::whereHas('rol', function ($query) {
        $query->where('nombre', 'Estudiante');
    })->paginate(10);

    return view('estudiante.inscritos', compact('estudiantes'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $estudiante = new Estudiante();

        return view('estudiante.create', compact('estudiante'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EstudianteRequest $request): RedirectResponse
    {
        Estudiante::create($request->validated());

        return Redirect::route('estudiantes.index')
            ->with('success', 'Estudiante created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $estudiante = Estudiante::find($id);

        return view('estudiante.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $estudiante = Estudiante::find($id);

        return view('estudiante.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EstudianteRequest $request, Estudiante $estudiante): RedirectResponse
    {
        $estudiante->update($request->validated());

        return Redirect::route('estudiantes.index')
            ->with('success', 'Estudiante updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Estudiante::find($id)->delete();

        return Redirect::route('estudiantes.index')
            ->with('success', 'Estudiante deleted successfully');
    }
}
