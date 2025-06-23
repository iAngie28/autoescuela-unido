<?php

namespace App\Http\Controllers;

use App\Models\Notificacione;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\NotificacioneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NotificacioneController extends Controller
{
    /**
     * Display a listing of notifications (Admin only)
     */
    public function index(Request $request): View
    {
        
        
        $notificaciones = Notificacione::with('user')
            ->orderByDesc('fecha')
            ->paginate(10);

        return view('notificacione.index', [
            'notificaciones' => $notificaciones,
            'i' => ($request->input('page', 1) - 1) * 10
        ]);
    }

    /**
     * Show the form for creating a new notification (Admin only)
     */
    public function create(): View
    {
        
        $users = User::whereIn('tipo_usuario', ['E', 'I'])->get();
        return view('notificacione.create', compact('users'));
    }

    /**
     * Store a newly created notification (Admin only)
     */
    public function store(Request $request): RedirectResponse
    {        
        $validated = $request->validate([
            'mensaje' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'user_id' => 'required|exists:users,id'
        ]);

        Notificacione::create($validated);

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación creada exitosamente');
    }

    /**
     * Display personal notifications
     */
    public function misNotificaciones(): View
    {
        $notificaciones = Notificacione::where('user_id', auth()->id())
            ->orderByDesc('fecha')
            ->get();

        return view('notificacione.mias', [
            'notificaciones' => $notificaciones,
            'notiNoLeidas' => $notificaciones->where('leido', false)->count()
        ]);
    }

    /**
     * Mark notification as read
     */
    public function marcarComoLeida(Notificacione $notificacione): RedirectResponse
    {
        $this->authorize('update', $notificacione);

        $notificacione->update(['leido' => true]);

        return back()->with('success', 'Notificación marcada como leída');
    }

    /**
     * Show the form for editing a notification (Admin only)
     */
    public function edit(Notificacione $notificacione): View
    {
        $this->authorize('update', $notificacione);
        
        $users = User::whereIn('tipo_usuario', ['E', 'I'])->get();
        return view('notificacione.edit', compact('notificacione', 'users'));
    }

    /**
     * Update the specified notification (Admin only)
     */
    public function update(Request $request, Notificacione $notificacione): RedirectResponse
    {
        $this->authorize('update', $notificacione);
        
        $validated = $request->validate([
            'mensaje' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'fecha' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'leido' => 'sometimes|boolean'
        ]);

        $notificacione->update($validated);

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación actualizada exitosamente');
    }

    /**
     * Remove the specified notification (Admin only)
     */
    public function destroy(Notificacione $notificacione): RedirectResponse
    {
        
        $notificacione->delete();

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación eliminada exitosamente');
    }

    // show
   public function show($id)
{    
    // Marcar como leída si no lo está
    if (!$notificacion->leido) {
        $notificacion->update(['leido' => true]);
    }
    
    return view('notificaciones.show', compact('notificacion'));
}

}