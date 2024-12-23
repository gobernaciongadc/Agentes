<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MunicipioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $municipios = Municipio::orderBy('id', 'desc')->get();
        return view('municipio.index', compact('municipios'), ['currentPage' => 'Gestión de Municipios', 'titulo' => 'Municipios']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $municipio = new Municipio();

        $provincias = ['Arani', 'Arque', 'Ayopaya', 'Bolívar', 'Campero', 'Capinota', 'Carrasco', 'Cercado', 'chapare', 'Esteban Arze', 'Germán Jordán', 'Mizque', 'Punata', 'Quillacollo', 'Tapacarí', 'Tiraque']; // lista de provincias

        return view('municipio.create', compact('municipio', 'provincias'), ['currentPage' => 'Gestión de Municipios', 'titulo' => 'Municipios']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipioRequest $request): RedirectResponse
    {
        try {
            // Intentar crear el municipio
            Municipio::create($request->validated());

            // Redireccionar con un mensaje de éxito si todo sale bien
            return Redirect::route('municipios.index')
                ->with('success', 'Municipio creado exitosamente.');
        } catch (\Exception $e) {
            // Capturar cualquier excepción y redireccionar con un mensaje de error
            return Redirect::back()
                ->withInput() // Retener los datos ingresados
                ->with('error', 'Hubo un problema al crear el municipio. Por favor, intenta nuevamente.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $municipio = Municipio::find($id);

        return view('municipio.show', compact('municipio'), ['currentPage' => 'Gestión de Municipios', 'titulo' => 'Municipios']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $municipio = Municipio::find($id);
        $provincias = ['Arani', 'Arque', 'Ayopaya', 'Bolívar', 'Campero', 'Capinota', 'Carrasco', 'Cercado', 'Chapare', 'Esteban Arze', 'Germán Jordán', 'Mizque', 'Punata', 'Quillacollo', 'Tapacarí', 'Tiraque']; // lista de provincias
        return view('municipio.edit', compact('municipio', 'provincias'), ['currentPage' => 'Gestión de Municipios', 'titulo' => 'Municipios']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MunicipioRequest $request, Municipio $municipio): RedirectResponse
    {
        $municipio->update($request->validated());

        return Redirect::route('municipios.index')
            ->with('success', 'Municipio actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Municipio::find($id)->delete();

        return Redirect::route('municipios.index')
            ->with('success', 'Municipio eliminado exitosamente.');
    }
}
