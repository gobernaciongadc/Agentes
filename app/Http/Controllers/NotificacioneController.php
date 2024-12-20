<?php

namespace App\Http\Controllers;

use App\Models\Notificacione;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\NotificacioneRequest;
use App\Models\Agente;
use App\Models\Persona;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NotificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tipoAgente = "";

        $agentesNotificados = [];

        // Usuario autenticado
        $user = Auth::user();

        if ($user->rol === 'Agente') {

            $notificaciones = Notificacione::all();



            foreach ($notificaciones as $notificacion) {

                if (json_decode($notificacion->destinatario)->idUsuario == $user->id) {

                    $agentesNotificados[] = $notificacion;
                }
            }

            $tipoAgente = 'Agente';
        } else {

            $tipoAgente = 'Administrador';
            $notificaciones = Notificacione::all();
        }
        return view('notificacione.index', compact('notificaciones', 'tipoAgente', 'agentesNotificados'), ['titulo' => 'Gestión de Notificaciones', 'currentPage' => 'Notificaciones']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $notificacione = new Notificacione();

        $usuarios = User::with('agente')->where('rol', 'Agente')->where('estado', 1)->get();

        return view('notificacione.create', compact('notificacione', 'usuarios'), ['titulo' => 'Gestión de Notificaciones', 'currentPage' => 'Notificaciones']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificacioneRequest $request): RedirectResponse
    {
        // Usuario autenticado
        $user = Auth::user();

        $data = $request->validated(); // Obtiene los datos validados
        $data['fecha_emision'] = now(); // Agrega la fecha actual
        $data['usuario_id'] = $user->id; // Agregar al usuario autenticado


        // Verificar si se subió un archivo
        if ($request->hasFile('adjuntos')) {
            $archivo = $request->file('adjuntos');

            // Generar un nombre único para el archivo
            $nombreArchivo = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
            // Guardar el archivo en el almacenamiento (puedes usar 'public' o cualquier disk configurado)
            $rutaArchivo = $archivo->storeAs('notificaciones', $nombreArchivo, 'public');

            // Guardar el nombre del archivo en los datos
            $data['adjuntos'] = $nombreArchivo;
        }

        $destinatario = json_decode($data['destinatario']);

        $persona = Persona::find($user->persona_id);

        $destinatarioID = $destinatario->idUsuario;



        // Envía la solicitud POST al servidor de WebSocket
        try {
            $notificacione = Notificacione::create($data);
            $mensaje = [
                'remitente' => $persona->nombres . " " . $persona->apellidos,
                'asunto' => $data['asunto'],
                'idNotificacion' => $notificacione->id,
                'tipoNotificacion' => 'notificacion',

            ];
            $jsonMensaje = json_encode($mensaje);
            Http::post('http://localhost:3001/notify-user', [
                'userId' => $destinatarioID,  // ID del usuario destinatario
                'message' => $jsonMensaje,        // Mensaje que recibirá el cliente
            ]);
        } catch (Exception $e) {
            // Maneja errores en la conexión
            Log::error("Error al enviar la notificación: {$e->getMessage()}");
        }

        return Redirect::route('notificaciones.index')
            ->with('success', 'Notificación creada y enviada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {

        $notificacione = Notificacione::find($id);

        $notificacione->update(
            ['estado' => 'Revizado']
        );
        return view('notificacione.show', compact('notificacione'), ['titulo' => 'Gestión de Notificaciones', 'currentPage' => 'Notificaciones']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $notificacione = Notificacione::find($id);
        return view('notificacione.edit', compact('notificacione'), ['titulo' => 'Gestión de Notificaciones', 'currentPage' => 'Notificaciones']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotificacioneRequest $request, Notificacione $notificacione): RedirectResponse
    {
        $notificacione->update($request->validated());

        return Redirect::route('notificaciones.index')
            ->with('success', 'Notificacione updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Notificacione::find($id)->delete();

        return Redirect::route('notificaciones.index')
            ->with('success', 'Notificacione deleted successfully');
    }
}
