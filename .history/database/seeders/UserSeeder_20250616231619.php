<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $adminId = DB::table('users')->updateOrInsert(
            ['email' => 'adm@gmail.com'],
            [
                'name' => 'Administrador',
                'username' => 'admin1',
                'email_verified_at' => now(),
                'sexo' => 'masculino',
                'telefono' => 70000001,
                'direccion' => 'Zona Central',
                'fecha_registro' => now(),
                'ci' => 1000001,
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

        // Estudiante
        DB::table('users')->updateOrInsert(
            ['email' => 'est@gmail.com'],
            [
                'name' => 'Estudiante Demo',
                'username' => 'estudiante1',
                'email_verified_at' => now(),
                'sexo' => 'femenino',
                'telefono' => 70000002,
                'direccion' => 'Zona Sur',
                'fecha_registro' => now(),
                'ci' => 1000002,
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'E',
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $estudianteUser = DB::table('users')->where('email', 'est@gmail.com')->first();

        DB::table('estudiante')->updateOrInsert(
            ['id' => $estudianteUser->id],
            ['fecha_nacimiento' => now()->subYears(20)->toDateString(), 'created_at' => now(), 'updated_at' => now()]
        );

        // Instructor
        DB::table('users')->updateOrInsert(
            ['email' => 'inst@gmail.com'],
            [
                'name' => 'Instructor Demo',
                'username' => 'instructor1',
                'email_verified_at' => now(),
                'sexo' => 'otro',
                'telefono' => 70000003,
                'direccion' => 'Zona Norte',
                'fecha_registro' => now(),
                'ci' => 1000003,
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'I',
                'id_rol' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $instructorUser = DB::table('users')->where('email', 'inst@gmail.com')->first();

        DB::table('instructor')->updateOrInsert(
            ['id' => $instructorUser->id],
            ['categ_licencia' => 'A', 'id_vehiculo' => null, 'created_at' => now(), 'updated_at' => now()]
        );
    }
}
