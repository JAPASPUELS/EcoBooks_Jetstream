<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'art_id' => 'required|string|max:10',
            'inv_fecha' => 'required|date',
            'inv_cantidad' => 'required|numeric',
        ]);

        Inventario::create([
            'art_id' => $request->art_id,
            'inv_fecha' => $request->inv_fecha,
            'inv_cantidad' => $request->inv_cantidad,
        ]);

        return redirect()->back()->with('success', 'Inventario registrado exitosamente.');
    }
}
