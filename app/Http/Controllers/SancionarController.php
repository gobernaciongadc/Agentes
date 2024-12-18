<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use App\Models\Sancion_2;
use Illuminate\Http\Request;
use App\Models\TipoSancion;


class SancionarController extends Controller
{

    // SECTOR SANCION COMPLETADA
    public function indexSancion()
    {
        $sanciones = Sancion_2::with('tipoSancion')->get();
        return view('sanciones.index', compact('sanciones'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function createSancion()
    {
        $tipos = TipoSancion::all();
        return view('sanciones.create', compact('tipos'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function storeSancion(Request $request)
    {

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_sancion_id' => 'required|exists:tipos_sancion,id',
            'monto' => 'required|numeric|min:0',
        ]);

        Sancion_2::create($validated);
        return redirect()->route('sanciones.index')->with('success', 'Sanción creada correctamente.');
    }

    public function editSancion(Sancion $sancion)
    {
        $tipos = TipoSancion::all();
        return view('sanciones.edit', compact('sancion', 'tipos'), ['titulo' => 'Gestión de sanciones', 'currentPage' => 'Sanciones']);
    }

    public function updateSancion(Request $request, Sancion $sancion)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_sancion_id' => 'required|exists:tipos_sancions,id',
            'monto' => 'required|numeric|min:0',
        ]);

        $sancion->update($validated);
        return redirect()->route('sanciones.index')->with('success', 'Sanción actualizada correctamente.');
    }

    public function destroySancion(Sancion $sancion)
    {
        $sancion->delete();
        return redirect()->route('sanciones.index')->with('success', 'Sanción eliminada correctamente.');
    }
}
