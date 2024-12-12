<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use App\Models\Agente;
use App\Models\InformeNotarial;
use App\Models\Municipio;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $id = $request->query('id');
        // dd($id);
        $empresas = Empresa::where('informe_id', $id)->orderBy('id', 'desc')->get();
        // Obtener la query string completa
        $informe = InformeNotarial::where('id', $id)->first();

        return view('empresa.index', compact('empresas', 'id', 'informe'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
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

        $empresa = new Empresa();
        $respaldoUrl = false;
        // Obtener la query string completa
        $idInforme = $request->query('idInforme');

        $eliminar = false;

        // dd($idInforme);

        return view('empresa.create', compact('empresa', 'respaldoUrl', 'notario', 'municipio', 'idInforme', 'idUser', 'eliminar'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request): RedirectResponse
    {
        $idInforme = $request->query('id');
        $data = $request->validated();

        // Manejo de archivos para 'base_empresarial_empresas_activas'
        if ($request->hasFile('base_empresarial_empresas_activas')) {
            $file = $request->file('base_empresarial_empresas_activas');
            $fileName = time() . '_activas_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/empresas', $fileName, 'public');
            $data['base_empresarial_empresas_activas'] = $fileName;
        }

        // Manejo de archivos para 'transferencia_cuotas_capital'
        if ($request->hasFile('transferencia_cuotas_capital')) {
            $file = $request->file('transferencia_cuotas_capital');
            $fileName = time() . '_cuotas_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/empresas', $fileName, 'public');
            $data['transferencia_cuotas_capital'] = $fileName;
        }

        // Manejo de archivos para 'transferencia_empresa_unipersonal'
        if ($request->hasFile('transferencia_empresa_unipersonal')) {
            $file = $request->file('transferencia_empresa_unipersonal');
            $fileName = time() . '_unipersonal_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/empresas', $fileName, 'public');
            $data['transferencia_empresa_unipersonal'] = $fileName;
        }
        Empresa::create($data);

        return Redirect::route('empresas.index', ['id' => $idInforme])
            ->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $idInforme): View
    {
        $empresa = Empresa::find($id);

        return view('empresa.show', compact('empresa', 'idInforme'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idInforme): View
    {

        $empresa = Empresa::find($id);

        $eliminar = true;

        $respaldoUrl = false;
        return view('empresa.edit', compact('empresa', 'respaldoUrl', 'idInforme', 'eliminar'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $idInforme)
    {
        $empresa = Empresa::find($id);

        $data = $request->all();

        // Eliminar archivos si el usuario lo solicita
        if ($request->has('eliminar_base_empresarial_empresas_activas') && $empresa->base_empresarial_empresas_activas) {
            Storage::disk('public')->delete('uploads/empresas/' . $empresa->base_empresarial_empresas_activas);
            $data['base_empresarial_empresas_activas'] = null;
        }

        if ($request->has('eliminar_transferencia_cuotas_capital') && $empresa->transferencia_cuotas_capital) {
            Storage::disk('public')->delete('uploads/empresas/' . $empresa->transferencia_cuotas_capital);
            $data['transferencia_cuotas_capital'] = null;
        }

        if ($request->has('eliminar_transferencia_empresa_unipersonal') && $empresa->transferencia_empresa_unipersonal) {
            Storage::disk('public')->delete('uploads/empresas/' . $empresa->transferencia_empresa_unipersonal);
            $data['transferencia_empresa_unipersonal'] = null;
        }

        // Manejo de archivos para 'base_empresarial_empresas_activas'
        if ($request->hasFile('base_empresarial_empresas_activas')) {
            $file = $request->file('base_empresarial_empresas_activas');
            $fileName = time() . '_activas_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/empresas', $fileName, 'public');

            if ($empresa->base_empresarial_empresas_activas) {
                Storage::disk('public')->delete('uploads/empresas/' . $empresa->base_empresarial_empresas_activas);
            }

            $data['base_empresarial_empresas_activas'] = $fileName;
        }

        // Manejo de archivos para 'transferencia_cuotas_capital'
        if ($request->hasFile('transferencia_cuotas_capital')) {
            $file = $request->file('transferencia_cuotas_capital');
            $fileName = time() . '_cuotas_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/empresas', $fileName, 'public');

            if ($empresa->transferencia_cuotas_capital) {
                Storage::disk('public')->delete('uploads/empresas/' . $empresa->transferencia_cuotas_capital);
            }

            $data['transferencia_cuotas_capital'] = $fileName;
        }

        // Manejo de archivos para 'transferencia_empresa_unipersonal'
        if ($request->hasFile('transferencia_empresa_unipersonal')) {
            $file = $request->file('transferencia_empresa_unipersonal');
            $fileName = time() . '_unipersonal_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/empresas', $fileName, 'public');

            if ($empresa->transferencia_empresa_unipersonal) {
                Storage::disk('public')->delete('uploads/empresas/' . $empresa->transferencia_empresa_unipersonal);
            }

            $data['transferencia_empresa_unipersonal'] = $fileName;
        }

        // Actualizar la empresa con los nuevos datos
        $empresa->update($data);

        return redirect()->route('empresas.index', ['id' => $idInforme])->with('success', 'Empresa actualizada correctamente.');
    }


    public function destroy($id, $idInforme): RedirectResponse
    {
        Empresa::find($id)->delete();
        return Redirect::route('empresas.index', ['id' => $idInforme])
            ->with('success', 'Registro eliminado correctamente');
    }
}
