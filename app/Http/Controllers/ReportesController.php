<?php

namespace App\Http\Controllers;

use App\Models\InformeNotarial;
use App\Models\Municipio;
use App\Models\Sancion_2;
use App\Models\User;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ReportesController extends Controller
{

    // Reporte por Transmisión de Información
    public function reporteTransmision(): View
    {

        // 1.- Cargar tipos de transmision
        $tipoTransmision = ['Notarios de Fe Pública', 'Jueces y Secretarios del Tribunal Departamental de Justicia', 'SEPREC', 'Derechos Reales'];

        // 2.- Cargar tipos de transmision
        return view('reportes.tipo-transmision', compact('tipoTransmision'), ['titulo' => 'Reporte Por Tipo de Transmisión', 'currentPage' => 'Reportes por Transmisión']);
    }

    function reporteTransmisionPost(Request $request)
    {

        $params = (object) $request->all(); // Devulve un obejto

        $informes = InformeNotarial::with('user.agente.persona')
            ->where('tipo_informe', $params->tipo_transmision)
            ->where('estado', '!=', 'Pendiente')
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
        return response()->json($data, $data['code']);
    }


    // Reporte por Agentes
    public function reporteAgentes(): View
    {

        // 1.- Cargar Agentes
        $agentes = User::with('agente.persona')->where('agente_id', '!=', null)
            ->where('estado', 1)
            ->get();


        // 2.- Cargar tipos de transmision
        return view('reportes.tipo-agentes', compact('agentes'), ['titulo' => 'Reporte Por Agente', 'currentPage' => 'Reportes por agente']);
    }

    function reporteAgentesPost(Request $request)
    {

        $params = (object) $request->all(); // Devulve un obejto

        $informes = InformeNotarial::with('user.agente.persona')
            ->where('usuario_id', $params->usuario_id)
            ->where('estado', '!=', 'Pendiente')
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
        return response()->json($data, $data['code']);
    }

    // Reporte por Municipio
    public function reporteMunicipio(): View
    {

        // 1.- Cargar tipo municipios
        $municipios = Municipio::all();

        // 2.- Cargar tipos de transmision
        return view('reportes.por-municipio', compact('municipios'), ['titulo' => 'Reporte Por Municipio', 'currentPage' => 'Reportes por Municipio']);
    }

    function reporteMunicipioPost(Request $request)
    {
        try {
            // Acceder directamente al municipio_id desde el request
            $municipio_id = $request->input('municipio_id');

            $informes = InformeNotarial::with('user.agente.municipio', 'user.agente.persona')
                ->whereHas('user.agente', function ($query) use ($municipio_id) {
                    $query->where('municipio_id', $municipio_id); // Filtrando por municipio_id en la relación
                })
                ->where('estado', '!=', 'Pendiente')
                ->get();

            $data = [
                'code' => 200,
                'status' => 'success',
                'informes' => $informes
            ];
        } catch (Exception $e) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($data, $data['code']);
    }

    function reporteSanciones()
    {

        // 1.-Agentes sancionados

        $informesSancionados = [];

        $sancionados = Sancion_2::all();
        $informes = InformeNotarial::all();

        foreach ($sancionados as $key => $sancionado) {

            foreach ($informes as $key => $informe) {

                // Verificar si el agente es sancionado
                if ($sancionado->agente_id == $informe->usuario_id) {
                    array_push($informesSancionados, $informe);
                }
            }
        }

        $sanciones = $informesSancionados;
        dd($sanciones);

        // 2.- Cargar tipos de transmision
        return view('reportes.tipo-sanciones', compact('agentes'), ['titulo' => 'Reporte Por Sanciones', 'currentPage' => 'Reportes por sanciones']);
    }
}
