<?php

namespace App\Http\Controllers;

use App\Models\DerechosReale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DerechosRealeRequest;
use App\Models\Agente;
use App\Models\InformeNotarial;
use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DerechosRealeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $id = $request->query('id');
        $derechosReales = DerechosReale::where('informe_id', $id)->orderBy('id', 'desc')->get();
        // Obtener la query string completa
        $informe = InformeNotarial::where('id', $id)->first();
        return view('derechos-reale.index', compact('derechosReales', 'id', 'informe'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $user = Auth::user();
        $idUser = $user->id;

        $agente = Agente::where('id', $user->agente_id)->first();

        $notario = Persona::where('id', $agente->persona_id)->first();

        $municipio = Municipio::where('id', $agente->municipio_id)->first();

        $derechosReale = new DerechosReale();

        // Obtener la query string completa
        $idInforme = $request->query('idInforme');

        return view('derechos-reale.create', compact('derechosReale', 'notario', 'municipio', 'idInforme', 'idUser'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DerechosRealeRequest $request): RedirectResponse
    {
        $idInforme = $request->query('idInforme');

        DerechosReale::create($request->validated());

        return Redirect::route('derechos-reales.index', ['id' => $idInforme])
            ->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $idInforme): View
    {
        $derechosReale = DerechosReale::find($id);

        return view('derechos-reale.show', compact('derechosReale', 'idInforme'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idInforme): View
    {
        $derechosReale = DerechosReale::find($id);

        return view('derechos-reale.edit', compact('derechosReale', 'idInforme'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DerechosRealeRequest $request, $id, $idInforme): RedirectResponse
    {
        $derechosReale = DerechosReale::find($id);
        $derechosReale->update($request->validated());

        return Redirect::route('derechos-reales.index', ['id' => $idInforme])
            ->with('success', 'Información actualizada correctamente.');
    }

    public function destroy($id, $idInforme): RedirectResponse
    {
        DerechosReale::find($id)->delete();

        return Redirect::route('derechos-reales.index', ['id' => $idInforme])
            ->with('success', 'Registro eliminado correctamente');
    }
}
