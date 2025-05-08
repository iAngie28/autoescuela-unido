<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ExamenCategoriaAspiraController;
use App\Http\Controllers\ExamenSegipController;
use App\Http\Controllers\GrupoExamanController;
use App\Http\Controllers\InscribeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\NotificacioneController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\IsAdmin;

Route::get('/register', function () {
    return view('auth.register');
})->middleware(['auth', IsAdmin::class])->name('register');



Route::view('/', 'welcome');

Route::get('/about', function () {
    return view('paginas.about');
})->name('about');

Route::get('/cursos', function () {
    return view('paginas.cursos');
})->name('cursos');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// Rutas protegidas por autenticación


Route::middleware(['auth'])->group(function () {
    // Dashboard para diferentes roles

    Route::get('/admin/dashboard', [AdministradorController::class, 'index'])->name('admin.dashboard');

    Route::get('/estudiante/dashboard', [EstudianteController::class, 'index'])->name('estudiante.dashboard');

    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');

    // Ruta para listar usuarios
    Route::get('user', [UserController::class, 'index'])->name('user');




});



// Ruta para mostrar el calendario
Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

// Ruta para obtener eventos del calendario dinámicamente
Route::get('/calendar/events', function () {
    // Ejemplo de eventos estáticos
    $events = [
        ['title' => 'Clase de Manejo', 'start' => '2025-05-10', 'end' => '2025-05-10'],
        ['title' => 'Clase Teórica', 'start' => '2025-05-12', 'end' => '2025-05-12'],
    ];

    // Si tienes una tabla en la base de datos, puedes obtener los eventos dinámicamente:
    // $events = DB::table('clases')->select('titulo as title', 'fecha_inicio as start', 'fecha_fin as end')->get();

    return response()->json($events);
})->name('calendar.events');

// Recursos (CRUD) sin middleware adicional
Route::resource('rols', RolController::class);
Route::resource('notificaciones', NotificacioneController::class);
Route::resource('users', UserController::class);
Route::resource('administradors', AdministradorController::class);
Route::resource('estudiantes', EstudianteController::class);
Route::resource('instructors', InstructorController::class);
Route::resource('pagos', PagoController::class);
Route::resource('tipo-vehiculos', TipoVehiculoController::class);
Route::resource('vehiculos', VehiculoController::class);
Route::resource('examen-categoria-aspiras', ExamenCategoriaAspiraController::class);
Route::resource('paquetes', PaqueteController::class);
Route::resource('grupo-examen', GrupoExamanController::class);
Route::resource('examen-segips', ExamenSegipController::class);
Route::resource('inscribes', InscribeController::class);
Route::resource('clases', ClaseController::class);
