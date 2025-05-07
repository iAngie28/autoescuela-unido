<?php

namespace App\Http\Controllers;

use App\Models\ExamenSegip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ExamenSegipRequest;
use App\Models\ExamenCategoriaAspira;
use App\Models\GrupoExaman;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\View\View;

class ExamenSegipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $examenSegips = ExamenSegip::paginate();
        return view('examen-segip.index', compact('examenSegips'))
            ->with('i', ($request->input('page', 1) - 1) * $examenSegips->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $examenSegip = new ExamenSegip();
        $usuariosEstudiantes = User::where('id_rol', 2)->get();
        $grupos = GrupoExaman::all();
        $categorias = ExamenCategoriaAspira::all();
        return view('examen-segip.create', compact('examenSegip'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamenSegipRequest $request): RedirectResponse
    {
        ExamenSegip::create($request->validated());

        return Redirect::route('examen-segips.index')
            ->with('success', 'ExamenSegip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $examenSegip = ExamenSegip::find($id);

        return view('examen-segip.show', compact('examenSegip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $examenSegip = ExamenSegip::find($id);
        $usuariosEstudiantes = User::where('id_rol', 2)->get();
        $grupos = GrupoExaman::all();
        $categorias = ExamenCategoriaAspira::all();
        return view('examen-segip.edit', compact('examenSegip', 'usuariosEstudiantes', 'grupos', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamenSegipRequest $request, ExamenSegip $examenSegip): RedirectResponse
    {
        $examenSegip->update($request->validated());

        return Redirect::route('examen-segips.index')
            ->with('success', 'ExamenSegip updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ExamenSegip::find($id)->delete();

        return Redirect::route('examen-segips.index')
            ->with('success', 'ExamenSegip deleted successfully');
    }
}
