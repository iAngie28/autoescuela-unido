<?php
namespace App\Http\Controllers;

use App\Models\ReporteFalla;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteFallaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reportes = ReporteFalla::query();

        // Filtro por tipo de usuario
        if ($user->id_rol == 3) { // Instructor
            $reportes = $reportes->where('instructor_id', $user->id);
        }

        $reportes = $reportes->with(['vehiculo', 'instructor'])->paginate(10);

        return view('reporte_fallas.index', compact('reportes'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        return view('reporte_fallas.create', compact('vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculo,id',
            'descripcion' => 'required|string|min:10'
        ]);

        ReporteFalla::create([
            'vehiculo_id' => $request->vehiculo_id,
            'instructor_id' => Auth::id(),
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('reporte-fallas.index')
            ->with('success', 'Reporte creado correctamente');
    }

    public function show(ReporteFalla $reporteFalla)
    {
        return view('reporte_fallas.show', compact('reporteFalla'));
    }

    // Solo para admin (id_rol = 1)
    public function updateEstado(Request $request, ReporteFalla $reporteFalla)
    {
        abort_if(Auth::user()->id_rol != 1, 403);

        $request->validate(['estado' => 'required|in:pendiente,revisado,solucionado']);
        $reporteFalla->update(['estado' => $request->estado]);
        
        return back()->with('success', 'Estado actualizado');
    }
    // En ReporteFallaController.php
public function destroy(ReporteFalla $reporteFalla)
{
    // Verificar permisos (solo admin puede eliminar)
    if (Auth::user()->id_rol != 1) {
        abort(403, 'No tienes permiso para eliminar reportes');
    }

    $reporteFalla->delete();

    return redirect()->route('reporte-fallas.index')
           ->with('success', 'Reporte eliminado correctamente');
}
}