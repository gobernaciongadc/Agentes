<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\DerechosReale;
use App\Models\Empresa;
use App\Models\InformeNotarial;
use App\Models\NotaryRecord;
use App\Models\Notificacione;
use App\Models\SentenciasJudiciale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function master()
    {
        $usuarios = [];
        $agentes = [];
        // Contadores
        $totalDerechosReales = 0;
        $totalSentenciasJudiciales = 0;
        $totalNotarial = 0;
        $totalEmpresas = 0;

        $informeNotarial = InformeNotarial::where('estado', 'Verificado')
            ->orwhere('estado', 'No verificado')
            ->orwhere('estado', 'Rechazado')
            ->orwhere('estado', 'Corregido')
            ->get();

        foreach ($informeNotarial as $key => $value) {
            $usuarios[$key] = User::where('id', $value->usuario_id)->first();
        }

        foreach ($usuarios as $key => $value) {
            $agentes[$key] = Agente::where('id', $value->agente_id)->first();
        }

        foreach ($agentes as $key => $value) {
            if ($value->tipo_agente == 'SEPREC') {
                $totalEmpresas++;
            }
            if ($value->tipo_agente == 'Notarios de Fe Pública') {
                $totalNotarial++;
            }
            if ($value->tipo_agente == 'Derechos Reales') {
                $totalDerechosReales++;
            }
            if ($value->tipo_agente == 'Jueces y Secretarios del Tribunal Departamental de Justicia') {
                $totalSentenciasJudiciales++;
            }
        }

        return view('admin.layouts.master', [
            'currentPage' => 'Dashboard',
            'titulo' => 'Panel de Control',
            'showPanel' => true,  // Variable para controlar la inclusión
            'totales' => [
                'derechosReales' => $totalDerechosReales,
                'sentenciasJudiciales' => $totalSentenciasJudiciales,
                'informeNotarial' => $totalNotarial,
                'empresas' => $totalEmpresas,
            ]
        ]);
    }

    function notificacionReal()
    {
        // Logica para sacar las notificaciones
        $tipoAgente = "";

        $agentesNotificados = [];

        // Usuario autenticado
        $user = Auth::user();

        if ($user->rol === 'Agente') {

            $notificaciones = Notificacione::with('user.persona')->where('estado', 'No revizado')
                ->orderBy('id', 'desc')->get();

            foreach ($notificaciones as $notificacion) {

                if (json_decode($notificacion->destinatario)->idUsuario == $user->id) {

                    $agentesNotificados[] = $notificacion;
                }
            }
            $tipoAgente = 'Agente';

            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Lista de notificaciones cargada correctamente',
                'notificaciones' => $agentesNotificados,
                'tipoAgente' => $tipoAgente,
                'totalNotificaciones' => count($agentesNotificados)

            );
        } else {

            $tipoAgente = 'Administrador';
            $notificaciones = Notificacione::all();

            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Lista de notificaciones cargada correctamente',
                'notificaciones' => $agentesNotificados,
                'tipoAgente' => $tipoAgente


            );
        }

        // Devuelve en json con laravel
        return response()->json($data, $data['code']);
    }
}
