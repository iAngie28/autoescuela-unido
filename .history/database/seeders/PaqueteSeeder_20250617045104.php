<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaqueteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('paquete')->insert([
            [
                'cant_class' => 5,
                'capacidad_est' => 1,
                'costo' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cant_class' => 10,
                'capacidad_est' => 1,
                'costo' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cant_class' => 15,
                'capacidad_est' => 1,
                'costo' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
