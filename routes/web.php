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
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Auth;


Route::view('/', 'welcome');

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

// Ruta para registro de usuarios (accesible para todos, incluso no autenticados)

});
Route::get('/register', function () {
    return view('livewire.pages.auth.register'); // Vista de registro
})->name('register');
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
