<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ExamenCategoriaAspiraController;
use App\Http\Controllers\ExamenSegipController;
use App\Http\Controllers\GrupoExamanController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\NotificacioneController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
//angie
Route::resource('rols', \App\Http\Controllers\RolController::class); // Sin middleware
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
Route::delete(
    'examen‑segips/{id_est}/{id_grupo}',
    [ExamenSegipController::class,'destroy']
  )->name('examen‑segips.destroy');
  
  Route::get    ('examen-segips',                    [ExamenSegipController::class,'index'])->name('examen-segips.index');
  Route::get    ('examen-segips/create',             [ExamenSegipController::class,'create'])->name('examen-segips.create');
  Route::post   ('examen-segips',                    [ExamenSegipController::class,'store'])->name('examen-segips.store');
  Route::get    ('examen-segips/{id_est}/{id_grupo}',[ExamenSegipController::class,'show'])->name('examen-segips.show');
  Route::get    ('examen-segips/{id_est}/{id_grupo}/edit',[ExamenSegipController::class,'edit'])->name('examen-segips.edit');
  Route::put    ('examen-segips/{id_est}/{id_grupo}',[ExamenSegipController::class,'update'])->name('examen-segips.update');
  Route::delete ('examen-segips/{id_est}/{id_grupo}',[ExamenSegipController::class,'destroy'])->name('examen-segips.destroy');
  