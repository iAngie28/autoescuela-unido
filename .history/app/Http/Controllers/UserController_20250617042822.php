<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use App\Models\Bitacora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('id_rol')) {
            $query->where('id_rol', $request->id_rol);
        }

        $users = $query->paginate(10);
        $roles = Rol::all();

        return view('user.index', compact('users', 'roles'));
    }

    public function create(): View
    {
        $user = new User();
        $roles = Rol::all();
        return view('user.create', compact('user', 'roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());


        return Redirect::route('users.index')
            ->with('success', 'user created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);
        $roles = Rol::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return Redirect::route('users.index')
            ->with('success', 'user updated successfully');
    }



    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $user = User::findOrFail($id);
            $userData = $user->toArray(); // Guardar datos para bitácora
            
            $user->delete();
            
            // Registrar en bitácora
            $this->registrarBitacora(
                'Eliminación de usuario',
                'ID: ' . $user->id . ' | Nombre: ' . $user->name . ' | Email: ' . $user->email,
                request()->ip()
            );
            
            DB::commit();
            
            return Redirect::route('users.index')
                ->with('success', 'Usuario eliminado correctamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }

    /**
     * Registra una acción en la bitácora con respaldo en archivo
     */
    private function registrarBitacora($accion, $detalle, $ip)
    {
        try {
            // Método 1: Query Builder (más confiable)
            DB::table('bitacoras')->insert([
                'id_user' => Auth::id(),
                'ip' => $ip,
                'accion' => $accion . ' - ' . $detalle,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            // Método 2: Guardado en archivo como respaldo
            $logData = [
                'timestamp' => now()->toDateTimeString(),
                'accion' => $accion,
                'detalle' => $detalle,
                'ip' => $ip,
                'error_db' => $e->getMessage()
            ];
            
            file_put_contents(
                storage_path('logs/bitacora_usuarios.log'),
                json_encode($logData).PHP_EOL,
                FILE_APPEND
            );
        }
    }
}