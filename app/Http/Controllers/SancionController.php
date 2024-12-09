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
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

    public function indexBandejaEntrada(Request $request): View
    {


        $informes = InformeNotarial::with('user')->where('estado', 'No verificado')->get();

        return view('sancion.lista-recibidos', compact('informes'), ['titulo' => 'Bandeja de entrada', 'currentPage' => 'Bandeja de entrada']);
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

    function indexVerificar($id, $idUser): View
    {

        $usuario = User::where('id', $idUser)->first();
        $agente = Agente::where('id', $usuario->agente_id)->first();



        switch ($agente->tipo_agente) {
            case 'SEPREC':

                // echo '<pre>';
                // dd(print_r('Hola mundo'));
                // echo '</pre>';

                $empresas = Empresa::where('informe_id', $id)->orderBy('id', 'desc')->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $id)->first();
                return view('sancion.verificar-empresas', compact('empresas', 'id', 'informe', 'idUser'), ['titulo' => 'Verificación de información SEPREC', 'currentPage' => 'Verificación SEPREC']);

                break;
            case 'Jueces y Secretarios del Tribunal Departamental de Justicia':

                $sentenciasJudiciales = SentenciasJudiciale::where('informe_id', $id)->orderBy('id', 'desc')->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $id)->first();
                return view('sancion.verificar-juzgados', compact('sentenciasJudiciales', 'id', 'informe'), ['titulo' => 'Gestión de registro de información Juzgados', 'currentPage' => 'Juzgados']);

                break;
            case 'Derechos Reales':

                $derechosReales = DerechosReale::where('informe_id', $id)->orderBy('id', 'desc')->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $id)->first();
                return view('sancion.verificar-derechos', compact('derechosReales', 'id', 'informe'), ['titulo' => 'Gestión de registro de información de Derechos Reales', 'currentPage' => 'Derechos Reales']);

                break;
            case 'Notarios de Fe Pública':

                $notaryRecords = NotaryRecord::where('informe_id', $id)->get();
                // Obtener la query string completa
                $informe = InformeNotarial::where('id', $id)->first();
                return view('sancion.verificar-notarios', compact('notaryRecords', 'id', 'informe'), ['titulo' => 'Gestión de Informe Notarios', 'currentPage' => 'Informe']);

                break;
            default:
                return Redirect::route('admin.layaouts.master');
                break;
        }
    }
}
