<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClaseRequest;
use App\Models\Paquete;
use App\Models\User;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
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
            storage_path('logs/bitacora_clases.log'),
            json_encode($logData).PHP_EOL,
            FILE_APPEND
        );
    }
}

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

        if ($user->tipo_usuario !== 'I') {
            abort(403, 'Acceso no autorizado');
        }

        // Definir la variable $clases para el instructor
        $clases = Clase::where('id_inst', $user->id)
            ->whereIn('estado', ['programada', 'inscrita', 'completada'])
            ->paginate();

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
    /*
    public function store(ClaseRequest $request): RedirectResponse
    {
        Clase::create($request->validated());

        return Redirect::route('clases.index')
            ->with('success', 'Clase creada correctamente');
    }
            */


    //Modificando la funcion store (Jhenn)
public function store(ClaseRequest $request): RedirectResponse
{
    // Validar si ya existe una clase con misma fecha y hora
    $existeClase = Clase::where('fecha', $request->fecha)
                    ->where('hora_inicio', $request->hora_inicio)
                    ->exists();

    if ($existeClase) {
        // Volver con mensaje de conflicto y datos previos
            return back()->with('error', 'No se puede crear: el instructor o el estudiante ya tienen una clase en esa fecha.');
    }

    // Si no hay conflicto, s
    DB::beginTransaction();
    try {
        $clase = Clase::create($request->validated());
        
        $this->registrarBitacora(
            'Creación de clase',
            'ID: ' . $clase->id . ' | Fecha: ' . $clase->fecha . ' | Instructor: ' . $clase->id_inst,
            $request->ip()
        );
        
        DB::commit();
        
        return Redirect::route('clases.index')
            ->with('success', 'Clase creada correctamente');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al crear clase: ' . $e->getMessage());
    }
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
            $clase = Clase::findOrFail($id);
            $clase->update(['estado' => 'cancelada']);
    
            $this->registrarBitacora(
                'Cancelación de clase',
                'ID: ' . $id . ' | Estado: cancelada',
                request()->ip()
            );
    
            return back()->with('success', 'Clase cancelada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cancelar: ' . $e->getMessage());
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

            if ($clase->id_est != null){
                $clase->update([
                'fecha' => $request->nueva_fecha,
                'estado' => 'inscrita'
            ]);
            }else{
                // Si no hay conflicto, actualizar la clase
            $clase->update([
                'fecha' => $request->nueva_fecha,
                'estado' => 'programada'
            ]);
            }
            
            $this->registrarBitacora(
                'Reprogramación de clase',
                'ID: ' . $id . ' | Nueva fecha: ' . $request->nueva_fecha,
                request()->ip()
            );

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
                'estado' => 'inscrita',
                'id_pago' => $request->id_pago ?? null
            ]);

            $this->registrarBitacora(
                'Asignación de estudiante',
                'Clase ID: ' . $id . ' | Estudiante ID: ' . $request->nid_est,
                request()->ip()
            );    

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
        try {
            $clase->update($request->validated());
            
            $this->registrarBitacora(
                'Actualización de clase',
                'ID: ' . $clase->id . ' | Cambios: ' . json_encode($request->validated()),
                $request->ip()
            );

            
            return back()->with('success', 'Clase actualizada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $clase = Clase::find($id);
            $claseData = $clase->toArray(); // Guardar datos antes de eliminar
            
            $clase->delete();
    
            $this->registrarBitacora(
                'Eliminación de clase',
                'ID: ' . $id . ' | Datos: ' . json_encode($claseData),
                request()->ip()
            );
    
            return back()->with('success', 'Clase eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }

    public function editObservaciones($id): View
{
    $clase = Clase::findOrFail($id);
    $user = Auth::user();

    // Validar que el usuario es el instructor asignado
    if ($user->tipo_usuario !== 'I' || $clase->id_inst != $user->id) {
        abort(403, 'No tienes permiso para editar las observaciones de esta clase.');
    }

    return view('clase.edit_observaciones', compact('clase'));
}

/**
 * Actualiza las observaciones en la base de datos
 */
public function updateObservaciones(Request $request, $id): RedirectResponse
{
    $clase = Clase::findOrFail($id);
    $user = Auth::user();

    // Validar permisos
    if ($user->tipo_usuario !== 'I' || $clase->id_inst != $user->id) {
        abort(403, 'No tienes permiso para editar las observaciones de esta clase.');
    }

    // Validar longitud máxima según la estructura de BD
    $request->validate([
        'comentario_Inst' => 'nullable|string|max:250'
    ]);

    // Actualizar solo el campo de observaciones
    $clase->comentario_Inst = $request->comentario_Inst;
    $clase->save();

    // Registrar en bitácora
    $this->registrarBitacora(
        'Actualización de observaciones',
        'Clase ID: ' . $id . ' | Observación: ' . substr($request->comentario_Inst, 0, 50) . '...',
        $request->ip()
    );

    return redirect()->route('clases.clase_inst')
        ->with('success', 'Observaciones actualizadas correctamente');
}
}

