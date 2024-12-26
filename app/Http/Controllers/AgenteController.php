<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AgenteRequest;
use App\Models\Municipio;
use App\Models\Persona;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Cargar los agentes con las relaciones 'persona' y 'municipio'
        $agentes = Agente::with(['persona', 'municipio'])->get();

        return view('agente.index', compact('agentes'), ['currentPage' => 'Agentes de Información', 'titulo' => 'Gestión de Agentes de Información']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $agente = new Agente();
        $personas = Persona::all();
        $municipios = Municipio::all();
        $tipoAgentes = ['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales'];
        $respaldoUrl = false;
        return view('agente.create', compact('agente', 'personas', 'municipios', 'tipoAgentes', 'respaldoUrl'), ['currentPage' => 'Agentes de Información', 'titulo' => 'Gestión de Agentes de Información']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validar datos
            $validatedData = $request->validate([
                'persona_id' => 'required',
                'municipio_id' => 'required',
                'tipo_agente' => 'required|string',
                'respaldo' => 'required|file|mimes:pdf|max:2048',
            ], [
                'respaldo.required' => 'El archivo respaldo es obligatorio.',
                'respaldo.mimes' => 'El archivo debe ser un PDF.',
                'respaldo.max' => 'El archivo no debe exceder los 2 MB.',
            ]);

            // Subir archivo
            if ($request->hasFile('respaldo')) {
                $filePath = $request->file('respaldo')->store('respaldos', 'public');
                $validatedData['respaldo'] = $filePath;
            }

            // Crear el nuevo agente
            Agente::create($validatedData);

            // Redirigir con mensaje de éxito
            return Redirect::route('agentes.index')->with('success', 'Agente creado exitosamente.');
        } catch (\Exception $e) {
            // Capturar cualquier excepción y redirigir con un mensaje de error
            return Redirect::back()->with('error', 'Hubo un error al crear el agente: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $agente = Agente::find($id);
        return view('agente.show', compact('agente'), ['currentPage' => 'Agentes de Información', 'titulo' => 'Gestión de Agentes de Información']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $agente = Agente::find($id);
        $personas = Persona::all();
        $municipios = Municipio::all();
        $tipoAgentes = ['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales'];
        $estados = [
            0 => 'Inactivo',
            1 => 'Activo',
        ]; // Asociamos un valor numérico con su significado para mostrarlo en el formulario.

        // Verificar si el archivo existe y pasar a la vista
        $respaldoUrl = $agente->respaldo ? asset('storage/' . $agente->respaldo) : null;

        return view('agente.edit', compact('agente', 'personas', 'municipios', 'tipoAgentes', 'respaldoUrl', 'estados'), ['currentPage' => 'Agentes de Información', 'titulo' => 'Gestión de Agentes de Información']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agente $agente): RedirectResponse
    {
        try {
            // Validar los datos enviados
            $validatedData = $request->validate([
                'persona_id' => 'required',
                'municipio_id' => 'required',
                'tipo_agente' => 'required|string',
                'respaldo' => 'nullable|file|mimes:pdf|max:2048', // El archivo es opcional
                'estado' => 'required', // Aunque no esté en el modelo, lo validamos
            ], [
                'respaldo.mimes' => 'El archivo debe ser un PDF.',
                'respaldo.max' => 'El archivo no debe exceder los 2 MB.',
            ]);

            // Guardar cada dato individualmente
            $agente->persona_id = $validatedData['persona_id'];
            $agente->municipio_id = $validatedData['municipio_id'];
            $agente->tipo_agente = $validatedData['tipo_agente'];
            $agente->estado = $validatedData['estado'];

            // Manejar el archivo respaldo si es necesario
            if ($request->hasFile('respaldo')) {
                // Eliminar archivo anterior si existe
                if ($agente->respaldo && Storage::exists('public/' . $agente->respaldo)) {
                    Storage::delete('public/' . $agente->respaldo);
                }

                // Subir el nuevo archivo
                $filePath = $request->file('respaldo')->store('respaldos', 'public');
                $agente->respaldo = $filePath;
            }

            // Guardar los cambios del modelo
            $agente->save();


            // Redirigir con mensaje de éxito
            return Redirect::route('agentes.index')->with('success', 'Agente actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejar excepciones y redirigir con un mensaje de error
            return Redirect::back()->with('error', 'Hubo un error al actualizar el agente: ' . $e->getMessage());
        }
    }


    public function destroy($id): RedirectResponse
    {
        try {
            // Buscar el agente
            $agente = Agente::findOrFail($id);

            // Cambiar el estado a 0 (inactivo)
            $agente->estado = 0;
            $agente->save();

            // Redirigir con un mensaje de éxito
            return Redirect::route('agentes.index')
                ->with('success', 'El estado del agente se cambió a inactivo exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier error
            return Redirect::back()->with('error', 'Hubo un error al intentar cambiar el estado: ' . $e->getMessage());
        }
    }

    function listagentes()
    {
        $listaAgentes = Agente::with('persona')->where('estado_user', 1)->get();

        try {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'listagentes' => $listaAgentes,
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
