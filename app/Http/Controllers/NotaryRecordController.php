<?php

namespace App\Http\Controllers;

use App\Models\NotaryRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\NotaryRecordRequest;
use App\Models\Agente;
use App\Models\InformeNotarial;
use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NotaryRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $id = $request->query('id');
        $notaryRecords = NotaryRecord::where('informe_id', $id)->get();
        // Obtener la query string completa
        $informe = InformeNotarial::where('id', $id)->first();

        return view('notary-record.index', compact('notaryRecords', 'id', 'informe'), ['titulo' => 'Gestión de Informe Notarios', 'currentPage' => 'Informe']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        // Datos de la persona  autenticada

        // Obtener el usuario autenticado
        $user = Auth::user();
        $idUser = $user->id;

        $agente = Agente::where('id', $user->agente_id)->first();

        $notario = Persona::where('id', $agente->persona_id)->first();

        $municipio = Municipio::where('id', $agente->municipio_id)->first();

        $notaryRecord = new NotaryRecord();

        // Obtener la query string completa
        $idInforme = $request->query('idInforme');

        return view('notary-record.create', compact('notaryRecord', 'notario', 'municipio', 'idInforme', 'idUser'), ['titulo' => 'Gestión de Informe Notarios', 'currentPage' => 'Regitrar Formulario']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotaryRecordRequest $request): RedirectResponse
    {
        $idInforme = $request->query('idInforme');


        NotaryRecord::create($request->validated());



        return Redirect::route('notary-records.index', ['id' => $idInforme])
            ->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $idInforme): View
    {
        $notaryRecord = NotaryRecord::find($id);

        return view('notary-record.show', compact('notaryRecord', 'idInforme'), ['titulo' => 'Gestión de Informe Notarios', 'currentPage' => 'Informe']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idInforme): View
    {
        $notaryRecord = NotaryRecord::find($id);

        return view('notary-record.edit', compact('notaryRecord', 'idInforme'), ['titulo' => 'Gestión de Informe Notarios', 'currentPage' => 'Informe']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotaryRecordRequest $request, $id, $idInforme): RedirectResponse
    {
        // Cargar manualmente el registro
        $notaryRecord = NotaryRecord::findOrFail($id);

        // Actualizar con los datos validados
        $notaryRecord->update($request->validated());

        return Redirect::route('notary-records.index', ['id' => $idInforme])
            ->with('success', 'Información actualizada correctamente.');
    }

    public function destroy($id, $idInforme): RedirectResponse
    {
        NotaryRecord::find($id)->delete();

        return Redirect::route('notary-records.index', ['id' => $idInforme])
            ->with('success', 'Registro eliminado correctamente');
    }
}
