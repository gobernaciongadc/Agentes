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

    public function createSancion()
    {
        // 1.- Cargar Agentes
        $agentes = User::with('agente.persona')->where('agente_id', '!=', null)
            ->where('estado', 1)
            ->get();

        return view('sanciones.create', compact('agentes'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function storeSancion(Request $request)
    {
        $user = Auth::user();

        $params = (object) $request->all();

        // Validar los datos del request
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'agente_id' => 'required',
            'monto' => 'required',
            'informe_id' => 'required',
            // Nota: Ya no validamos 'usuario_id' porque se asignará automáticamente
        ]);

        // Agregar el usuario autenticado al arreglo de datos
        $validated['usuario_id'] = $user->id;

        // Crear la sanción
        Sancion_2::create($validated);

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
        $sancion = Sancion_2::find($id);
        $sancion->update(
            ['estado_vista' => 'Revizado']
        );
        return view('sanciones.show', compact('sancion'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
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
