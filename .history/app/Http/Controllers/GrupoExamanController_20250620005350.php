<?php

namespace App\Http\Controllers;

use App\Models\GrupoExaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GrupoExamanRequest;
use App\Models\ExamenCategoriaAspira;
use App\Models\ExamenSegip;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class GrupoExamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = GrupoExaman::query();

        // Si se envió el filtro de estado, aplicarlo
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $grupoExamen = $query->paginate();

        return view('grupo-examan.index', compact('grupoExamen'))
            ->with('i', ($request->input('page', 1) - 1) * $grupoExamen->perPage());
    }

    private function separarNombreCompleto($nombreCompleto)
    {
        $partes = explode(' ', trim($nombreCompleto));
        $total = count($partes);

        if ($total === 0) {
            return ['nombres' => '', 'apellido_p' => '', 'apellido_m' => ''];
        }

        if ($total === 1) {
            return ['nombres' => $partes[0], 'apellido_p' => '', 'apellido_m' => ''];
        }

        if ($total === 2) {
            return ['nombres' => $partes[0], 'apellido_p' => $partes[1], 'apellido_m' => ''];
        }

        // Si hay más de 2 partes, los dos últimos son apellidos
        $apellido_m = array_pop($partes);
        $apellido_p = array_pop($partes);
        $nombres = implode(' ', $partes);

        return [
            'nombres' => $nombres,
            'apellido_p' => $apellido_p,
            'apellido_m' => $apellido_m
        ];
    }



    public function exportarExcel($id)
    {
        try {
            $modeloPath = storage_path('app/public/modelo_excel.xlsx');
            $spreadsheet = IOFactory::load($modeloPath);

            $hojaFormulario = $spreadsheet->getSheetByName('Formulario1');

            $estudiantes = ExamenSegip::with(['estudiante.usuario', 'examenCategoriaAspira'])
                ->where('id_grupo', $id)
                ->get();

            $filaInicio = 9;
            $cantidad = count($estudiantes);
            $hojaFormulario->insertNewRowBefore($filaInicio, $cantidad);

            // 🎨 Estilo básico: bordes + sin relleno
            $estiloComun = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_NONE,
                ],
            ];

            $fila = $filaInicio;
            foreach ($estudiantes as $i => $registro) {
                $usuario = $registro->estudiante->usuario;
                $categoria = $registro->examenCategoriaAspira->nombre ?? 'Sin categoría';

                $hojaFormulario->setCellValue("A{$fila}", $i + 1);
                $hojaFormulario->setCellValue("B{$fila}", $usuario->ci);
                $nombreSeparado = $this->separarNombreCompleto($usuario->name);
                $hojaFormulario->setCellValue("C{$fila}", $nombreSeparado['nombres']);
                $hojaFormulario->setCellValue("D{$fila}", $nombreSeparado['apellido_p']);
                $hojaFormulario->setCellValue("E{$fila}", $nombreSeparado['apellido_m']);
                $hojaFormulario->setCellValue("F{$fila}", $registro->estudiante->fecha_nacimiento);
                $hojaFormulario->setCellValue("G{$fila}", $categoria);

                // Estilo para A-J
                $hojaFormulario->getStyle("A{$fila}:J{$fila}")->applyFromArray($estiloComun);
                $fila++;
            }

            $categorias = $estudiantes->groupBy('id_categoria');

            foreach ($categorias as $id_categoria => $grupoCat) {
                $nombreCategoria = $grupoCat->first()->examenCategoriaAspira->nombre ?? 'SinNombre';
                $nombreHoja = 'CAT-' . $nombreCategoria;

                if (!str_starts_with($nombreHoja, 'CAT-')) continue;

                $hojaCategoria = $spreadsheet->getSheetByName($nombreHoja);
                if (!$hojaCategoria) continue;

                $cantidadCat = count($grupoCat);
                $hojaCategoria->insertNewRowBefore($filaInicio, $cantidadCat);

                $filaCat = $filaInicio;
                foreach ($grupoCat as $j => $registro) {
                    $usuario = $registro->estudiante->usuario;
                    $hojaCategoria->setCellValue("A{$filaCat}", $j + 1);
                    $hojaCategoria->setCellValue("B{$filaCat}", $usuario->ci);
                    $nombreSeparado = $this->separarNombreCompleto($usuario->name);
                    $hojaCategoria->setCellValue("C{$filaCat}", $nombreSeparado['nombres']);
                    $hojaCategoria->setCellValue("D{$filaCat}", $nombreSeparado['apellido_p']);
                    $hojaCategoria->setCellValue("E{$filaCat}", $nombreSeparado['apellido_m']);

                    $hojaCategoria->setCellValue("F{$filaCat}", $registro->estudiante->fecha_nacimiento);
                    $hojaCategoria->setCellValue("G{$filaCat}", $nombreCategoria);

                    // Estilo para A-L
                    $hojaCategoria->getStyle("A{$filaCat}:L{$filaCat}")->applyFromArray($estiloComun);
                    $filaCat++;
                }
            }

            $filename = "{$id}-Lista de alumnos.xlsx";
            $writer = new Xlsx($spreadsheet);

            return response()->streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, $filename);
        } catch (\Throwable $e) {
            return response("⚠️ Error al generar el Excel: " . $e->getMessage(), 500);
        }
    }



    public function asignarEstudiante(Request $request): View
    {
        $grupoExamen = GrupoExaman::paginate(10);
        $grupoExamenActivos = GrupoExaman::where('estado', 'activo')->get();
        $estudiantes = User::where('id_rol', 2)
            ->with(['estudiante']) // importante para usar name y relaciones
            ->paginate(10);

        $categorias = ExamenCategoriaAspira::all();

        // Obtener los intentos previos de cada estudiante (clave: estudiante_id => última_inscripción)
        $inscripciones = ExamenSegip::latest('created_at')
            ->get()
            ->groupBy('id_est')
            ->map(fn($items) => $items->first());

        return view('grupo-examan.asignar-estudiante', compact(
            'grupoExamen',
            'grupoExamenActivos',
            'estudiantes',
            'categorias',
            'inscripciones'
        ))->with('i', ($request->input('page', 1) - 1) * $estudiantes->perPage());
    }

    public function inscribir_grupo(Request $request)
    {
        // Validación de campos
        $request->validate([
            'estudiante_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupo_examen,id',
            'categoria_id' => 'required|exists:examen_categoria_aspira,id',
        ]);

        $idEst = $request->estudiante_id;
        $idGrupo = $request->grupo_id;
        $idCategoria = $request->categoria_id;

        // ❌ Verifica si ya está inscrito en ese grupo (sin importar la categoría)
        $existe = ExamenSegip::where('id_est', $idEst)
            ->where('id_grupo', $idGrupo)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Este estudiante ya está inscrito en ese grupo.');
        }

        // ✅ Calcular el número de intento en esa categoría
        $intentosPrevios = ExamenSegip::where('id_est', $idEst)
            ->where('id_categoria', $idCategoria)
            ->count();

        $nuevoIntento = $intentosPrevios + 1;

        // Crear el registro
        ExamenSegip::create([
            'id_est' => $idEst,
            'id_grupo' => $idGrupo,
            'id_categoria' => $idCategoria,
            'nro_intento' => $nuevoIntento,
            'nota_Teorica' => null,
            'nota_Practica' => null,
            'estado' => 'pendiente',
            'id_pago' => $request->id_pago,
        ]);

        return back()->with('success', 'Estudiante inscrito correctamente (Intento #' . $nuevoIntento . ')');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $grupoExaman = new GrupoExaman();

        return view('grupo-examan.create', compact('grupoExaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GrupoExamanRequest $request): RedirectResponse
    {
        GrupoExaman::create($request->validated());

        return Redirect::route('grupo-examen.index')
            ->with('success', 'GrupoExaman created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $grupoExaman = GrupoExaman::find($id);

        return view('grupo-examan.show', compact('grupoExaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $grupoExaman = GrupoExaman::find($id);

        return view('grupo-examan.edit', compact('grupoExaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GrupoExamanRequest $request, GrupoExaman $grupoExaman): RedirectResponse
    {
        $grupoExaman->update($request->validated());

        return Redirect::route('grupo-examen.index')
            ->with('success', 'GrupoExaman updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        GrupoExaman::find($id)->delete();

        return Redirect::route('grupo-examen.index')
            ->with('success', 'GrupoExaman deleted successfully');
    }
}
