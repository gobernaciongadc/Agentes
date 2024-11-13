<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AgenteRequest;
use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $agentes = Agente::paginate();

        return view('agente.index', compact('agentes'))
            ->with('i', ($request->input('page', 1) - 1) * $agentes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $agente = new Agente();
        $personas = Persona::all();
        $municipios = Municipio::all();
        $tipoAgentes = ['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales', 'proceso sancionador administrativo'];

        return view('agente.create', compact('agente', 'personas', 'municipios', 'tipoAgentes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request): RedirectResponse
    {
        // Realiza la validación de los datos
        $validatedData = $request->validate([
            'persona_id' => 'required',
            'municipio_id' => 'required',
            'tipoAgente' => 'required|string',
            'respaldo' => 'required|file|mimes:pdf|max:2048', // El archivo es obligatorio y debe ser PDF con tamaño máximo de 2MB
        ], [
            'respaldo.required' => 'El archivo respaldo es obligatorio.',
            'respaldo.mimes' => 'El archivo debe ser un PDF.',
            'respaldo.max' => 'El archivo no debe exceder los 2 MB.',
        ]);

        // Crear el nuevo agente
        Agente::create($validatedData);

        // Redirigir con un mensaje de éxito
        return Redirect::route('agentes.index')
            ->with('success', 'Agente creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $agente = Agente::find($id);
        return view('agente.show', compact('agente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $agente = Agente::find($id);
        $personas = Persona::all();
        $municipios = Municipio::all();
        $tipoAgentes = ['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales', 'proceso sancionador administrativo'];

        return view('agente.edit', compact('agente', 'personas', 'municipios', 'tipoAgentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgenteRequest $request, Agente $agente): RedirectResponse
    {
        $agente->update($request->validated());

        return Redirect::route('agentes.index')
            ->with('success', 'Agente updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Agente::find($id)->delete();

        return Redirect::route('agentes.index')
            ->with('success', 'Agente deleted successfully');
    }
}
