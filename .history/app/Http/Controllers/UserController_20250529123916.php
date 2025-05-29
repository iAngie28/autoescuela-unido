<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function index(Request $request): View
    {
        // Capturar el término de búsqueda desde el input
        $search = $request->input('search');

        // Filtrar usuarios si hay un término de búsqueda
        $users = User::where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->paginate();

        return view('user.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * $users->perPage());
    }*/

    public function index(Request $request)
    {
        $query = \App\Models\User::query();

        // Búsqueda por nombre, email, etc.
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // Filtro por rol
        if ($request->filled('id_rol')) {
            $query->where('id_rol', $request->id_rol);
        }

        $users = $query->paginate(10);

        // Pasa la lista de roles al blade
        $roles = \App\Models\Rol::all();

        return view('users.index', compact('users', 'roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    /*public function create(): View
    {
        $user = new user();
        return view('user.create', compact('user'));
    }*/
    public function create(): View
    {
        $user = new User();
        $roles = Rol::all();
        return view('user.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::find($id);
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
        User::find($id)->delete();

        return Redirect::route('users.index')
            ->with('success', 'user deleted successfully');
    }
}
