<?php

namespace App\Http\Controllers;

use App\Models\NotaryRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\NotaryRecordRequest;
use App\Models\Agente;
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
        $notaryRecords = NotaryRecord::all();

        return view('notary-record.index', compact('notaryRecords'), ['titulo' => 'Gestión de Informe', 'currentPage' => 'Informe']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Datos de la persona  autenticada

        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $notario = Persona::where('id', $agente->persona_id)->first();

        $municipio = Municipio::where('id', $agente->municipio_id)->first();

        $notaryRecord = new NotaryRecord();


        return view('notary-record.create', compact('notaryRecord', 'notario', 'municipio'), ['titulo' => 'Gestión de Informe', 'currentPage' => 'Regitrar Formulario']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotaryRecordRequest $request): RedirectResponse
    {
        NotaryRecord::create($request->validated());

        return Redirect::route('notary-records.index')
            ->with('success', 'NotaryRecord created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $notaryRecord = NotaryRecord::find($id);

        return view('notary-record.show', compact('notaryRecord'), ['titulo' => 'Gestión de Informe', 'currentPage' => 'Informe']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $notaryRecord = NotaryRecord::find($id);

        return view('notary-record.edit', compact('notaryRecord'), ['titulo' => 'Gestión de Informe', 'currentPage' => 'Informe']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotaryRecordRequest $request, NotaryRecord $notaryRecord): RedirectResponse
    {
        $notaryRecord->update($request->validated());

        return Redirect::route('notary-records.index')
            ->with('success', 'NotaryRecord updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        NotaryRecord::find($id)->delete();

        return Redirect::route('notary-records.index')
            ->with('success', 'NotaryRecord deleted successfully');
    }
}
