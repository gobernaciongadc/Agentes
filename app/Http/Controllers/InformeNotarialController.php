<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InformeNotarialRequest;
use App\Models\Agente;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class InformeNotarialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id = null): View
    {

        // Si $id no es null, filtra los resultados o realiza acciones específicas
        // if ($id) {
        //     $informeNotarials = InformeNotarial::where('id', $id)->get();
        // } else {
        //     // Si no se proporciona $id, muestra todos los registros
        //     $informeNotarials = InformeNotarial::all();
        // }


        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();

        return view('informe-notarial.index', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    public function indexSeprec(Request $request, $id = null): View
    {

        // Si $id no es null, filtra los resultados o realiza acciones específicas
        // if ($id) {
        //     $informeNotarials = InformeNotarial::where('id', $id)->get();
        // } else {
        //     // Si no se proporciona $id, muestra todos los registros
        //     $informeNotarials = InformeNotarial::all();
        // }


        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();

        return view('informe-notarial.index_notario', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información de Empresas SEPREC', 'currentPage' => 'Informe de Empresas']);
    }

    public function indexJuzgado(Request $request, $id = null): View
    {

        // Si $id no es null, filtra los resultados o realiza acciones específicas
        // if ($id) {
        //     $informeNotarials = InformeNotarial::where('id', $id)->get();
        // } else {
        //     // Si no se proporciona $id, muestra todos los registros
        //     $informeNotarials = InformeNotarial::all();
        // }


        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();

        return view('informe-notarial.index_juzgado', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información de Setratarios y Juzgados', 'currentPage' => 'Informe Juzgados']);
    }

    public function indexDerecho(Request $request, $id = null): View
    {

        // Si $id no es null, filtra los resultados o realiza acciones específicas
        // if ($id) {
        //     $informeNotarials = InformeNotarial::where('id', $id)->get();
        // } else {
        //     // Si no se proporciona $id, muestra todos los registros
        //     $informeNotarials = InformeNotarial::all();
        // }


        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();

        return view('informe-notarial.index_derechos', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información de Derechos Reales', 'currentPage' => 'Informe Derechos Reales']);
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
        $paramsArray = $request->all(); // Devuelve un array  ;

        // Obtener el usuario autenticado
        $user = Auth::user();

        if ($user->rol == 'Agente') {

            $agente = Agente::where('id', $user->agente_id)->first();

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
                $informe->usuario_id = $user->id;
                try {
                    // Guardar
                    $informe->save();

                    // Obtener el informe con el id del nuevo registro                 
                    $getInforme = InformeNotarial::with('user')->where('id', $informe->id)->where('usuario_id', $user->id)->first();

                    // Obtener el agente que esta creando el informe
                    $getAgente = Agente::find($user->agente_id);


                    $data = array(
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'El informe notarial se ha creado correctamente',
                        'informe'  => $getInforme,
                        'agente' => $getAgente
                    );
                } catch (Exception $e) {
                    $data = array(
                        'status' => 'Error',
                        'code' => 404,
                        'message' => $e
                    );
                }
            }
        } else {
            $data = array(
                'status' => 'Error',
                'code' => 404,
                'message' => 'El usuario no tiene permiso para realizar esta accion'
            );
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

    // Metodo que envia el informe
    function enviarInforme(Request $request)
    {
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $idInforme = $request->query('id');
        // Cargar manualmente el registro
        $informeNotarial = InformeNotarial::findOrFail($idInforme);

        // Actualizar con los datos validados
        $informeNotarial->update([
            'estado' => 'No verificado',
            'fecha_envio' => Carbon::now()
        ]);

        switch ($agente->tipo_agente) {
            case 'Notarios de Fe Pública':
                return Redirect::route('informe-notarials.index')
                    ->with('success', 'El informe se envio correctamente');
                break;

            case 'Derechos Reales':
                return Redirect::route('informe-index-derecho.indexDerecho')
                    ->with('success', 'El informe se envio correctamente');
                break;
            case 'Jueces y Secretarios del Tribunal Departamental de Justicia':
                return Redirect::route('informe-index-juzgado.indexJuzgado')
                    ->with('success', 'El informe se envio correctamente');
                break;
            case 'SEPREC':
                return Redirect::route('informe-index-seprec.indexSeprec')
                    ->with('success', 'El informe se envio correctamente');
                break;
        }
    }
}
