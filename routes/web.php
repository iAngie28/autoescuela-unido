<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controladores
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
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\AdminInstructorController;

// Middleware
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');
Route::view('/about', 'paginas.about')->name('about');
Route::view('/cursos', 'paginas.cursos')->name('cursos');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/register', function () {
    return view('auth.register');
})->middleware(['auth', IsAdmin::class])->name('register');

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard por roles
    Route::get('/admin/dashboard', [AdministradorController::class, 'index'])->name('admin.dashboard');
    Route::get('/estudiante/dashboard', [EstudianteController::class, 'index'])->name('estudiante.dashboard');
    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');

    // Gestión de usuarios
    Route::get('/user', [UserController::class, 'index'])->name('user');

    // Recursos administrativos
    Route::resource('rol', RolController::class);
    Route::resource('tipo-vehiculo', TipoVehiculoController::class);
    Route::resource('vehiculo', VehiculoController::class);
    Route::resource('admin-instructor', AdminInstructorController::class);

    /*
    |--------------------------------------------------------------------------
    | Rutas de Bitácora
    |--------------------------------------------------------------------------
    */
    Route::prefix('bitacora')->group(function () {
        Route::post('/iniciar/{accion}', [BitacoraController::class, 'iniciarAccion']);
        Route::post('/finalizar/{id}', [BitacoraController::class, 'finalizarAccion']);
        Route::get('/', [BitacoraController::class, 'index'])->name('bitacora.index');
    });

});

/*
|--------------------------------------------------------------------------
| Rutas de Inicio y Cierre de Sesión con Registro en Bitácora
|--------------------------------------------------------------------------
*/

Route::post('/login', function () {
    $user = Auth::user();

    \App\Models\Bitacora::create([
        'id_user' => $user->id,
        'direccion_ip' => request()->ip(),
        'visitas' => 'Login',
        'acciones' => 'Inicio de sesión'
    ]);

    return redirect()->route('dashboard');
})->name('login');

Route::post('/logout', function () {
    \App\Models\Bitacora::where('id_user', Auth::id())->latest()->first()->update([
        'acciones' => 'Cierre de sesión',
        'updated_at' => now(),
    ]);

    Auth::logout();
    return redirect('/');
})->name('logout');



/*
|--------------------------------------------------------------------------
| Rutas del Calendario
|--------------------------------------------------------------------------
*/

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('/calendar/events', function () {
    $events = [
        ['title' => 'Clase de Manejo', 'start' => '2025-05-10', 'end' => '2025-05-10'],
        ['title' => 'Clase Teórica', 'start' => '2025-05-12', 'end' => '2025-05-12'],
    ];

    return response()->json($events);
})->name('calendar.events');

/*
|--------------------------------------------------------------------------
| Recursos CRUD sin Middleware Adicional
|--------------------------------------------------------------------------
*/

Route::resources([
    'rols' => RolController::class,
    'notificaciones' => NotificacioneController::class,
    'users' => UserController::class,
    'administradors' => AdministradorController::class,
    'estudiantes' => EstudianteController::class,
    'instructors' => InstructorController::class,
    'pagos' => PagoController::class,
    'tipo-vehiculos' => TipoVehiculoController::class,
    'vehiculos' => VehiculoController::class,
    'examen-categoria-aspiras' => ExamenCategoriaAspiraController::class,
    'paquetes' => PaqueteController::class,
    'grupo-examen' => GrupoExamanController::class,
    'examen-segips' => ExamenSegipController::class,
    'inscribes' => InscribeController::class,
    'clases' => ClaseController::class,
]);
