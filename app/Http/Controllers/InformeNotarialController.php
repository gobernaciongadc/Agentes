<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InformeNotarialRequest;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request)
    {

        $params = (object) $request->all(); // Devulve un obejto
        $paramsArray = $request->all(); // Devuelve un array   

        // Validación
        $validate = Validator::make($paramsArray, [
            'descripcion' => 'required'
        ]);

        // Comprobar si los datos son validos
        if ($validate->fails()) { // en caso si los datos fallan la validacion
            // La validacion ha fallado
            $data = array(
                'status' => 'Error',
                'code' => 400,
                'message' => 'Los datos enviados no son correctos',
                'informe' => $request->all(),
                'errors' => $validate->errors()
            );
        } else {
            // Crear el objeto usuario para guardar en la base de datos
            $informe = new InformeNotarial();
            $informe->descripcion = $params->descripcion;

            try {
                // Guardar
                $informe->save();

                // Obtener el informe con el id del nuevo registro                 
                $getInforme = InformeNotarial::find($informe->id);

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El informe notarial se ha creado correctamente',
                    'informe'  => $getInforme
                );
            } catch (Exception $e) {
                $data = array(
                    'status' => 'Error',
                    'code' => 404,
                    'message' => $e
                );
            }
        }

        // Devuelve en json con laravel
        return response()->json($data, $data['code']);
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
