<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notificacione;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class NotificacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar al usuario admin por email
        $user = User::where('email', 'adm@gmail.com')->first();

        if ($user) {
            for ($i = 1; $i <= 5; $i++) {
                Notificacione::create([
                    'mensaje' => "Notificación de prueba N°{$i}",
                    'tipo' => 'Clase',
                    'fecha' => Carbon::now()->subDays(6 - $i),
                    'user_id' => $user->id,
                    'leido' => false,
                ]);
            }
        } else {
            $this->command->warn("⚠ No se encontró el usuario con email adm@gmail.com");
        }
    
    }
}