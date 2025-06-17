<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamenCategoriaAspiraSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'P',  'costo' => 150],
            ['nombre' => 'A',  'costo' => 180],
            ['nombre' => 'B',  'costo' => 200],
            ['nombre' => 'C',  'costo' => 220],
            ['nombre' => 'T',  'costo' => 250],
            ['nombre' => 'M',  'costo' => 130],
            ['nombre' => 'JM', 'costo' => 160],
            ['nombre' => 'JP', 'costo' => 170],
        ];

        foreach ($categorias as $cat) {
            DB::table('examen_categoria_aspira')->updateOrInsert(
                ['nombre' => $cat['nombre']],
                [
                    'costo' => $cat['costo'],
                    'nota_min_pract' => 51,
                    'nota_min_teorica' => 51,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
