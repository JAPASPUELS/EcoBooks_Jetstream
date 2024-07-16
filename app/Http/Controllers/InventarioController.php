<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use Illuminate\Support\Facades\Auth;


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
            'created_by' => Auth::id()

        ]);

        return redirect()->back()->with('success', 'Inventario registrado exitosamente.');
    }
}
