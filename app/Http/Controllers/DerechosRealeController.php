<?php

namespace App\Http\Controllers;

use App\Models\DerechosReale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DerechosRealeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DerechosRealeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $derechosReales = DerechosReale::all();

        return view('derechos-reale.index', compact('derechosReales'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $derechosReale = new DerechosReale();

        return view('derechos-reale.create', compact('derechosReale'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DerechosRealeRequest $request): RedirectResponse
    {
        DerechosReale::create($request->validated());

        return Redirect::route('derechos-reales.index')
            ->with('success', 'DerechosReale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $derechosReale = DerechosReale::find($id);

        return view('derechos-reale.show', compact('derechosReale'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $derechosReale = DerechosReale::find($id);

        return view('derechos-reale.edit', compact('derechosReale'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DerechosRealeRequest $request, DerechosReale $derechosReale): RedirectResponse
    {
        $derechosReale->update($request->validated());

        return Redirect::route('derechos-reales.index')
            ->with('success', 'DerechosReale updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        DerechosReale::find($id)->delete();

        return Redirect::route('derechos-reales.index')
            ->with('success', 'DerechosReale deleted successfully');
    }
}
