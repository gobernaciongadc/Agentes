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
        $sanciones = Sancion_2::with('agente.persona')->get();

        return view('sanciones.index', compact('sanciones'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
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
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'agente_id' => 'required',
            'monto' => 'required',
        ]);

        Sancion_2::create($validated);
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
        dd($sancion, $idAgente);
    }
}
