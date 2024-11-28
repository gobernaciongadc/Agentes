<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InformeNotarialRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InformeNotarialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $informeNotarials = InformeNotarial::all();

        return view('informe-notarial.index', compact('informeNotarials'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $informeNotarial = new InformeNotarial();

        return view('informe-notarial.create', compact('informeNotarial'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformeNotarialRequest $request): RedirectResponse
    {
        InformeNotarial::create($request->validated());

        return Redirect::route('informe-notarials.index')
            ->with('success', 'InformeNotarial created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $informeNotarial = InformeNotarial::find($id);

        return view('informe-notarial.show', compact('informeNotarial'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $informeNotarial = InformeNotarial::find($id);

        return view('informe-notarial.edit', compact('informeNotarial'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformeNotarialRequest $request, InformeNotarial $informeNotarial): RedirectResponse
    {
        $informeNotarial->update($request->validated());

        return Redirect::route('informe-notarials.index')
            ->with('success', 'InformeNotarial updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        InformeNotarial::find($id)->delete();

        return Redirect::route('informe-notarials.index')
            ->with('success', 'InformeNotarial deleted successfully');
    }
}
