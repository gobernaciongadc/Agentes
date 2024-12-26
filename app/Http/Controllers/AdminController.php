<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\Comunicado;
use App\Models\DerechosReale;
use App\Models\Empresa;
use App\Models\InformeNotarial;
use App\Models\NotaryRecord;
use App\Models\Notificacione;
use App\Models\Sancion_2;
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

        $user = Auth::user();
        $showPanel = true;

        if ($user->rol == 'Administrador') {
            $showPanel = true;
        } else {
            $showPanel = false;
        }



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
            'showPanel' => $showPanel,  // Variable para controlar la inclusión
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
        $sancionesNotificados = [];
        $informesNotificados = [];
        $observadosNotificados = [];
        $comunicadosNotificados = [];

        // Usuario autenticado
        $user = Auth::user();

        if ($user->rol == 'Agente') {

            $tipoAgente = 'Agente';
            // Sacar las notificaciones
            $notificaciones = Notificacione::with('user.persona')->where('estado', 'No revizado')
                ->orderBy('id', 'desc')->get();

            foreach ($notificaciones as $notificacion) {

                if (json_decode($notificacion->destinatario)->idUsuario == $user->id) {

                    $agentesNotificados[] = $notificacion;
                }
            }

            // Sacar las sanciones
            $sanciones = Sancion_2::with('user.persona')->where('estado_vista', 'No revizado')
                ->where('estado_envio', 'Enviado')
                ->orderBy('id', 'desc')->get();

            foreach ($sanciones as $notificacion) {

                if ($notificacion->agente_id == $user->id) {
                    $sancionesNotificados[] = $notificacion;
                }
            }

            // Para sacar los informes no revizados
            $informes = InformeNotarial::with('user')->where('envio_gober', 'Enviado')
                ->where('estado', '!=', 'Pendiente')
                ->where('envio_agente', 'No enviado')
                ->orderBy('id', 'desc')->get();

            if ($user->rol == 'Administrador') {
                $informes = InformeNotarial::with('user')->where('envio_gober', 'Enviado')
                    ->where('estado', '!=', 'Pendiente')
                    ->where('envio_agente', 'No enviado')
                    ->orderBy('id', 'desc')->get();
                foreach ($informes as $notificacion) {

                    if ($notificacion->usuario_id == $user->id) {

                        $informesNotificados[] = $notificacion;
                    }
                }
            } else {
                $informesNotificados = [];
            }

            // Para sacar los informes no revizados observados
            $informesObservados = InformeNotarial::with('user.agente.persona')
                ->where('envio_gober', 'Enviado')
                ->where('estado_vista', 'No revizado')
                ->orderBy('id', 'desc')->get();

            foreach ($informesObservados as $notificacionObs) {

                if ($notificacionObs->usuario_id == $user->id) {

                    $observadosNotificados[] = $notificacionObs;
                }
            }

            // Para sacar los Comunicados no Revizados
            $comunicados = Comunicado::with('user.persona')
                ->where('estado_vista', 'No revizado')
                ->orderBy('id', 'desc')->get();

            foreach ($comunicados as $comunicado) {

                if ($comunicado->destinatario == $user->agente->tipo_agente) {

                    $comunicadosNotificados[] = $comunicado;
                }
            }


            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Lista de notificaciones cargada correctamente',
                'notificaciones' => $agentesNotificados,
                'sanciones' => $sancionesNotificados,
                'informes' => $informesNotificados,
                'observados' => $observadosNotificados,
                'comunicados' => $comunicados,
                'tipoAgente' => $tipoAgente,
                'totalNotificaciones' => count($agentesNotificados),
                'totalSanciones' => count($sancionesNotificados),
                'totalInformes' => count($informesNotificados),
                'totalObservados' => count($observadosNotificados),
                'totalComunicados' => count($comunicadosNotificados),
                'usuario' => $user
            );
        } else {

            $tipoAgente = 'Administrador';

            // Para sacar los informes no revizados(Que agente esta enviando)
            $informes = InformeNotarial::with('user.agente.persona')->where('envio_agente', 'Enviado')
                ->where('estado', '!=', 'Pendiente')
                ->where('estado_vista', '!=', 'Revizado')
                ->where('envio_gober', 'No enviado')
                ->orderBy('id', 'desc')->get();


            // Para notificaciones de pago
            $sancionesPago = Sancion_2::with('agente.persona')
                ->where('envio_pago', 'Enviado')
                ->where('estado_vista_pago', 'No revizado')
                ->orderBy('id', 'desc')->get();


            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Lista de notificaciones cargada correctamente',
                'notificaciones' => $agentesNotificados,
                'sanciones' => $sancionesNotificados,
                'informes' => $informes,
                'informes' => $informes,
                'pagos' => $sancionesPago,
                'tipoAgente' => $tipoAgente,
                'totalNotificaciones' => count($agentesNotificados),
                'totalSanciones' => count($sancionesNotificados),
                'totalInformes' => count($informes),
                'totalPagos' => count($sancionesPago),
            );
        }

        // Devuelve en json con laravel
        return response()->json($data, $data['code']);
    }

    function mostrarInformeNotificacion($id)
    {
        $user = Auth::user();

        $informes = InformeNotarial::with('user')->where('id', $id)
            ->where('estado_vista', 'No revizado')
            ->get();

        $info_2 = InformeNotarial::with('user')->where('id', $id)
            ->first();

        $info_2->estado_vista = 'Revizado';
        $info_2->save();

        if ($user->rol == 'Agente') {

            switch ($info_2->tipo_informe) {
                case 'Notarios de Fe Pública':

                    $agente = Agente::where('id', $user->agente_id)->first();

                    $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();

                    return view('informe-notarial.index', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información Notarial', 'currentPage' => 'Informe Notarial']);

                case 'Derechos Reales':
                    // Obtener el usuario autenticado
                    $user = Auth::user();

                    $agente = Agente::where('id', $user->agente_id)->first();

                    $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();

                    return view('informe-notarial.index_derechos', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información de Derechos Reales', 'currentPage' => 'Informe Derechos Reales']);


                case 'SEPREC':
                    // Obtener el usuario autenticado
                    $user = Auth::user();

                    $agente = Agente::where('id', $user->agente_id)->first();

                    $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->orderBy('id', 'desc')->get();

                    return view('informe-notarial.index_notario', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información de Empresas SEPREC', 'currentPage' => 'Informe de Empresas']);

                case 'Jueces y Secretarios del Tribunal Departamental de Justicia':

                    $user = Auth::user();

                    $agente = Agente::where('id', $user->agente_id)->first();

                    $informeNotarials = InformeNotarial::where('usuario_id', $user->id)->get();

                    return view('informe-notarial.index_juzgado', compact('informeNotarials', 'agente'), ['titulo' => 'Gestión de Información de Setratarios y Juzgados', 'currentPage' => 'Informe Juzgados']);
            }
        } else {
            $id = 'todos';
            return view('sancion.lista-recibidos', compact('informes', 'id'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada', 'lista' => 'Lista General']);
        }
    }

    function mostrarComunicadoNotificacion($id)
    {
        $tipoAgente = 'Agente';
        $comunicados = Comunicado::where('id', $id)->get();
        $comunicados[0]->estado_vista = 'Revizado';
        $comunicados[0]->save();
        return view('comunicado.index', compact('comunicados', 'tipoAgente'), ['titulo' => 'Gestión de Comunicados', 'currentPage' => 'Comunicados']);
    }

    function mostrarPagoNotificacion($id)
    {

        $agentesNotificados = [];
        // Usuario autenticado
        $user = Auth::user();
        $tipoAgente = 'Administrador';
        $sanciones = Sancion_2::where('id', $id)->get();

        $sanciones[0]->estado_vista_pago = 'Revizado';
        $sanciones[0]->save();

        return view('sanciones.index', compact('sanciones', 'agentesNotificados', 'tipoAgente'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }
}
