<?php

namespace App\Http\Controllers;

use App\Models\TipoVehiculo;
use App\Models\Bitacora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoVehiculoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): View
{
    $search = $request->input('search');

    // Filtrar tipos de vehículo si hay búsqueda
    $tipoVehiculos = TipoVehiculo::query()
        ->when($search, function ($query, $search) {
            return $query->where('nombre', 'like', "%$search%");
        })
        ->paginate(20);

    return view('tipo-vehiculo.index', compact('tipoVehiculos'))
        ->with('i', ($request->input('page', 1) - 1) * $tipoVehiculos->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tipoVehiculo = new TipoVehiculo();

        return view('tipo-vehiculo.create', compact('tipoVehiculo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoVehiculoRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $tipoVehiculo = TipoVehiculo::create($request->validated());
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Creación de tipo de vehículo',
                'ID: ' . $tipoVehiculo->id . ' | Nombre: ' . $tipoVehiculo->nombre,
                $request->ip()
            );
            
            DB::commit();
            
            return Redirect::route('tipo-vehiculos.index')
                ->with('success', 'Tipo de vehículo creado correctamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear tipo de vehículo: ' . $e->getMessage());
            return back()->with('error', 'Error al crear tipo de vehículo: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tipoVehiculo = TipoVehiculo::find($id);

        return view('tipo-vehiculo.show', compact('tipoVehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tipoVehiculo = TipoVehiculo::find($id);

        return view('tipo-vehiculo.edit', compact('tipoVehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoVehiculoRequest $request, TipoVehiculo $tipoVehiculo): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            // Guardar datos originales para bitácora
            $originalNombre = $tipoVehiculo->nombre;
            
            $tipoVehiculo->update($request->validated());
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Actualización de tipo de vehículo',
                'ID: ' . $tipoVehiculo->id . 
                ' | Nombre original: ' . $originalNombre . 
                ' | Nuevo nombre: ' . $tipoVehiculo->nombre,
                $request->ip()
            );
            
            DB::commit();
            
            return Redirect::route('tipo-vehiculos.index')
                ->with('success', 'Tipo de vehículo actualizado correctamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar tipo de vehículo: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $tipoVehiculo = TipoVehiculo::findOrFail($id);
            $tipoData = $tipoVehiculo->toArray();
            
            $tipoVehiculo->delete();
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Eliminación de tipo de vehículo',
                'ID: ' . $tipoVehiculo->id . ' | Nombre: ' . $tipoVehiculo->nombre,
                request()->ip()
            );
            
            DB::commit();
            
            return Redirect::route('tipo-vehiculos.index')
                ->with('success', 'Tipo de vehículo eliminado correctamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar tipo de vehículo: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }

    /**
     * Registra una acción en la bitácora usando el modelo
     */
    private function registrarBitacora($accion, $detalle, $ip)
    {
        try {
            Bitacora::create([
                'id_user' => Auth::id(),
                'ip' => $ip,
                'accion' => $accion . ' - ' . $detalle,
            ]);
        } catch (\Exception $e) {
            // Respaldo en archivo si falla el modelo
            $logData = [
                'timestamp' => now()->toDateTimeString(),
                'accion' => $accion,
                'detalle' => $detalle,
                'ip' => $ip,
                'error_db' => $e->getMessage()
            ];
            
            file_put_contents(
                storage_path('logs/bitacora_tipos_vehiculo.log'),
                json_encode($logData).PHP_EOL,
                FILE_APPEND
            );
        }
    }
}
