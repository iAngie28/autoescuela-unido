<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PagoRequest;
use App\Models\Estudiante;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Paquete;
use App\Models\ExamenCategoriaAspira;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pagos = Pago::paginate();
        $pago = new Pago();
        $usuariosEstudiantes = User::where('id_rol', 2)->get();
        $usuariosAdministrador = User::where('id_rol', 1)->get();

        // NUEVO: Obtener los paquetes y categorías para el formulario
        $paquetes = Paquete::all();
        $categorias = ExamenCategoriaAspira::all();

        return view('pago.index', compact(
            'pago',
            'pagos',
            'usuariosEstudiantes',
            'usuariosAdministrador',
            'paquetes',
            'categorias'
        ))->with('i', ($request->input('page', 1) - 1) * $pagos->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pago = new Pago();
        $usuariosEstudiantes = User::where('id_rol', 2)->get();
        $usuariosAdministrador = User::where('id_rol', 1)->get(); // Usuarios con rol de administrador
        return view('pago.create', compact('pago', 'usuariosEstudiantes', 'usuariosAdministrador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['id_adm'] = Auth::id();
        $validated['fecha'] = now();  
        dd($validated);

        Pago::create($validated);

        return Redirect::route('pagos.index')
            ->with('success', 'Pago creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $pago = Pago::find($id);

        return view('pago.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $pago = Pago::findOrFail($id); // Falla con 404 si no existe
        $usuariosEstudiantes = User::where('id_rol', 2)->get();
        $usuariosAdministrador = User::where('id_rol', 1)->get();
        return view('pago.edit', compact('pago', 'usuariosEstudiantes', 'usuariosAdministrador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagoRequest $request, Pago $pago): RedirectResponse
    {
        $pago->update($request->validated());

        return Redirect::route('pagos.index')
            ->with('success', 'Pago updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Pago::find($id)->delete();

        return Redirect::route('pagos.index')
            ->with('success', 'Pago deleted successfully');
    }
}
