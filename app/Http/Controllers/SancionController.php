<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SancionRequest;
use App\Models\Agente;
use App\Models\DerechosReale;
use App\Models\Empresa;
use App\Models\InformeNotarial;
use App\Models\NotaryRecord;
use App\Models\Observacion;
use App\Models\SentenciasJudiciale;
use App\Models\TipoSancion;
use App\Models\User;
use App\Models\Verificar;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Pusher\Pusher;
use Illuminate\Support\Facades\Http;

class SancionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sancions = Sancion::all();

        return view('sancion.index', compact('sancions'));
    }

    public function indexBandejaEntrada(Request $request, $id): View
    {

        $derechosReales = [];
        $sentenciasJudiciales = [];
        $notarial = [];
        $empresas = [];


        $informes = InformeNotarial::with('user')->where('estado', 'No verificado')
            ->orWhere('estado', 'Verificado')
            ->orWhere('estado', 'Rechazado')
            ->orWhere('estado', 'Corregido')
            ->get();

        if ($id != 'bandeja' && $informes->count() > 0) {


            foreach ($informes as $key => $value) {
                $usuarios[$key] = User::where('id', $value->usuario_id)->first();
            }

            foreach ($usuarios as $key => $value) {
                $agentes[$key] = Agente::where('id', $value->agente_id)->first();
            }

            foreach ($informes as $key => $value) {
                if ($agentes[$key]->tipo_agente == 'SEPREC') {
                    array_push($empresas, $value);
                }
                if ($agentes[$key]->tipo_agente == 'Notarios de Fe Pública') {
                    array_push($notarial, $value);
                }
                if ($agentes[$key]->tipo_agente == 'Derechos Reales') {
                    array_push($derechosReales, $value);
                }
                if ($agentes[$key]->tipo_agente == 'Jueces y Secretarios del Tribunal Departamental de Justicia') {
                    array_push($sentenciasJudiciales, $value);
                }
            }
        }


        switch ($id) {
            case 'Derechos Reales':
                $informe = [];
                $informes = $derechosReales;
                return view('sancion.lista-recibidos', compact('informes', 'id'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada', 'lista' => 'Derechos Reales']);
                break;
            case 'Jueces y Secretarios del Tribunal Departamental de Justicia':
                $informe = [];
                $informes = $sentenciasJudiciales;
                return view('sancion.lista-recibidos', compact('informes', 'id'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada', 'lista' => 'Jueces y Secretarios del Tribunal Departamental de Justicia']);
                break;
            case 'Notarios de Fe Pública':
                $informe = [];
                $informes = $notarial;
                return view('sancion.lista-recibidos', compact('informes', 'id'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada', 'lista' => 'Notarios de Fe Pública']);
                break;
            case 'SEPREC':
                $informe = [];
                $informes = $empresas;
                return view('sancion.lista-recibidos', compact('informes', 'id'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada', 'lista' => 'SEPREC']);
                break;
            case 'bandeja':
                return view('sancion.lista-recibidos', compact('informes', 'id'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada', 'lista' => 'Lista General']);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sancion = new Sancion();

        return view('sancion.create', compact('sancion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SancionRequest $request): RedirectResponse
    {
        Sancion::create($request->validated());

        return Redirect::route('sancions.index')
            ->with('success', 'Sancion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sancion = Sancion::find($id);

        return view('sancion.show', compact('sancion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sancion = Sancion::find($id);

        return view('sancion.edit', compact('sancion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SancionRequest $request, Sancion $sancion): RedirectResponse
    {
        $sancion->update($request->validated());

        return Redirect::route('sancions.index')
            ->with('success', 'Sancion updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Sancion::find($id)->delete();

        return Redirect::route('sancions.index')
            ->with('success', 'Sancion deleted successfully');
    }

    function indexVerificar($idInforme, $idUser, $tipo): View
    {

        $usuario = User::where('id', $idUser)->first();
        $agente = Agente::where('id', $usuario->agente_id)->first();


        switch ($agente->tipo_agente) {
            case 'SEPREC':

                $empresas = Empresa::where('informe_id', $idInforme)->orderBy('id', 'desc')->get();

                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $idInforme)->first();

                return view('sancion.verificar-empresas', compact('empresas',  'informe', 'idInforme', 'idUser', 'tipo'), ['titulo' => 'Verificación de información SEPREC', 'currentPage' => 'Verificación SEPREC']);

                break;
            case 'Jueces y Secretarios del Tribunal Departamental de Justicia':

                $sentenciasJudiciales = SentenciasJudiciale::where('informe_id', $idInforme)->orderBy('id', 'desc')->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $idInforme)->first();
                return view('sancion.verificar-juzgados', compact('sentenciasJudiciales', 'idInforme', 'informe', 'idUser', 'tipo'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);

                break;
            case 'Derechos Reales':

                $derechosReales = DerechosReale::where('informe_id', $idInforme)->orderBy('id', 'desc')->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $idInforme)->first();
                return view('sancion.verificar-derechos', compact('derechosReales', 'idInforme', 'informe', 'idUser', 'tipo'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);

                break;
            case 'Notarios de Fe Pública':

                $notaryRecords = NotaryRecord::where('informe_id', $idInforme)->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $idInforme)->first();
                return view('sancion.verificar-notarios', compact('notaryRecords', 'idInforme', 'informe', 'idUser', 'tipo'), ['titulo' => 'Gestión de Informe Notarios', 'currentPage' => 'Informe']);

                break;
            default:
                return Redirect::route('admin.layaouts.master');
                break;
        }
    }

    public function storeVerificar(Request $request)
    {
        $params = $request->all(); // Convierte a objeto
        $user = Auth::user();

        if ($user->rol == 'Agente') {
            return response()->json([
                'status' => 'Error',
                'code' => 403,
                'message' => 'El usuario no tiene permiso para realizar esta acción'
            ], 403);
        }

        $validate = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'verificacion-seprec' => 'required|file|max:9048', // Validar archivo PDF
            'informe_id' => 'required',
            'tipo_informacion' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'Error',
                'code' => 400,
                'message' => 'Los datos enviados no son correctos',
                'errors' => $validate->errors()
            ], 400);
        }

        try {

            // Obtener el nombre original y generar un nombre único
            $originalName = $request->file('verificacion-seprec')->getClientOriginalName();
            $uniqueName = uniqid() . '_' . $originalName;

            // Mover el archivo a la carpeta "verificaciones" dentro de public/
            $request->file('verificacion-seprec')->move(public_path('verificaciones'), $uniqueName);

            $verificar = new Verificar();
            $verificar->descripcion = $params['descripcion'];
            $verificar->usuario_id = $user->id; // ID del usuario autenticado
            $verificar->tipo_informe = $params['tipo_informacion'];
            $verificar->certificado = $uniqueName; // Nombre del archivo
            $verificar->informe_id = $params['informe_id'];
            $verificar->save();


            $informe = InformeNotarial::find($params['informe_id']);
            $informe->estado = 'Verificado';
            $informe->save();



            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'El informe se verifico correctamente',
                'informe' => $verificar
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Error',
                'code' => 500,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function storeObservacion(Request $request)
    {
        $params = $request->all(); // Convierte a objeto
        $user = Auth::user();

        if ($user->rol == 'Agente') {
            return response()->json([
                'status' => 'Error',
                'code' => 403,
                'message' => 'El usuario no tiene permiso para realizar esta acción'
            ], 403);
        }

        $validate = Validator::make($request->all(), [
            'descripcion-informe-observar' => 'required|string',
            'observacion-seprec' => 'required|file|max:9048', // Validar archivo PDF
            'informe_id' => 'required',
            'tipo_informacion' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'Error',
                'code' => 400,
                'message' => 'Los datos enviados no son correctos',
                'errors' => $validate->errors()
            ], 400);
        }

        try {

            // Obtener el nombre original y generar un nombre único
            $originalName = $request->file('observacion-seprec')->getClientOriginalName();
            $uniqueName = uniqid() . '_' . $originalName;

            // Mover el archivo a la carpeta "verificaciones" dentro de public/
            $request->file('observacion-seprec')->move(public_path('observaciones'), $uniqueName);

            $observacion = new Observacion();
            $observacion->descripcion = $params['descripcion-informe-observar'];
            $observacion->usuario_id = $user->id; // ID del usuario autenticado
            $observacion->tipo_informe = $params['tipo_informacion'];
            $observacion->archivo_observacion = $uniqueName; // Nombre del archivo
            $observacion->informe_id = $params['informe_id'];
            $observacion->save();


            $informe = InformeNotarial::find($params['informe_id']);
            $informe->estado = 'Rechazado';
            $informe->save();


            // Enviar mensaje en tiempo real
            /**
             * Paso 1: Enviar el mensaje -> SOCKET.JS
             * Paso 2: SOCKET.JS agregar una condicion en el swich
             * paso 3: Crear un bucle en la vista de menu NavBar en (adminController.php y metodo notificacionReal)
             */
            $mensaje = [
                'remitente' => $user->persona->nombres . " " . $user->persona->apellidos,
                'asunto' => 'Observacion al informe',
                'idInforme' => $informe->id,
                'tipoNotificacion' => 'observacion',
                'tipoAgente' => 'Administrador',
            ];
            $jsonMensaje = json_encode($mensaje);

            // Esto es para enviar el mensaje en tiempo real a agente observado
            Http::post('http://localhost:3001/notify-user', [
                'userId' => $informe->usuario_id,  // ID del usuario destinatario
                'message' => $jsonMensaje,        // Mensaje que recibIRA el cliente
            ]);




            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'La observación fue enviada correctamente',
                'informe' => $observacion
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Error',
                'code' => 500,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function indexObservacion(Request $request)
    {
        $params = $request->all(); // devuelve un array
        $user = Auth::user();


        try {

            $observacion = Observacion::where('informe_id', $params['informe_id'])->orderBy('id', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Lista de observaciones cargada correctamente',
                'observacion' => $observacion
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Error',
                'code' => 500,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
