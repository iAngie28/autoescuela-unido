<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vehiculo')->insert([
            [
                'placa' => '123-ABC',
                'modelo' => 'Toyota Yaris',
                'caracteristicas' => 'Sedán, blanco, 4 puertas',
                'tipo' => 2, // auto
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'placa' => '456-DEF',
                'modelo' => 'Nissan Versa',
                'caracteristicas' => 'Sedán, gris, automático',
                'tipo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'placa' => '789-GHI',
                'modelo' => 'Honda Civic',
                'caracteristicas' => 'Hatchback, rojo',
                'tipo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'placa' => 'MOTO-001',
                'modelo' => 'Yamaha FZ',
                'caracteristicas' => '150cc, negro',
                'tipo' => 1, // moto
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'placa' => 'MOTO-002',
                'modelo' => 'Honda CB',
                'caracteristicas' => '125cc, azul',
                'tipo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
