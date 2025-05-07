<?php

namespace App\Http\Controllers;

use App\Models\Inscribe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InscribeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $inscribes = Inscribe::paginate();

        return view('inscribe.index', compact('inscribes'))
            ->with('i', ($request->input('page', 1) - 1) * $inscribes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $inscribe = new Inscribe();

        return view('inscribe.create', compact('inscribe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InscribeRequest $request): RedirectResponse
    {
        Inscribe::create($request->validated());

        return Redirect::route('inscribes.index')
            ->with('success', 'Inscribe created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $inscribe = Inscribe::find($id);

        return view('inscribe.show', compact('inscribe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $inscribe = Inscribe::find($id);

        return view('inscribe.edit', compact('inscribe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InscribeRequest $request, Inscribe $inscribe): RedirectResponse
    {
        $inscribe->update($request->validated());

        return Redirect::route('inscribes.index')
            ->with('success', 'Inscribe updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Inscribe::find($id)->delete();

        return Redirect::route('inscribes.index')
            ->with('success', 'Inscribe deleted successfully');
    }
}
