<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InformeNotarialRequest;
use App\Models\Agente;
use App\Models\DerechosReale;
use App\Models\Empresa;
use App\Models\NotaryRecord;
use App\Models\Observacion;
use App\Models\Periodo;
use App\Models\PeriodoBimestral;
use App\Models\SentenciasJudiciale;
use App\Models\User;
use App\Models\Verificar;
use Carbon\Carbon;
use Dompdf\Dompdf;
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

        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();

        foreach ($informeNotarials as $informe) {
            $informe->notarios = NotaryRecord::where('usuario_id', $user->id)
                ->where('informe_id', $informe->id)
                ->get();
        }

        // Periodos
        $periodos = Periodo::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();

        return view('informe-notarial.index', compact('informeNotarials', 'agente', 'periodos'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    public function indexSeprec(Request $request, $id = null): View
    {

        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();

        foreach ($informeNotarials as $informe) {
            $informe->notarios = Empresa::where('usuario_id', $user->id)
                ->where('informe_id', $informe->id)
                ->get();
        }
        // Periodos
        $periodos = Periodo::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();
        return view('informe-notarial.index_notario', compact('informeNotarials', 'agente', 'periodos'), ['titulo' => 'Gestión de Información de Empresas SEPREC', 'currentPage' => 'Informe de Empresas']);
    }

    public function indexJuzgado(Request $request, $id = null): View
    {

        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();
        foreach ($informeNotarials as $informe) {
            $informe->notarios = SentenciasJudiciale::where('usuario_id', $user->id)
                ->where('informe_id', $informe->id)
                ->get();
        }

        // Periodos Bimestrales
        $periodos = PeriodoBimestral::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();
        return view('informe-notarial.index_juzgado', compact('informeNotarials', 'agente', 'periodos'), ['titulo' => 'Gestión de Información de Setratarios y Juzgados', 'currentPage' => 'Informe Juzgados']);
    }

    public function indexDerecho(Request $request, $id = null): View
    {

        // Obtener el usuario autenticado
        $user = Auth::user();

        $agente = Agente::where('id', $user->agente_id)->first();

        $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();
        foreach ($informeNotarials as $informe) {
            $informe->notarios = DerechosReale::where('usuario_id', $user->id)
                ->where('informe_id', $informe->id)
                ->get();
        }
        // Periodos
        $periodos = Periodo::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();
        return view('informe-notarial.index_derechos', compact('informeNotarials', 'agente', 'periodos'), ['titulo' => 'Gestión de Información de Derechos Reales', 'currentPage' => 'Informe Derechos Reales']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        $informeNotarial = new InformeNotarial();

        return view('informe-notarial.create', compact('informeNotarial'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);
    }

    function convertirFecha($year, $periodo)
    {
        // Mapeo de los nombres de los meses a sus respectivos números
        $meses = [
            'Enero' => 1,
            'Febrero' => 2,
            'Marzo' => 3,
            'Abril' => 4,
            'Mayo' => 5,
            'Junio' => 6,
            'Julio' => 7,
            'Agosto' => 8,
            'Septiembre' => 9,
            'Octubre' => 10,
            'Noviembre' => 11,
            'Diciembre' => 12,
        ];

        // Validar que el mes exista
        if (array_key_exists($periodo, $meses)) {
            // Crear la fecha con el primer día del mes
            $fecha = Carbon::create($year, $meses[$periodo], 15);

            // Mostrar la fecha (por ejemplo: "2024-01-01")
            return $fecha->toDateString(); // Retorna la fecha como "YYYY-MM-DD"
        }

        // Si el mes no es válido, devolver null o algún valor de error
        return null;
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

                if ($agente->tipo_agente == 'Jueces y Secretarios del Tribunal Departamental de Justicia') {
                    // Converir  year=2024 , periodo=Enero  auna fecha valida sin los dias

                    $periodo = $params->periodo;
                    $partes = explode('-', $periodo);
                    $despuesDelGuion = trim($partes[1]); // Elimina espacios en blanco adicionales

                    $fecha = $this->convertirFecha($params->year, $despuesDelGuion);

                    // Crear el objeto usuario para guardar en la base de datos
                    $informe = new InformeNotarial();
                    $informe->descripcion = $params->descripcion;
                    $informe->year = $params->year;
                    $informe->periodo = $params->periodo;
                    $informe->periodo_date = $fecha;
                    $informe->usuario_id = $user->id;
                    $informe->tipo_informe = $agente->tipo_agente;
                    try {

                        $informe->save();

                        // Modificar estado de periodos  a usuado
                        switch (strtolower($despuesDelGuion)) {
                            case 'febrero':
                                $periodo = PeriodoBimestral::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->enero_febrero = 'no disponible';
                                $periodo->save();
                                break;
                            case 'abril':
                                $periodo = PeriodoBimestral::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->marzo_abril = 'no disponible';
                                $periodo->save();
                                break;
                            case 'junio':
                                $periodo = PeriodoBimestral::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->mayo_junio = 'no disponible';
                                $periodo->save();
                                break;
                            case 'agosto':
                                $periodo = PeriodoBimestral::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->julio_agosto = 'no disponible';
                                $periodo->save();
                                break;
                            case 'octubre':
                                $periodo = PeriodoBimestral::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->septiembre_octubre = 'no disponible';
                                $periodo->save();
                                break;
                            case 'diciembre':
                                $periodo = PeriodoBimestral::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->noviembre_diciembre = 'no disponible';
                                $periodo->save();
                                break;
                        }

                        // Obtener el informe con el id del nuevo registro                 
                        $getInforme = InformeNotarial::with('user.agente')->where('id', $informe->id)->where('usuario_id', $user->id)->first();



                        // OJO verificar(CREO QUE YA NO SE USA)
                        $getInforme->notarios = NotaryRecord::where('usuario_id', $user->id)
                            ->where('informe_id', $informe->id)
                            ->get();

                        // Obtener el agente que esta creando el informe
                        $getAgente = Agente::find($user->agente_id);


                        $data = array(
                            'status' => 'success',
                            'code' => 200,
                            'message' => 'El informe notarial se ha creado correctamente',
                            'informe'  => $getInforme, //no necesita
                            'agente' => $getAgente,
                            'periodo' => 'Soy david'
                        );
                    } catch (Exception $e) {
                        $data = array(
                            'status' => 'Error',
                            'code' => 404,
                            'message' => $e
                        );
                    }
                } else {
                    // Converir  year=2024 , periodo=Enero  auna fecha valida sin los dias
                    $fecha = $this->convertirFecha($params->year, $params->periodo);

                    // Crear el objeto usuario para guardar en la base de datos
                    $informe = new InformeNotarial();
                    $informe->descripcion = $params->descripcion;
                    $informe->year = $params->year;
                    $informe->periodo = $params->periodo;
                    $informe->periodo_date = $fecha;
                    $informe->usuario_id = $user->id;
                    $informe->tipo_informe = $agente->tipo_agente;
                    try {

                        $informe->save();

                        // Modificar estado de periodos  a usuado
                        switch (strtolower($params->periodo)) {
                            case 'enero':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->enero = 'no disponible';
                                $periodo->save();
                                break;
                            case 'febrero':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->febrero = 'no disponible';
                                $periodo->save();
                                break;
                            case 'marzo':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->marzo = 'no disponible';
                                $periodo->save();
                                break;
                            case 'abril':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->abril = 'no disponible';
                                $periodo->save();

                                break;
                            case 'mayo':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->mayo = 'no disponible';
                                $periodo->save();
                                break;
                            case 'junio':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->junio = 'no disponible';
                                $periodo->save();
                                break;
                            case 'julio':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->julio = 'no disponible';
                                $periodo->save();
                                break;
                            case 'agosto':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->agosto = 'no disponible';
                                $periodo->save();
                                break;
                            case 'septiembre':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->septiembre = 'no disponible';
                                $periodo->save();
                                break;
                            case 'octubre':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->octubre = 'no disponible';
                                $periodo->save();
                                break;
                            case 'noviembre':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->noviembre = 'no disponible';
                                $periodo->save();
                                break;
                            case 'diciembre':
                                $periodo = Periodo::where('usuario_id', $user->id)
                                    ->where('year', $params->year)
                                    ->first();
                                $periodo->diciembre = 'no disponible';
                                $periodo->save();
                                break;
                        }

                        // Obtener el informe con el id del nuevo registro                 
                        $getInforme = InformeNotarial::with('user.agente')->where('id', $informe->id)->where('usuario_id', $user->id)->first();



                        // OJO verificar(CREO QUE YA NO SE USA)
                        $getInforme->notarios = NotaryRecord::where('usuario_id', $user->id)
                            ->where('informe_id', $informe->id)
                            ->get();

                        // Obtener el agente que esta creando el informe
                        $getAgente = Agente::find($user->agente_id);


                        $data = array(
                            'status' => 'success',
                            'code' => 200,
                            'message' => 'El informe notarial se ha creado correctamente',
                            'informe'  => $getInforme, //no necesita
                            'agente' => $getAgente,
                            'periodo' => 'Soy david'
                        );
                    } catch (Exception $e) {
                        $data = array(
                            'status' => 'Error',
                            'code' => 404,
                            'message' => $e
                        );
                    }
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
        $usuarios = User::where('rol', 'Administrador')->get();
        foreach ($usuarios as $usuario) {
            Http::post('http://localhost:3001/notify-user', [
                'userId' => $usuario->id,  // ID del usuario destinatario
                'message' => $jsonMensaje,        // Mensaje que recibIRA el cliente
            ]);
        }


        // Cambiar estados segun rol
        if ($user->rol == 'Agente') {
            $informeNotarial->update([
                'envio_agente' => 'Enviado',
                'envio_gober' => 'No enviado',
                'estado_vista' => 'No revizado',
            ]);
        }

        // Esto es cuando envia desde un admin a un agente(ojo nuncaa va a entrar aqui)
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
            $cantidadDias = $this->verificarPlazo($agente->tipo_agente, $informeNotarial->periodo_date, $informeNotarial->fecha_envio);

            $informeNotarial->dias_retrazo = $cantidadDias;
            $informeNotarial->save();

            if ($cantidadDias > 0) {
                $informeNotarial->update([
                    'estado_sancion' => 'Con sancion'
                ]);
            } else {
                // dd('Esta dentro del plazo');
                $informeNotarial->update([
                    'estado_sancion' => 'Sin sancion'
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
    private function verificarPlazo($tipoAgente, $periodoEnvio, $fechaEnvio)
    {
        $fechaActual = Carbon::parse($fechaEnvio);
        // $fechaEnvio //2025-01-03 19:19:20
        switch ($tipoAgente) {
            case 'Notarios de Fe Pública':
                $fechaActual = Carbon::parse($fechaEnvio);
                $fechaEnvio = Carbon::parse($periodoEnvio);
                // Obtener el siguiente mes y fijar el día al primero
                // $primerDiaSiguienteMes = $fechaEnvio->copy()->addMonth()->startOfMonth();
                $primerDiaSiguienteMes = $fechaEnvio->copy()->addDay(); // Sumar un día
                // Calcular la diferencia con signo
                $diferenciaEnDias = $primerDiaSiguienteMes->floatDiffInDays($fechaActual, false);
                // Truncar siempre hacia arriba
                $cantidadDias = ceil($diferenciaEnDias);

                return $cantidadDias;
            case 'Derechos Reales':
                $fechaActual = Carbon::parse($fechaEnvio);
                $fechaEnvio = Carbon::parse($periodoEnvio);
                // Obtener el siguiente mes y fijar el día al primero
                $primerDiaSiguienteMes = $fechaEnvio->copy()->addDay(); // Sumar un día
                // Calcular la diferencia con signo
                $diferenciaEnDias = $primerDiaSiguienteMes->floatDiffInDays($fechaActual, false);
                // Truncar siempre hacia arriba
                $cantidadDias = ceil($diferenciaEnDias);

                // dd($fechaActual, $fechaEnvio, $primerDiaSiguienteMes, $cantidadDias);

                return $cantidadDias;
            case 'SEPREC':
                $fechaActual = Carbon::parse($fechaEnvio);
                $fechaEnvio = Carbon::parse($periodoEnvio);
                // Obtener el siguiente mes y fijar el día al primero
                $primerDiaSiguienteMes = $fechaEnvio->copy()->addDay(); // Sumar un día
                // Calcular la diferencia con signo
                $diferenciaEnDias = $primerDiaSiguienteMes->floatDiffInDays($fechaActual, false);
                // Truncar siempre hacia arriba
                $cantidadDias = ceil($diferenciaEnDias);

                return $cantidadDias;
            case 'Jueces y Secretarios del Tribunal Departamental de Justicia':
                // Plazo hasta el 15 del último mes del bimestre

                $fechaActual = Carbon::parse($fechaEnvio);
                $fechaEnvio = Carbon::parse($periodoEnvio);
                // Obtener el siguiente mes y fijar el día al primero
                // $primerDiaSiguienteMes = $fechaEnvio->copy()->addMonth()->startOfMonth();
                $primerDiaSiguienteMes = $fechaEnvio->copy()->addDay(); // Sumar un día
                // Calcular la diferencia con signo
                $diferenciaEnDias = $primerDiaSiguienteMes->floatDiffInDays($fechaActual, false);
                // Truncar siempre hacia arriba
                $cantidadDias = ceil($diferenciaEnDias);

                return $cantidadDias;
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

    function pdfCertificado($id)
    {
        $verificacion = Verificar::where('informe_id', $id)->first();
        $certificado = json_decode($verificacion->certificado);

        // dd($certificado);

        // Generar el PDF
        $dompdf = new Dompdf();
        $html = view('pdf.certificado', compact('verificacion', 'certificado'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();

        // Retornar el contenido del PDF para mostrar en el navegador
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="certificado.pdf"');
    }
}
