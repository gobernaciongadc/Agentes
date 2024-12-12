<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ComunicadoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $comunicados = Comunicado::paginate();

        return view('comunicado.index', compact('comunicados'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados'])
            ->with('i', ($request->input('page', 1) - 1) * $comunicados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $comunicado = new Comunicado();

        return view('comunicado.create', compact('comunicado'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComunicadoRequest $request): RedirectResponse
    {
        Comunicado::create($request->validated());

        return Redirect::route('comunicados.index')
            ->with('success', 'Comunicado created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $comunicado = Comunicado::find($id);

        return view('comunicado.show', compact('comunicado'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $comunicado = Comunicado::find($id);

        return view('comunicado.edit', compact('comunicado'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComunicadoRequest $request, Comunicado $comunicado): RedirectResponse
    {
        $comunicado->update($request->validated());

        return Redirect::route('comunicados.index')
            ->with('success', 'Comunicado updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Comunicado::find($id)->delete();

        return Redirect::route('comunicados.index')
            ->with('success', 'Comunicado deleted successfully');
    }
}
