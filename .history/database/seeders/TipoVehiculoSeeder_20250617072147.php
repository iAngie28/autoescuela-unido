<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVehiculoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_vehiculo')->insert([
            [
                'nombre' => 'moto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'auto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
