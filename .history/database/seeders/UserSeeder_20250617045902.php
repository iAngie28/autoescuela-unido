<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador
        DB::table('users')->updateOrInsert(
            ['email' => 'adm@gmail.com'],
            [
                'name' => 'Lucía Méndez',
                'username' => 'lucia.admin',
                'email_verified_at' => now(),
                'sexo' => 'femenino',
                'telefono' => 75000001,
                'direccion' => 'Av. Beni, Zona Norte',
                'fecha_registro' => now(),
                'ci' => 9000001,
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'A',
                'id_rol' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $adminUser = DB::table('users')->where('email', 'adm@gmail.com')->first();

        DB::table('administrador')->updateOrInsert(
            ['id' => $adminUser->id],
            ['turno' => 'mañana', 'created_at' => now(), 'updated_at' => now()]
        );

        // Estudiantes
        $estudiantes = [
            ['ci' => 9000002, 'name' => 'Sofía Rojas',     'email' => 'sofia.est@gmail.com'],
            ['ci' => 9000003, 'name' => 'Carlos Pérez',    'email' => 'carlos.est@gmail.com'],
            ['ci' => 9000004, 'name' => 'María López',     'email' => 'maria.est@gmail.com'],
            ['ci' => 9000005, 'name' => 'Diego Fernández', 'email' => 'diego.est@gmail.com'],
            ['ci' => 9000006, 'name' => 'Elena Vargas',    'email' => 'elena.est@gmail.com'],
            ['ci' => 9000007, 'name' => 'Juan Castillo',   'email' => 'juan.est@gmail.com'],
        ];

        foreach ($estudiantes as $i => $est) {
            DB::table('users')->updateOrInsert(
                ['email' => $est['email']],
                [
                    'name' => $est['name'],
                    'username' => 'estu' . ($i + 1),
                    'email_verified_at' => now(),
                    'sexo' => $i % 2 === 0 ? 'femenino' : 'masculino',
                    'telefono' => 75000010 + $i,
                    'direccion' => 'Barrio Universitario',
                    'fecha_registro' => now(),
                    'ci' => $est['ci'],
                    'password' => Hash::make('12345678'),
                    'tipo_usuario' => 'E',
                    'id_rol' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            $user = DB::table('users')->where('email', $est['email'])->first();

            DB::table('estudiante')->updateOrInsert(
                ['id' => $user->id],
                ['fecha_nacimiento' => now()->subYears(18 + $i)->toDateString(), 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // Instructores
        $instructores = [
            ['ci' => 9000010, 'name' => 'Gabriel Suárez', 'email' => 'gabriel.inst@gmail.com'],
            ['ci' => 9000011, 'name' => 'Paola Aguilar',  'email' => 'paola.inst@gmail.com'],
            ['ci' => 9000012, 'name' => 'Luis Moreno',    'email' => 'luis.inst@gmail.com'],
        ];

        foreach ($instructores as $i => $inst) {
            DB::table('users')->updateOrInsert(
                ['email' => $inst['email']],
                [
                    'name' => $inst['name'],
                    'username' => 'inst' . ($i + 1),
                    'email_verified_at' => now(),
                    'sexo' => $i % 2 === 0 ? 'masculino' : 'femenino',
                    'telefono' => 75000020 + $i,
                    'direccion' => 'Zona Este',
                    'fecha_registro' => now(),
                    'ci' => $inst['ci'],
                    'password' => Hash::make('12345678'),
                    'tipo_usuario' => 'I',
                    'id_rol' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            $user = DB::table('users')->where('email', $inst['email'])->first();

            DB::table('instructor')->updateOrInsert(
                ['id' => $user->id],
                ['categ_licencia' => 'A', 'id_vehiculo' => null, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
