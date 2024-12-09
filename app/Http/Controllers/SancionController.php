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
use App\Models\SentenciasJudiciale;
use App\Models\User;
use App\Models\Verificar;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Pusher\Pusher;

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


        $informes = InformeNotarial::with('user')->where('estado', 'No verificado')->get();

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
        $user = Auth::user();

        dd($request->all());

        if ($user->rol != 'Agente') {
            return response()->json([
                'status' => 'Error',
                'code' => 403,
                'message' => 'El usuario no tiene permiso para realizar esta acción'
            ], 403);
        }

        $validate = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'archivo' => 'required|file|max:9048', // Validar archivo PDF
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
            $agente = Agente::findOrFail($user->agente_id);

            // Guardar archivo
            $path = $request->file('archivo')->store('verificaciones', 'public');

            $informe = new Verificar();
            $informe->descripcion = $request->descripcion;
            $informe->usuario_id = $user->id;
            $informe->tipo_informe = $agente->tipo_agente;
            $informe->archivo = $path; // Ruta del archivo
            $informe->save();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'El informe notarial se ha creado correctamente',
                'informe' => $informe
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
