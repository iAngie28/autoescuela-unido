<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <-- Agrega esto
use App\Models\Evaluacion;

class TomarExamenController extends Controller
{
    public function mostrarEvaluacion($userId)
    {
        $user = User::findOrFail($userId);
        $estudiantes = User::whereHas('rol', function ($query) {
            $query->where('nombre', 'Estudiante');
        })->get();

        return view('tomarExamen.index', compact('user', 'estudiantes')); // Asegúrate de incluir 'estudiantes'
    }

    public function guardarEvaluacion(Request $request, $userId)
    {
        $puntajes = ['Excelente' => 25, 'Bueno' => 15, 'Regular' => 10];

        $notaFinal = $puntajes[$request->input('estacionamiento')] +
            $puntajes[$request->input('zigzag')] +
            $puntajes[$request->input('retroceso')] +
            $puntajes[$request->input('conduccion_via')];

        Evaluacion::create([
            'estudiante_id' => $userId,
            'instructor_id' => auth()->user()->id,
            'estacionamiento' => $request->input('estacionamiento'),
            'zigzag' => $request->input('zigzag'),
            'retroceso' => $request->input('retroceso'),
            'conduccion_via' => $request->input('conduccion_via'),
            'nota_final' => $notaFinal,
            'fecha_evaluacion' => now(),
        ]);

        return redirect()->route('instructor.students')->with('success', 'Evaluación guardada correctamente.');
    }


    public function historial()
{
    // Trae todas las evaluaciones con estudiante e instructor
    $evaluaciones = \App\Models\Evaluacion::with(['estudiante', 'instructor'])->orderByDesc('fecha_evaluacion')->paginate(15);

    return view('tomarExamen.historial', compact('evaluaciones'));
}
}
