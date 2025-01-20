<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use App\Models\Persona;
use App\Models\Sancion;
use App\Models\Sancion_2;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class SancionarController extends Controller
{

    // SECTOR SANCION COMPLETADA
    public function indexSancion()
    {
        $tipoAgente = "";

        $agentesNotificados = [];

        // Usuario autenticado
        $user = Auth::user();

        if ($user->rol === 'Agente') {

            $sanciones = Sancion_2::where('estado_envio', 'Enviado')->get();

            foreach ($sanciones as $sancion) {

                if ($sancion->agente_id == $user->id) {

                    $agentesNotificados[] = $sancion;
                }
            }
            $tipoAgente = 'Agente';
            $sanciones = $agentesNotificados;
        } else {
            $tipoAgente = 'Administrador';
            $sanciones = Sancion_2::all();
        }
        return view('sanciones.index', compact('sanciones', 'agentesNotificados', 'tipoAgente'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function createSancionNoPresentacion()
    {
        $descripcion = "No presentar información veraz en la forma, lugares y plazos establecidos en la normativa especifica, para los agentes de información";

        // Normal = 1500,00 UFV  
        // seprec=3000,00 UFV

        $userAgentes = User::with('agente.persona')
            ->where('rol', 'Agente')
            ->where('estado', 1)
            ->get();


        // dd($userAgentes);

        $dataSancion = [
            'descripcion' => $descripcion,
            // 'monto' => $monto,
            // 'idUsuarioAgente' => $idUserInforme,
            // 'nameAgenteInforme' => $informe->user->agente->persona->nombres . " " . $informe->user->agente->persona->apellidos,
            // 'tituloInforme' => $informe->descripcion,
            // 'idInforme' => $idInforme,
            // 'dias' => $dias
        ];

        // dd($dataSancion);
        return view('sanciones.create-nopresentacion', compact('dataSancion', 'userAgentes'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }
    public function createSancion($idInforme, $idUserInforme, $tipo, $dias)
    {
        $descripcion = "";
        $monto = "";


        $informe = InformeNotarial::with('user.agente')->where('id', $idInforme)->first();

        // Opcion 2 descripcion
        if ($dias <= 30) {
            $descripcion = 'Presentación de información fuera del plazo establecido, hasta treinta (30) días de vencido el mismo, hasta antes de ser notificados con el acto administrativo de inicio del Sumario Contravencional';
        }

        // Opcion 3 descripcion
        if ($dias > 30) {
            $descripcion = 'Presentación de la información fuera de plazo establecido, en los puntos 3.1 y 3.2, hasta antes de ser notificados con el acto administrativo de inicio del Sumario Contravencional';
        }

        // Montos Opcion 2
        if (($tipo == 'Derechos Reales' || $tipo == 'Notarios de Fe Pública' || $tipo == 'Jueces y Secretarios del Tribunal Departamental de Justicia') && $dias <= 30) {
            $monto = '150,00 UFV';
        }

        if (
            $tipo == 'SEPREC' && $dias <= 30
        ) {
            $monto = '300,00 UFV';
        }

        // Montos Opcion 3
        if (($tipo == 'Derechos Reales' || $tipo == 'Notarios de Fe Pública' || $tipo == 'Jueces y Secretarios del Tribunal Departamental de Justicia') && $dias > 30) {
            $monto = '750,00 UFV';
        }

        if (
            $tipo == 'SEPREC' && $dias > 30
        ) {
            $monto = '1.500,00 UFV';
        }

        $dataSancion = [
            'descripcion' => $descripcion,
            'monto' => $monto,
            'idUsuarioAgente' => $idUserInforme,
            'nameAgenteInforme' => $informe->user->agente->persona->nombres . " " . $informe->user->agente->persona->apellidos,
            'tituloInforme' => $informe->descripcion,
            'idInforme' => $idInforme,
            'dias' => $dias
        ];

        // dd($dataSancion);
        return view('sanciones.create', compact('dataSancion', 'tipo'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function storeSancion(Request $request)
    {
        $user = Auth::user();

        // dd($request->all());

        // Validación
        $validated = $request->validate([
            'nombre' => 'required|string',
            'agente_id' => 'required|integer',
            'monto' => 'required|string',
            'informe' => 'nullable|string',
            'cite_auto_inicial' => 'required|string|max:255',
            'archivo_auto_inicial' => 'required|file|mimes:pdf|max:4048', // Máximo 2MB
        ]);

        // Puedes verificar si el 'informe_id' existe antes de usarlo
        $informe_id = $request->input('informe_id', null); // Devuelve null si no existe

        // Crear una nueva instancia de Sanción
        $saveSancion = new Sancion_2();
        $saveSancion->nombre = $validated['nombre'];
        $saveSancion->agente_id = $validated['agente_id'];
        $saveSancion->informe_id = $validated['informe_id'] ?? null;
        $saveSancion->cite_auto_inicial = $validated['cite_auto_inicial'];
        $saveSancion->monto = $validated['monto'];
        $saveSancion->informe = $validated['informe'] ?? null;
        $saveSancion->usuario_id = $user->id;

        // Subir el archivo con un nombre único
        if ($request->hasFile('archivo_auto_inicial')) {
            $file = $request->file('archivo_auto_inicial');

            // Generar un nombre único para el archivo
            $uniqueFileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento público
            $filePath = $file->storeAs('sanciones', $uniqueFileName, 'public');
            $saveSancion->archivo_auto_inicial = $filePath; // Guardar la ruta del archivo en la base de datos
        }

        $saveSancion->save();


        // Actualizamos el estado del informe
        if (!empty($informe_id)) {

            // dd($informe_id);
            // Solo se ejecuta si 'informe_id' está presente y no es nulo
            $informe = InformeNotarial::where('id', $informe_id)->first();


            if ($informe) { // Verificar si el informe existe
                $informe->estado_plazo_sancion = 'creado';
                $informe->save();
            }
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('sanciones.index')->with('success', 'Sanción creada correctamente.');
    }

    public function editSancion($sansion)
    {
        $sancion = Sancion_2::find($sansion);
        $estadoPago = ['Pendiente', 'Pagado'];
        // 1.- Cargar Agentes
        $agentes = User::with('agente.persona')->where('agente_id', '!=', null)
            ->where('estado', 1)
            ->get();
        return view('sanciones.edit', compact('sancion', 'agentes', 'estadoPago'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function updateSancion(Request $request, $sancion)
    {
        $sancion = Sancion_2::find($sancion);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'agente_id' => 'required',
            'monto' => 'required',
            'estado' => 'required',
        ]);

        $sancion->update($validated);
        return redirect()->route('sanciones.index')->with('success', 'Sanción actualizada correctamente.');
    }

    public function destroySancion($sancion)
    {
        $sancion = Sancion_2::find($sancion);
        $informe = InformeNotarial::where('id', $sancion->informe_id)->first();
        $informe->estado_plazo_sancion = 'Sin crear';
        $informe->save();
        $sancion->delete();
        return redirect()->route('sanciones.index')->with('success', 'Sanción eliminada correctamente.');
    }

    // Metodo que envia la sancion
    public function enviarSancion($sancion, $idAgente)
    {

        // Usuario Autenticado
        $user = Auth::user();
        $persona = Persona::where('id', $user->persona_id)->first();



        $sancionDatos = Sancion_2::find($sancion);

        $sancionDatos->update([
            'estado_envio' => 'Enviado',
        ]);

        // Usuario a quien se le envia la sancion Osea al usuario agente
        $agenteUsuario = User::with('agente.persona')
            ->where('id', $idAgente)->first();


        $mensaje = [
            'remitente' => $persona->nombres . " " . $persona->apellidos,
            'asunto' => 'Sanción por incumplimiento de deberes',
            'tipoSancion' => $sancionDatos->nombre,
            'multa' => $sancionDatos->multa,
            'idSancion' => $sancion,
            'message' => 'Usted ha sido sancionado por ' . $sancionDatos->nombre . ' por un monto de ' . $sancionDatos->multa,
            'tipoNotificacion' => 'sancion',
        ];

        // Convertir el mensaje a JSON
        $jsonMensaje = json_encode($mensaje);

        Http::post('http://localhost:3001/notify-user', [
            'userId' => $agenteUsuario->id,  // ID del usuario destinatario
            'message' => $jsonMensaje,        // Mensaje que recibirá el cliente
        ]);

        return Redirect::route('sanciones.index')
            ->with('success', 'Sanción Enviada Correctamente');
    }

    public function showSancion($id)
    {
        $informe = null;
        $sancion = Sancion_2::find($id);

        $usuario = User::with('agente.persona')->where('id', $sancion->agente_id)->first();

        if ($sancion->informe_id != null) {
            $informe = InformeNotarial::with('user.agente')->where('id', $sancion->informe_id)->first();
        }

        // dd($informe);

        $sancion->update(
            ['estado_vista' => 'Revizado']
        );
        return view('sanciones.show', compact('sancion', 'informe', 'usuario'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    function getInformeSanciones(Request $request)
    {

        $params = (object) $request->all(); // Devulve un obejto

        $idUsuario = $params->usuario_id;


        // Sacamos los informes de un agente en especifico
        $informes = InformeNotarial::with('user.agente.persona')
            ->where('usuario_id', $idUsuario)
            ->where('estado', 'Verificado')
            ->orderBy('created_at', 'desc')
            ->get();

        try {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'informes' => $informes
            );
        } catch (Exception $e) {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'error' => $e->getMessage(),
            );
        }
        return response()->json(
            $data,
            $data['code']
        );
    }

    public function comprobantePago(Request $request)
    {

        $user = Auth::user();


        // Validar la solicitud
        $request->validate([
            'id' => 'required|exists:sanciones,id',
            'documento_pago' => 'required|file|mimes:pdf,jpg,jpeg,png|max:9048',
        ]);

        try {
            // Obtener la sanción correspondiente
            $sancion = Sancion_2::findOrFail($request->id);

            // Subir el archivo con un nombre único
            $archivo = $request->file('documento_pago');
            $nombreArchivo = time() . '.' . $archivo->getClientOriginalExtension();
            $archivo->storeAs('uploads/comprobantes', $nombreArchivo, 'public');


            // Actualizar el registro en la base de datos
            $sancion->update([
                'documento_pago' => $nombreArchivo,
                // 'estado_envio' => 'No enviado',
                'envio_pago' => 'Enviado'
            ]);

            // Enviar mensaje en tiempo real
            /**
             * Paso 1: Enviar el mensaje -> SOCKET.JS
             * Paso 2: SOCKET.JS agregar una condicion en el swich
             * paso 3: Crear un bucle en la vista de menu NavBar en (adminController.php y metodo notificacionReal)
             */
            $mensaje = [
                'remitente' => $user->agente->persona->nombres . " " . $user->agente->persona->apellidos,
                'asunto' => 'Comprobante de pago',
                'idSancion' => $request->id,
                'tipoNotificacion' => 'pago',
                'tipoAgente' => $user->agente->tipo_agente
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

            // Redirigir a index con un mensaje dexito
            return redirect()->route('sanciones.index')->with('success', 'Comprobante de pago guardado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocurrió un error al guardar el comprobante']);
        }
    }
}
