<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View; // Agregar esta importación

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View // Método requerido para GET /login
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Registrar inicio de sesión
            $this->registrarBitacora(
                $request->ip(),
                'Inicio de sesión',
                Auth::id()
            );

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Obtener información crítica ANTES de cualquier operación
        $user = $request->user(); // Usar $request->user() en lugar de Auth::user()
        $userId = $user ? $user->id : null;
        $ip = $request->ip();
    
        // 2. Debug: Verificar que tenemos un usuario
        \Log::debug('Datos antes de logout', [
            'user_id' => $userId,
            'ip' => $ip,
            'auth_check' => Auth::check(),
            'session_id' => session()->getId()
        ]);
    
        // 3. Registrar el cierre de sesión
        $this->registrarLogoutEnBitacora($userId, $ip);
    
        // 4. Cerrar sesión
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // 5. Debug después de logout
        \Log::debug('Datos después de logout', [
            'auth_check' => Auth::check(),
            'session_id' => session()->getId()
        ]);
    
        return redirect('/');
    }

    private function registrarLogoutEnBitacora($userId, $ip)
    {
    // Intento 1: Base de datos
    try {
        DB::table('bitacoras')->insert([
            'id_user' => $userId,
            'ip' => $ip,
            'accion' => 'Cierre de sesión',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        \Log::info('Registro de logout exitoso en DB', ['user_id' => $userId]);
        return; // Si funciona, salir
    } catch (\Exception $e) {
        \Log::error('Error DB al registrar logout: ' . $e->getMessage());
    }

    // Intento 2: Archivo de log específico
    try {
        $logMessage = json_encode([
            'timestamp' => now()->toDateTimeString(),
            'user_id' => $userId,
            'ip' => $ip,
            'accion' => 'Cierre de sesión (fallback)'
        ]);
        
        file_put_contents(
            storage_path('logs/logout_fallback.log'),
            $logMessage . PHP_EOL,
            FILE_APPEND
        );
        
        \Log::info('Registro de logout en archivo fallback', ['user_id' => $userId]);
    } catch (\Exception $e) {
        \Log::critical('Fallo catastrófico al registrar logout: ' . $e->getMessage());
    }
    }
    
    /**
     * Registrar en bitácora con respaldo en archivo
     */
    private function registrarBitacora($ip, $accion, $userId)
    {
        try {
            // Método 1: Query Builder
            DB::table('bitacoras')->insert([
                'id_user' => $userId,
                'ip' => $ip,
                'accion' => $accion,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            // Método 2: Guardado en archivo
            $logData = [
                'timestamp' => now()->toDateTimeString(),
                'accion' => $accion,
                'ip' => $ip,
                'id_user' => $userId,
                'error_db' => $e->getMessage()
            ];
            
            file_put_contents(
                storage_path('logs/auth_bitacora.log'),
                json_encode($logData).PHP_EOL,
                FILE_APPEND
            );
            
            // Intento 3: Log de Laravel como último recurso
            Log::error("Error en bitácora de $accion: " . $e->getMessage());
        }
    }
}