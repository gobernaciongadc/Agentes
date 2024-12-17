<?php
// app/Http/Controllers/PagoController.php
namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Sancion;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function show(Sancion $sancion)
    {
        return view('sanciones.pago', compact('sancion'));
    }

    public function store(Request $request, Sancion $sancion)
    {
        $validated = $request->validate([
            'monto_pagado' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'fecha_pago' => 'required|date',
        ]);

        $validated['sancion_id'] = $sancion->id;
        Pago::create($validated);
        $sancion->update(['estado' => true]);

        return redirect()->route('sanciones.index')->with('success', 'Pago realizado correctamente.');
    }
}
