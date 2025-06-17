<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClaseSeeder extends Seeder
{
    public function run(): void
    {
        $hoy = Carbon::today();

        for ($i = 0; $i < 7; $i++) {
            $fecha = $hoy->copy()->addDays($i);
            $horaInicio = Carbon::createFromTime(8, 0); // 08:00 AM
            $horaFin = $horaInicio->copy()->addHours(2); // 2 horas después

            DB::table('clase')->insert([
                'fecha' => $fecha->toDateString(),
                'hora_inicio' => $horaInicio->format('H:i:s'),
                'hora_fin' => $horaFin->format('H:i:s'),
                'estado' => 'programada',
                'comentario_Inst' => null,
                'reporte_estudiante' => null,
                'id_paquete' => null,
                'id_inst' => null,
                'id_est' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
