<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ComunicadoRequest;
use App\Models\Agente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tipoAgente = "";

        // Usuario autenticado
        $user = Auth::user();

        if ($user->rol === 'Agente') {
            $agente = Agente::where('id', $user->agente_id)->first();
            $tipoAgente = 'Agente';
            $comunicados = Comunicado::where('destinatario', $agente->tipo_agente)->get();
        } else {

            $tipoAgente = 'Administrador';
            $comunicados = Comunicado::all();
        }

        return view('comunicado.index', compact('comunicados', 'tipoAgente'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $comunicado = new Comunicado();
        $tipoAgentes = ['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales'];

        return view('comunicado.create', compact('comunicado', 'tipoAgentes'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComunicadoRequest $request): RedirectResponse
    {

        // Usuario autenticado
        $user = Auth::user();

        $data = $request->validated(); // Obtiene los datos validados
        $data['fecha_emision'] = now(); // Agrega la fecha actual
        $data['usuario_id'] = $user->id; // Agrega la fecha actual

        // Verificar si se subió un archivo
        if ($request->hasFile('adjuntos')) {
            $archivo = $request->file('adjuntos');

            // Generar un nombre único para el archivo
            $nombreArchivo = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
            // Guardar el archivo en el almacenamiento (puedes usar 'public' o cualquier disk configurado)
            $rutaArchivo = $archivo->storeAs('comunicados', $nombreArchivo, 'public');

            // Guardar el nombre del archivo en los datos
            $data['adjuntos'] = $nombreArchivo;
        }

        $comunicado = Comunicado::create($data);

        // Enviar mensaje en tiempo real
        /**
         * Paso 1: Enviar el mensaje -> SOCKET.JS
         * Paso 2: SOCKET.JS agregar una condicion en el swich
         * paso 3: Crear un bucle en la vista de menu NavBar en (adminController.php y metodo notificacionReal)
         */
        $mensaje = [
            'remitente' => $user->persona->nombres . " " . $user->persona->apellidos,
            'asunto' => 'Comunicado',
            'idComunicado' => $comunicado->id,
            'tipoNotificacion' => 'comunicado',
            'tipoAgente' => $user->rol
        ];
        $jsonMensaje = json_encode($mensaje);

        // Esto es para enviar el mensaje en tiempo real a todos los usuarios de tipo Admin de la Gobernación
        $usuarios = User::where('rol', 'Agente')->get();
        foreach ($usuarios as $usuario) {

            if ($usuario->agente->tipo_agente == $comunicado->destinatario) {
                Http::post('http://localhost:3001/notify-user', [
                    'userId' => $usuario->id,  // ID del usuario destinatario
                    'message' => $jsonMensaje,        // Mensaje que recibIRA el cliente
                ]);
            }
        }

        return Redirect::route('comunicados.index')
            ->with('success', 'Comunicado creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $comunicado = Comunicado::find($id);

        return view('comunicado.show', compact('comunicado'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $comunicado = Comunicado::find($id);

        return view('comunicado.edit', compact('comunicado'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComunicadoRequest $request, Comunicado $comunicado): RedirectResponse
    {
        $comunicado->update($request->validated());

        return Redirect::route('comunicados.index')
            ->with('success', 'Comunicado updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Comunicado::find($id)->delete();

        return Redirect::route('comunicados.index')
            ->with('success', 'Comunicado deleted successfully');
    }
}
