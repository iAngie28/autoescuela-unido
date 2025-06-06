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
    public function (Request $request): View {
    $clases = Clase::paginate();
    return view('clase.reprogramar', compact('clases'))
    ->with('i', ($request->input('page', 1) - 1) * $clases->perPage());
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
            ->with('success', 'Clase created successfully.');
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
