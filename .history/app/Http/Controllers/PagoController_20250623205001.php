<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PagoRequest;
use App\Models\Clase;
use App\Models\Estudiante;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Paquete;
use App\Models\ExamenCategoriaAspira;
use App\Models\ExamenSegip;
use App\Models\GrupoExaman;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pagos = Pago::latest()->paginate();
        $pago = new Pago();
        $usuariosEstudiantes = User::where('id_rol', 2)->get();

        // NUEVO: Obtener los paquetes y categorías para el formulario
        $paquetes = Paquete::all();
        $categorias = ExamenCategoriaAspira::all();

        return view('pago.index', compact(
            'pago',
            'pagos',
            'usuariosEstudiantes',
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

        // Lógica de glosa y estado según tipo de pago
        if ($validated['tipo_pago'] === 'grupo') {
            $categoria = ExamenCategoriaAspira::findOrFail($validated['categoria_id']);
            $glosa = "Examen para la categoría {$categoria->nombre}";
            $validated['estado'] = 'PIG';
        } elseif ($validated['tipo_pago'] === 'paquete') {
            $paquete = Paquete::findOrFail($validated['paquete_id']);
            $glosa = "{$paquete->cant_class} clases";
            $validated['estado'] = 'PIP';
        }

        // Obtener nombre del estudiante
        $estudiante = Estudiante::findOrFail($validated['id_est']);

        $detalle = "Pago de $glosa realizado por {$estudiante->usuario->name}";
        if (!empty($validated['descuento']) && $validated['descuento'] > 0) {
            $detalle .= " [Con un descuento de {$validated['descuento']} Bs]";
        }

        $validated['detalle'] = $detalle;
        // Crear pago
        Pago::create($validated);
        
        return Redirect::route('pagos.index')
            ->with('success', 'Pago creado exitosamente.');
    }


    public function inscribir(Pago $pago)
    {
        if ($pago->estado === 'PIP') {
            $clases = Clase::where('estado', 'programada')->get();

            // Extraer cantidad de clases desde el texto del detalle
            preg_match('/Pago de (\d+) clases/i', $pago->detalle, $match);
            $maxClases = isset($match[1]) ? (int)$match[1] : 1;

            return view('pago.inscribir', compact('pago', 'clases', 'maxClases'));
        }

        if ($pago->estado === 'PIG') {
            $idEstudiante = $pago->id_est;

            // Obtener IDs de los grupos a los que el estudiante YA está inscrito
            $gruposInscritosIds = \App\Models\ExamenSegip::where('id_est', $idEstudiante)
                ->pluck('id_grupo')
                ->toArray();

            // Obtener solo grupos activos a los que NO está inscrito
            $grupos = GrupoExaman::where('estado', 'activo')
                ->whereNotIn('id', $gruposInscritosIds)
                ->get();

            return view('pago.inscribir', compact('pago', 'grupos'));
        }


        abort(404, 'Pago inválido para inscripción');
    }


    public function procesarInscripcion(Request $request, Pago $pago)
    {
        if ($pago->estado === 'PIG') {
            return $this->procesarInscripcionGrupo($request, $pago);
        }

        if ($pago->estado === 'PIP') {
            return $this->procesarInscripcionClases($request, $pago);
        }

        return back()->with('error', 'Este pago no corresponde a un tipo válido de inscripción.');
    }

    public function procesarInscripcionClases(Request $request, Pago $pago)
    {
        $claseIds = $request->input('clases', []);

        if (empty($claseIds)) {
            return back()->with('error', 'Debe seleccionar al menos una clase.');
        }

        foreach ($claseIds as $claseId) {
            $requestAsignacion = new Request([
                'nid_est' => $pago->id_est,
                'id_pago' => $pago->id
            ]);

            try {
                app()->call([app(ClaseController::class), 'asignar_clase'], [
                    'request' => $requestAsignacion,
                    'id' => $claseId
                ]);
            } catch (\Exception $e) {
                return back()->with('error', 'Error al asignar clase ID ' . $claseId . ': ' . $e->getMessage());
            }
        }

        return redirect()->route('pagos.index')->with('success', 'Clases asignadas correctamente.');
    }


    protected function procesarInscripcionGrupo(Request $request, Pago $pago)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupo_examen,id',
        ]);

        $estudiante_id = $pago->id_est;

        preg_match('/Examen para la categoría (.*?) realizado por/', $pago->detalle, $matches);
        if (!isset($matches[1])) {
            return back()->with('error', 'No se pudo determinar la categoría desde el detalle del pago.');
        }

        $categoria_nombre = trim($matches[1]);

        $categoria = ExamenCategoriaAspira::where('nombre', $categoria_nombre)->first();
        if (!$categoria) {
            return back()->with('error', 'Categoría "' . $categoria_nombre . '" no encontrada.');
        }

        $fakeRequest = new Request([
            'estudiante_id' => $estudiante_id,
            'grupo_id' => $request->grupo_id,
            'categoria_id' => $categoria->id,
            'id_pago' => $pago->id,
            'from_controller' => true,
        ]);

        $grupoController = new \App\Http\Controllers\GrupoExamanController;
        $resultado = $grupoController->inscribir_grupo($fakeRequest);

        if (is_array($resultado) && ($resultado['success'] ?? false)) {
            $pago->estado = 'Finalizado';
            $pago->save();

            return redirect()->route('pagos.index')->with('success', $resultado['mensaje']);
        }

        return back()->with('error', 'No se pudo completar la inscripción.');
    }

    public function anular(Pago $pago)
    {
        $detalle = strtolower($pago->detalle);
        $estado = $pago->estado;

        if (str_contains($detalle, 'clases')) {
            // Paquete o PIP → limpiar clases asociadas
            $clases = Clase::where('id_pago', $pago->id)->get();

            foreach ($clases as $clase) {
                $clase->estado = 'programada';
                $clase->id_est = null;
                $clase->id_pago = null;
                $clase->save();
            }
        } elseif ($estado === 'Finalizado' && str_contains($detalle, 'examen')) {
            // Examen de grupo → eliminar entrada en examen_segip
            ExamenSegip::where('id_pago', $pago->id)->delete();
        }

        // Marcar como anulado en cualquier caso
        $pago->estado = 'anulado';
        $pago->detalle = 'PAGO ANULADO DE ' . $pago->monto . ' Bs: (' . $pago->detalle . ')';
        $pago->monto = 0;
        $pago->save();

        return redirect()->back()->with('success', 'Pago anulado correctamente.');
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

    public function pago_est(Request $request): View
    {
        $user = auth()->user();

        // Validar que el usuario sea tipo estudiante
        if ($user->tipo_usuario !== 'E') {
            abort(403, 'Acceso no autorizado');
        }

        // Obtener solo clases programadas del estudiante actual
        $pagos = Pago::where('id_est', $user->id)
            ->latest()
            ->paginate(10);

        return view('pagos.pagos_est', compact('pagos'));
    }
}
