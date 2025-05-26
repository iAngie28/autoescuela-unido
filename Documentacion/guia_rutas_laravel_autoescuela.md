
# Guía de Rutas en Laravel — Proyecto Autoescuela

Este archivo resume **todas las formas de enrutar** que aparecen en el proyecto, con ejemplos reales, casos de uso, buenas prácticas y las soluciones a errores comunes que surgieron en la implementación.

---

## 1. Rutas Directas a Vistas (Sin Controlador)

### Ejemplo:

```php
Route::view('/', 'welcome');
Route::view('/about', 'paginas.about')->name('about');
Route::view('/cursos', 'paginas.cursos')->name('cursos');
```

#### ¿Cuándo se usan?
- Cuando solo se desea mostrar una vista estática (HTML, Blade) y **no es necesario procesar datos en el backend**.
- Ejemplo: Páginas de bienvenida, información o contenido estático.

#### Características
- **No** pasan variables desde el backend a la vista.
- Simples y rápidas para contenido fijo.

---

## 2. Rutas Cerradas con Funciones (Closures)

### Ejemplo:

```php
Route::get('/clase-reprogramar', function () {
    $clases = App\Models\Clase::all();
    return view('clase.reprogramar', compact('clases'));
});
```

#### ¿Cuándo se usan?
- Para pruebas rápidas o prototipos, o cuando la lógica es **muy simple**.
- No es recomendable para lógica compleja ni para proyectos grandes.

#### Características
- Se puede pasar información a la vista.
- **No** reutilizable ni mantenible a largo plazo.

---

## 3. Rutas Hacia Métodos de Controladores

### Ejemplo:

```php
use App\Http\Controllers\ClaseController;
Route::get('/clase-reprogramar', [ClaseController::class, 'reprogramar'])
    ->middleware('auth')
    ->name('clase.reprogramar');
```

#### ¿Cuándo se usan?
- **Siempre que la lógica requiera trabajar con modelos, validaciones, o manejar datos del usuario.**
- Permiten mantener el código ordenado y reutilizable.

#### Características
- El controlador puede consultar la base de datos y pasar variables a la vista.
- Se puede proteger con middleware como `auth` (solo usuarios logueados acceden).
- Se recomienda en proyectos medianos y grandes.

#### Caso real:
- **Creamos esta ruta porque necesitábamos pasar datos dinámicos (`$clases`) a la vista y protegerla con autenticación.**
- **Errores y solución:**  
    - Al usar inicialmente una ruta por closure (`function() { ... }`), la vista no encontraba la variable `$clases`.
    - Al pasar el método al controlador pero usando `Clase::all()`, salió el error: _"withQueryString does not exist"_, porque la vista usaba paginación.  
    - Se corrigió usando `Clase::paginate(10)`, así la variable es un paginador y la vista funciona igual que en el index.
    - El controlador final:

    ```php
    public function reprogramar(Request $request): View 
    {
        $clases = Clase::paginate();
        return view('clase.reprogramar', compact('clases'));
    }
    ```

    - Además, agregamos `->middleware('auth')` para que **sólo usuarios autenticados** puedan acceder, previniendo errores al mostrar información del usuario en la sidebar.

---

## 4. Rutas Resource (Automatizadas para CRUD)

### Ejemplo:

```php
Route::resource('rol', RolController::class);
```

#### ¿Cuándo se usan?
- Cuando necesitas todas las rutas de un CRUD básico (crear, ver, editar, eliminar).
- El controlador debe usar los métodos estándar (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`).

#### Características
- Laravel genera rutas como:
    - GET `/rol` (listar)
    - GET `/rol/create` (formulario)
    - POST `/rol` (guardar)
    - GET `/rol/{id}` (ver detalle)
    - GET `/rol/{id}/edit` (editar)
    - PUT `/rol/{id}` (actualizar)
    - DELETE `/rol/{id}` (eliminar)
- Permite mantener el código ordenado y RESTful.

---

## 5. Rutas de Autenticación

### Ejemplo:

```php
require __DIR__.'/auth.php';
```

- Define rutas para login, registro, recuperación y verificación de contraseña.
- Usadas internamente por Laravel Breeze, Jetstream, Fortify, etc.

---

## 6. Rutas API (Para apps móviles o servicios externos)

### Ejemplo:

```php
// En routes/api.php
use App\Http\Controllers\Api\ClaseApiController;

Route::middleware('auth:sanctum')->get('/clases', [ClaseApiController::class, 'index']);
```

#### ¿Cuándo se usan?
- Cuando necesitas exponer datos o lógica para aplicaciones móviles, frontends con Angular, Flutter, etc.
- No devuelven vistas, sino **JSON** (o XML).

#### Características
- Normalmente están en `routes/api.php`.
- Usan el middleware `api` por defecto.
- Son stateless (sin sesión tradicional), se recomienda autenticar con **tokens** (Laravel Sanctum, Passport, JWT).
- Los controladores suelen estar en `App\Http\Controllers\Api`.

---

## 7. Middleware Personalizado

### Ejemplo:

```php
// Crear middleware con artisan:
php artisan make:middleware IsAdmin

// Luego en app/Http/Middleware/IsAdmin.php
public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->rol == 'admin') {
        return $next($request);
    }
    return redirect('/'); // O donde prefieras
}
```

Para usarlo:
```php
Route::get('/admin-only', function () {
    // solo admins llegan aquí
})->middleware('isadmin');
```

#### ¿Cuándo se usa?
- Para proteger rutas de acceso según el rol, permisos, validaciones extra, etc.

#### Características
- Aumenta la seguridad y organización de tus rutas.
- Reutilizable en varias rutas o grupos de rutas.
- Se puede combinar con otros middleware (`auth`, `verified`, etc).

---

## Errores Frecuentes y Soluciones Aplicadas

- **Vista no encontrada**: Laravel no encuentra una vista si el nombre no es correcto o no termina en `.blade.php`.
- **Undefined variable**: Si una vista usa una variable no definida, hay que pasarla desde la ruta o el controlador.
- **Método `withQueryString()` en una Collection**: Solucionado usando `paginate()` en vez de `all()`.
- **Error al acceder a propiedades de usuario no autenticado**: Solucionado protegiendo rutas con `auth` y usando `@if(Auth::check())` en las vistas.
- **Columna faltante en la base de datos**: Al aparecer el error de columna `fecha_salida` no encontrada en Bitacora, se explicó cómo agregarla con migraciones.

---

## Resumen de Buenas Prácticas

- **Usa controladores** para lógica compleja y para pasar datos a las vistas.
- **Protege rutas sensibles** con middleware `auth` para que solo usuarios autenticados accedan.
- **Usa paginación** cuando muestres listas largas.
- **Revisa la base de datos** y las migraciones para que coincidan con el código.
- **Comenta tus rutas** para que otros desarrolladores entiendan el propósito y funcionamiento de cada una.
- **Para APIs**, usa el archivo `api.php` y autenticación por tokens.
- **Crea middleware personalizado** para lógica de permisos más avanzada.

---

> _Documento generado para la comprensión y mantenimiento del sistema Autoescuela-unido. Actualizado a mayo 2025._
