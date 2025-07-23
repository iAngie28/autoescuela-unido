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
use App\Http\Controllers\TomarExamenController;
//Bitacora
use App\Models\Bitacora;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminInstructorController;

// Middleware
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\RegistrarBitacora;
use App\Models\Vehiculo;

use App\Http\Livewire\Pages\Auth\Register;

// PAGOS CON QR
use App\Http\Controllers\MockQrPaymentController;
use App\Http\Controllers\QrTransactionController;
use App\Http\Controllers\QrDisplayController; // Asegúrate de importar este controlador

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');
Route::view('/about', 'paginas.about')->name('about');
Route::view('/cursos', 'paginas.cursos')->name('cursos');

// Esta es la ruta para la página de Cursos con funcionalidad de PAGO QR.

Route::get('/cursos-de-pago', function () {
    return view('pagoQr.pagoqr');
})->name('coursesPay.index');

// Rutas de la API Mock para pagos QR (Estas ya están bien en la sección pública)
Route::prefix('mock')->group(function () {
    Route::post('/qr-payments', [MockQrPaymentController::class, 'createQrPayment']);
    Route::get('/qr-payments/{id}', [MockQrPaymentController::class, 'getQrPaymentStatus']);
    Route::post('/qr-payments/{id}/simulate-success', [MockQrPaymentController::class, 'simulateSuccess']);
    Route::post('/qr-payments/{id}/simulate-failure', [MockQrPaymentController::class, 'simulateFailure']);
});

// Ruta para mostrar la página del QR en la nueva pestaña
Route::get('/qr-payment-display/{id}', [QrDisplayController::class, 'show'])->name('qr.display');

Route::get('/estudiante/mis-pagos', [QrTransactionController::class, 'misPagos'])->name('estudiante.mis-pagos');


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
/* Clases*/
Route::get('/clase-reprogramar', [ClaseController::class, 'reprogramar'])
    ->middleware('auth')
    ->name('clase.reprogramar');

Route::get('/asignar_clase', [ClaseController::class, 'asingar_estudiante_clase'])
    ->middleware('auth')
    ->name('clase.asignar_clase');

Route::get('/asignar_vehiculo', [InstructorController::class, 'asingar_vehiculo_instructor'])
    ->middleware('auth')
    ->name('instructores.asignar_vehiculo');

Route::put('/instructor/{id}/asignar_vehiculo', [InstructorController::class, 'asignar_vehiculo'])
    ->name('instructor.asignar_vehiculo')
    ->middleware('auth');

Route::put('/clases/{id}/cancelar', [ClaseController::class, 'cancelarClase'])
    ->name('clases.cancelar')
    ->middleware('auth');

Route::put('/clases/{id}/reprogramar', [ClaseController::class, 'reprogramarClase'])
    ->name('clases.reprogramar')
    ->middleware('auth');

Route::put('/clases/{id}/asignar_clase', [ClaseController::class, 'asignar_clase'])
    ->name('clases.asignar_clase')
    ->middleware('auth');

Route::delete('clases/{clase}', [ClaseController::class, 'destroy'])->name('clases.destroy');

Route::get('/clases/estudiante', [ClaseController::class, 'clase_est'])
    ->middleware('auth')
    ->name('clases.clase_est'); // Nombre corregido

Route::get('/clases/instructor', [ClaseController::class, 'clase_inst'])
    ->middleware('auth')
    ->name('clases.clase_inst');

/* Observaciones Instructores */
Route::get('clases/{id}/edit-observaciones', [ClaseController::class, 'editObservaciones'])
     ->name('clases.edit_observaciones');
     
Route::put('clases/{id}/update-observaciones', [ClaseController::class, 'updateObservaciones'])
     ->name('clases.update_observaciones');

/* Reportes de Incidentes por Estudiantes */
Route::get('clases/{id}/edit-reporte-estudiante', [ClaseController::class, 'editReporteEstudiante'])
    ->middleware('auth')
    ->name('clases.edit_reporte_estudiante');
    
Route::put('clases/{id}/update-reporte-estudiante', [ClaseController::class, 'updateReporteEstudiante'])
    ->middleware('auth')
    ->name('clases.update_reporte_estudiante');

/* Clases*/
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/register', function () {
    return view('auth.register');
})->middleware(['auth', IsAdmin::class])->name('register');

/* Inscribir*/
Route::get('/grupo-examen/asignar-estudiante', [GrupoExamanController::class, 'asignarEstudiante'])
    ->middleware(['auth', IsAdmin::class])
    ->name('grupo-examen.asignar-estudiante');

    
require __DIR__.'/auth.php';

Route::post('/inscribir-grupo', [GrupoExamanController::class, 'inscribir_grupo'])->name('inscribir_grupo');
Route::post('/grupo-examen/{id}/exportar-excel', [GrupoExamanController::class, 'exportarExcel'])
    ->name('grupo-examen.exportar-excel');


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


    // CASO DE ESTUDIO EVALUAR
    Route::get('/instructor/students', [EstudianteController::class, 'listForInstructor'])->name('instructor.students');
    Route::get('/examen/{user}/evaluar', [TomarExamenController::class, 'mostrarEvaluacion'])->name('examen.evaluar');
    Route::post('/examen/{user}/guardar', [TomarExamenController::class, 'guardarEvaluacion'])->name('examen.guardar');
    Route::get('/examen/{user}/tomar', [TomarExamenController::class, 'mostrarEvaluacion'])->name('examen.tomar');
    Route::get('/instructor/historial-evaluaciones', [TomarExamenController::class, 'historial'])->name('instructor.historial');

    // Recursos administrativos
    Route::resource('rol', RolController::class);
    Route::resource('tipo-vehiculo', TipoVehiculoController::class);
    Route::resource('vehiculo', VehiculoController::class);
    Route::resource('admin-instructor', AdminInstructorController::class);
    Route::resource('users', UserController::class);

});

/*
|--------------------------------------------------------------------------
| Rutas de Inicio y Cierre de Sesión con Registro en Bitácora
|--------------------------------------------------------------------------
*/


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


//Bitacora
Route::middleware(['auth'])->group(function () {
    Route::get('/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::get('/bitacora/{id}', [BitacoraController::class, 'show'])->name('bitacora.show');
});

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


// Recursos (CRUD) sin middleware adicional
Route::resources([
    'rols' => RolController::class,
    'users' => UserController::class,
    'usuarios' => UserController::class,
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

//sidebar mis evaluaciones
// Listado de evaluaciones
Route::get('/mis-evaluaciones', [EstudianteController::class, 'misEvaluaciones'])
    ->name('estudiante.mis-evaluaciones')
    ->middleware('auth');

// Detalle de una evaluación específica 
Route::get('/mis-evaluaciones/{evaluacion}', [EstudianteController::class, 'verEvaluacion'])
    ->name('estudiante.ver-evaluacion');

    //sidebar notificaciones 
// Notificaciones
Route::middleware('auth')->group(function () {
    // Ruta básica para ver notificaciones propias
    Route::get('/mis-notificaciones', [NotificacioneController::class, 'misNotificaciones'])
        ->name('notificaciones.mias');
    
//inscribir
// Ruta GET para mostrar el formulario de inscripción
Route::get('/pagos/{pago}/inscribir', [PagoController::class, 'inscribir'])->name('pagos.inscribir');
Route::get('/mis-pagos', [PagoController::class, 'pago_est'])->name('pago.estudiante');

// Ruta POST para procesar el formulario
Route::post('/pagos/{pago}/inscribir', [PagoController::class, 'procesarInscripcion'])->name('pagos.procesarInscripcion');
Route::put('/pagos/{pago}/anular', [PagoController::class, 'anular'])->name('pagos.anular');
    // Ruta para marcar como leída
    Route::post('notificaciones/{notificacione}/marcar', [NotificacioneController::class, 'marcarComoLeida'])
        ->name('notificaciones.marcar');
    
    // Rutas CRUD solo para admin
    Route::group(['middleware' => ['auth']], function() {
         Route::resource('notificaciones', NotificacioneController::class);

         Route::get('notificaciones/show', [NotificacioneController::class, 'show'])
        ->name('notificaciones.show');
    });

    
});

Route::middleware(['auth'])->group(function () {
    // Rutas principales para reporte de fallas
    Route::resource('reporte-fallas', \App\Http\Controllers\ReporteFallaController::class)
         ->except(['edit', 'update']);
    
    // Ruta específica para cambiar estado - usa exactamente este nombre
    Route::patch('reporte-fallas/{reporteFalla}/cambiar-estado', 
        [\App\Http\Controllers\ReporteFallaController::class, 'updateEstado'])
        ->name('reporte-fallas.cambiar-estado');  // Nombre correcto
});