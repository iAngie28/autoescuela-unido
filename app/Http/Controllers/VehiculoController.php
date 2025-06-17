<?php

namespace App\Http\Controllers;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::beginTransaction();
        
        try {
            $vehiculo = Vehiculo::create($request->validated());
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Creación de vehículo',
                'Placa: ' . $vehiculo->placa . ' | Modelo: ' . $vehiculo->modelo,
                $request->ip()
            );
            
            DB::commit();
            
            return Redirect::route('vehiculos.index')
                ->with('success', 'Vehículo creado correctamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear vehículo: ' . $e->getMessage());
            return back()->with('error', 'Error al crear vehículo: ' . $e->getMessage());
        }
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
        DB::beginTransaction();
        
        try {
            // Guardar datos originales para bitácora
            $originalData = $vehiculo->getOriginal();
            
            $vehiculo->update($request->validated());
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Actualización de vehículo',
                'ID: ' . $vehiculo->id . 
                ' | Cambios: ' . json_encode($request->validated()) .
                ' | Original: ' . json_encode($originalData),
                $request->ip()
            );
            
            DB::commit();
            
            return Redirect::route('vehiculos.index')
                ->with('success', 'Vehículo actualizado correctamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar vehículo: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $vehiculoData = $vehiculo->toArray(); // Guardar datos para bitácora
            
            $vehiculo->delete();
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Eliminación de vehículo',
                'ID: ' . $vehiculo->id . ' | Placa: ' . $vehiculo->placa . ' | Modelo: ' . $vehiculo->modelo,
                request()->ip()
            );
            
            DB::commit();
            
            return redirect()->route('vehiculos.index')
                ->with('success', 'Vehículo eliminado correctamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar vehículo: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }

    /**
     * Registra una acción en la bitácora con respaldo en archivo
     */
    private function registrarBitacora($accion, $detalle, $ip)
    {
        try {
            // Método 1: Query Builder (más confiable)
            DB::table('bitacoras')->insert([
                'id_user' => Auth::id(),
                'ip' => $ip,
                'accion' => $accion . ' - ' . $detalle,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            // Método 2: Guardado en archivo como respaldo
            $logData = [
                'timestamp' => now()->toDateTimeString(),
                'accion' => $accion,
                'detalle' => $detalle,
                'ip' => $ip,
                'error_db' => $e->getMessage()
            ];
            
            file_put_contents(
                storage_path('logs/bitacora_vehiculos.log'),
                json_encode($logData).PHP_EOL,
                FILE_APPEND
            );
        }
    }
}
