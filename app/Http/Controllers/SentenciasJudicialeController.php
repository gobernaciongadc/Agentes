<?php

namespace App\Http\Controllers;

use App\Models\SentenciasJudiciale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SentenciasJudicialeRequest;
use App\Models\Agente;
use App\Models\InformeNotarial;
use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SentenciasJudicialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $id = $request->query('id');
        $sentenciasJudiciales = SentenciasJudiciale::where('informe_id', $id)->orderBy('id', 'desc')->get();
        // Obtener la query string completa
        $informe = InformeNotarial::where('id', $id)->first();

        return view('sentencias-judiciale.index', compact('sentenciasJudiciales', 'id', 'informe'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
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

        $sentenciasJudiciale = new SentenciasJudiciale();
        // Obtener la query string completa
        $idInforme = $request->query('idInforme');

        return view('sentencias-judiciale.create', compact('sentenciasJudiciale', 'notario', 'municipio', 'idInforme', 'idUser'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SentenciasJudicialeRequest $request): RedirectResponse
    {
        $idInforme = $request->query('idInforme');

        SentenciasJudiciale::create($request->validated());

        return Redirect::route('sentencias-judiciales.index', ['id' => $idInforme])
            ->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $idInforme): View
    {
        $sentenciasJudiciale = SentenciasJudiciale::find($id);

        return view('sentencias-judiciale.show', compact('sentenciasJudiciale', 'idInforme'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idInforme): View
    {
        $sentenciasJudiciale = SentenciasJudiciale::find($id);

        return view('sentencias-judiciale.edit', compact('sentenciasJudiciale', 'idInforme'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SentenciasJudicialeRequest $request,  $id, $idInforme): RedirectResponse
    {
        $sentenciasJudiciale = SentenciasJudiciale::find($id);
        $sentenciasJudiciale->update($request->validated());

        return Redirect::route('sentencias-judiciales.index', ['id' => $idInforme])
            ->with('success', 'Información actualizada correctamente.');
    }

    public function destroy($id, $idInforme): RedirectResponse
    {
        SentenciasJudiciale::find($id)->delete();

        return Redirect::route('sentencias-judiciales.index', ['id' => $idInforme])
            ->with('success', 'SentenciasJudiciale deleted successfully');
    }
}
