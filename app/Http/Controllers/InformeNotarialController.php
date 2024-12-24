<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InformeNotarialRequest;
use App\Models\Agente;
use App\Models\Observacion;
use App\Models\User;
use App\Models\Verificar;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

                $agente = Agente::where('id', $user->agente_id)->first();

                // Crear el objeto usuario para guardar en la base de datos
                $informe = new InformeNotarial();
                $informe->descripcion = $params->descripcion;
                $informe->usuario_id = $user->id;
                $informe->tipo_informe = $agente->tipo_agente;
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

    // Metodo que envia el informe(Aqui enviamos la notificacion en tiempo real)
    function enviarInforme(Request $request)
    {
        $user = Auth::user();
        $agente = Agente::where('id', $user->agente_id)->first();

        $idInforme = $request->query('id');
        // Cargar manualmente el registro
        $informeNotarial = InformeNotarial::findOrFail($idInforme);

        // Enviar mensaje en tiempo real
        /**
         * Paso 1: Enviar el mensaje -> SOCKET.JS
         * Paso 2: SOCKET.JS agregar una condicion en el swich
         * paso 3: Crear un bucle en la vista de menu NavBar en (adminController.php y metodo notificacionReal)
         */
        $mensaje = [
            'remitente' => $agente->persona->nombres . " " . $agente->persona->apellidos,
            'asunto' => 'Envio de informe',
            'idInforme' => $idInforme,
            'tipoNotificacion' => 'envio',
            'tipoAgente' => $agente->tipo_agente,
        ];
        $jsonMensaje = json_encode($mensaje);

        // Esto es para enviar el mensaje en tiempo real a todos los usuarios de tipo Admin de la Gobernación
        $users = User::where('rol', 'Administrador')->get();
        foreach ($users as $user) {
            Http::post('http://localhost:3001/notify-user', [
                'userId' => $user->id,  // ID del usuario destinatario
                'message' => $jsonMensaje,        // Mensaje que recibIRA el cliente
            ]);
        }

        // Cambiar estados segun rol(No esta actualizando)
        if ($user->rol == 'Agente') {
            $informeNotarial->update([
                'envio_agente' => 'Enviado',
                'envio_gober' => 'No enviado',
                'estado_vista' => 'No revizado',
            ]);
        }

        if ($user->rol == 'Administrador') {
            $informeNotarial->update([
                'envio_gober' => 'Enviado',
                'envio_agente' => 'No enviado',
                'estado_vista' => 'No revizado',
            ]);
        }



        // Cambia el estado de la sancion solo cuando esta pediente de envio
        if ($informeNotarial->estado == 'Pendiente') {
            // Determinar si está dentro del plazo(PLAZOS)
            $estaEnPlazo = $this->verificarPlazo($agente->tipo_agente);
            if (!$estaEnPlazo) {
                // dd('No esta en plazo');
                $informeNotarial->update([
                    'estado_sancion' => 'Con sancion',
                ]);
            } else {
                // dd('Esta dentro del plazo');
                $informeNotarial->update([
                    'estado_sancion' => 'Sin sancion',
                ]);
            }
            // FIN Determinar si está dentro del plazo(PLAZOS)
        }


        if ($informeNotarial->estado == 'Rechazado') {
            // Actualizar con los datos validados
            $informeNotarial->update([
                'estado' => 'Corregido'
            ]);
        } else {
            // Actualizar con los datos validados
            $informeNotarial->update([
                'estado' => 'No verificado',
                'fecha_envio' => Carbon::now()
            ]);
        }

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

    /**
     * Verifica si el agente está dentro del plazo permitido.
     */
    private function verificarPlazo($tipoAgente)
    {
        $fechaActual = Carbon::now();

        switch ($tipoAgente) {
            case 'Notarios de Fe Pública':
            case 'Derechos Reales':
            case 'SEPREC':
                // Plazo hasta el día 15 de cada mes
                $fechaLimite = Carbon::now()->startOfMonth()->addDays(15);
                return $fechaActual <= $fechaLimite;

            case 'Jueces y Secretarios del Tribunal Departamental de Justicia':
                // Plazo hasta el 15 del último mes del bimestre
                $mesActual = $fechaActual->month;
                $ultimoMesBimestre = $mesActual % 2 == 0 ? $mesActual : $mesActual + 1;
                $fechaLimite = Carbon::createFromDate($fechaActual->year, $ultimoMesBimestre, 15);
                return $fechaActual <= $fechaLimite;
        }

        return false; // Por defecto, fuera de plazo
    }

    // Metodo verificar informe
    function verificarInforme(Request $request)
    {


        $params = (object) $request->all(); // Devulve un obejto
        $verificar = Verificar::where('informe_id', $params->id)->first(); // Cargar manualmente el registro

        try {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'El informe se verifico correctamente',
                'verificar' => $verificar
            );
        } catch (Exception $e) {
            $data = array(
                'status' => 'Error',
                'code' => 404,
                'message' => $e->getMessage()
            );
        }



        // Devuelve en json con laravel
        return response()->json($data, $data['code']);
    }

    function observarInforme(Request $request)
    {


        $params = (object) $request->all(); // Devulve un obejto
        $observacion = Observacion::where('informe_id', $params->id)->first(); // Cargar manualmente el registro

        try {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'La observación se verifico correctamente',
                'observacion' => $observacion
            );
        } catch (Exception $e) {
            $data = array(
                'status' => 'Error',
                'code' => 404,
                'message' =>  $e
            );
        }



        // Devuelve en json con laravel
        return response()->json($data, $data['code']);
    }
}
