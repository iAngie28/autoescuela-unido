<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rols')->insert([
            [
                'id' => 1,
                'nombre' => 'administrador',
                'permisos' => 'todos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nombre' => 'estudiante',
                'permisos' => 'limitado',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nombre' => 'instructor',
                'permisos' => 'intermedio',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
