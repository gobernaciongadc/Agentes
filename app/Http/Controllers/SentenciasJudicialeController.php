<?php

namespace App\Http\Controllers;

use App\Models\SentenciasJudiciale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SentenciasJudicialeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SentenciasJudicialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sentenciasJudiciales = SentenciasJudiciale::all();

        return view('sentencias-judiciale.index', compact('sentenciasJudiciales'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sentenciasJudiciale = new SentenciasJudiciale();

        return view('sentencias-judiciale.create', compact('sentenciasJudiciale'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SentenciasJudicialeRequest $request): RedirectResponse
    {
        SentenciasJudiciale::create($request->validated());

        return Redirect::route('sentencias-judiciales.index')
            ->with('success', 'SentenciasJudiciale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sentenciasJudiciale = SentenciasJudiciale::find($id);

        return view('sentencias-judiciale.show', compact('sentenciasJudiciale'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sentenciasJudiciale = SentenciasJudiciale::find($id);

        return view('sentencias-judiciale.edit', compact('sentenciasJudiciale'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SentenciasJudicialeRequest $request, SentenciasJudiciale $sentenciasJudiciale): RedirectResponse
    {
        $sentenciasJudiciale->update($request->validated());

        return Redirect::route('sentencias-judiciales.index')
            ->with('success', 'SentenciasJudiciale updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        SentenciasJudiciale::find($id)->delete();

        return Redirect::route('sentencias-judiciales.index')
            ->with('success', 'SentenciasJudiciale deleted successfully');
    }
}
