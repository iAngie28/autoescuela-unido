<?php

namespace App\Http\Controllers;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): View
{
    $search = $request->input('search');

    // Filtrar vehículos si hay búsqueda
    $vehiculos = Vehiculo::query()
        ->when($search, function ($query, $search) {
            return $query->where('placa', 'like', "%$search%")
                         ->orWhere('modelo', 'like', "%$search%");
        })
        ->paginate(20);

    return view('vehiculo.index', compact('vehiculos'))
        ->with('i', ($request->input('page', 1) - 1) * $vehiculos->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $vehiculo = new Vehiculo();
        $tipos = TipoVehiculo::all();
        return view('vehiculo.create', compact('vehiculo', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculoRequest $request): RedirectResponse
    {
        Vehiculo::create($request->validated());

        return Redirect::route('vehiculos.index')
            ->with('success', 'Vehiculo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $vehiculo = Vehiculo::find($id);

        return view('vehiculo.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $vehiculo = Vehiculo::find($id);
        $tipos = TipoVehiculo::all();
        return view('vehiculo.edit', compact('vehiculo', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculoRequest $request, Vehiculo $vehiculo): RedirectResponse
    {
        $vehiculo->update($request->validated());

        return Redirect::route('vehiculos.index')
            ->with('success', 'Vehiculo updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $vehiculo = Vehiculo::findOrFail($id);
    $vehiculo->delete();
    return redirect()->route('vehiculos.index');
    }
}
