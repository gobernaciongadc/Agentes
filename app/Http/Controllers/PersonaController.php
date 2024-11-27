<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PersonaRequest;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $personas = Persona::all();

        return view('persona.index', compact('personas'), ['currentPage' => 'Gestión de Personas', 'titulo' => 'Gestión de Personas']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $persona = new Persona();

        return view('persona.create', compact('persona'), ['currentPage' => 'Gestión de Personas', 'titulo' => 'Gestión de Personas']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonaRequest $request): RedirectResponse
    {
        try {
            // Intentar crear la persona
            Persona::create($request->validated());

            // Redireccionar con un mensaje de éxito si todo sale bien
            return Redirect::route('personas.index')
                ->with('success', 'Persona creada exitosamente.');
        } catch (\Exception $e) {
            // Capturar cualquier excepción y redireccionar con un mensaje de error
            return Redirect::back()
                ->withInput() // Retener los datos ingresados por el usuario
                ->with('error', 'Hubo un problema al crear la persona. Por favor, intenta nuevamente.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $persona = Persona::find($id);

        return view('persona.show', compact('persona'), ['currentPage' => 'Gestión de Personas', 'titulo' => 'Gestión de Personas']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $persona = Persona::find($id);

        return view('persona.edit', compact('persona'), ['currentPage' => 'Gestión de Personas', 'titulo' => 'Gestión de Personas']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonaRequest $request, Persona $persona): RedirectResponse
    {
        $persona->update($request->validated());

        return Redirect::route('personas.index')
            ->with('success', 'Persona updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Persona::find($id)->delete();

        return Redirect::route('personas.index')
            ->with('success', 'Persona deleted successfully');
    }


    function listpersonas()
    {
        $listaPersonas = Persona::where('estado_user', 1)->get();

        try {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'listpersonas' => $listaPersonas,
            );
        } catch (Exception $e) {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'error' => $e->getMessage(),
            );
        }
        return response()->json($data, $data['code']);
    }
}
