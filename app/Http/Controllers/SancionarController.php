<?php

namespace App\Http\Controllers;

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

        // Validar los datos del request
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'agente_id' => 'required',
            'monto' => 'required',
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
}
