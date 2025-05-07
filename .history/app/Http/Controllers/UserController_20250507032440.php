<?php

namespace App\Http\Controllers;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $Users = User::paginate();

        return view('us.index', compact('Users'))
            ->with('i', ($request->input('page', 1) - 1) * $Users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    /*public function create(): View
    {
        $User = new User();
        return view('User.create', compact('User'));
    }*/
    public function create(): View
{
    $User = new User();
    $roles = Rol::all();
    return view('User.create', compact('User', 'roles'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        
        return Redirect::route('user.index')
            ->with('success', 'User created successfully.');
            
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $User = User::find($id);

        return view('User.show', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $User = User::find($id);
        $roles = Rol::all();
        return view('User.edit', compact('User', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $User): RedirectResponse
    {
        $User->update($request->validated());

        return Redirect::route('Users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();

        return Redirect::route('Users.index')
            ->with('success', 'User deleted successfully');
    }
}
