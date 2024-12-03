<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SancionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SancionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sancions = Sancion::all();

        return view('sancion.index', compact('sancions'));
    }

    public function indexBandejaEntrada(Request $request): View
    {
        $sancions = Sancion::all();

        return view('sancion.lista-recibidos', compact('sancions'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sancion = new Sancion();

        return view('sancion.create', compact('sancion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SancionRequest $request): RedirectResponse
    {
        Sancion::create($request->validated());

        return Redirect::route('sancions.index')
            ->with('success', 'Sancion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sancion = Sancion::find($id);

        return view('sancion.show', compact('sancion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sancion = Sancion::find($id);

        return view('sancion.edit', compact('sancion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SancionRequest $request, Sancion $sancion): RedirectResponse
    {
        $sancion->update($request->validated());

        return Redirect::route('sancions.index')
            ->with('success', 'Sancion updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Sancion::find($id)->delete();

        return Redirect::route('sancions.index')
            ->with('success', 'Sancion deleted successfully');
    }
}
