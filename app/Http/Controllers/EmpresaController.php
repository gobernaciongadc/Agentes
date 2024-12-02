<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $empresas = Empresa::all();

        return view('empresa.index', compact('empresas'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $empresa = new Empresa();
        $respaldoUrl = false;
        return view('empresa.create', compact('empresa', 'respaldoUrl'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request): RedirectResponse
    {
        Empresa::create($request->validated());

        return Redirect::route('empresas.index')
            ->with('success', 'Empresa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $empresa = Empresa::find($id);

        return view('empresa.show', compact('empresa'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $empresa = Empresa::find($id);

        return view('empresa.edit', compact('empresa'), ['titulo' => 'Gestión de registro de información SEPREC', 'currentPage' => 'Empresa']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, Empresa $empresa): RedirectResponse
    {
        $empresa->update($request->validated());

        return Redirect::route('empresas.index')
            ->with('success', 'Empresa updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Empresa::find($id)->delete();

        return Redirect::route('empresas.index')
            ->with('success', 'Empresa deleted successfully');
    }
}