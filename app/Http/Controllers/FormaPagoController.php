<?php
// app/Http/Controllers/FormaPagoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPago;
use Illuminate\Support\Facades\Auth;


class FormaPagoController extends Controller
{
    public function index(Request $request)
    {
        $query = FormaPago::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('fpa_nombre', 'LIKE', "%{$search}%");
        }

        $forma_pagos = $query->with('user')->get();

        return view('vistas.formaPago.index', compact('forma_pagos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fpa_nombre' => 'required|string|max:30',
        ]);

        FormaPago::create([
            'fpa_nombre' => $request->fpa_nombre,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('formaPago.index')->with('success', 'Forma de pago registrada exitosamente');
    }

    public function edit($id)
    {
        $forma_pago = FormaPago::findOrFail($id);
        return response()->json($forma_pago);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fpa_nombre' => 'required|string|max:30',
        ]);

        $forma_pago = FormaPago::findOrFail($id);
        $forma_pago->update([
            'fpa_nombre' => $request->fpa_nombre,
        ]);

        return redirect()->route('formaPago.index')->with('success', 'Forma de pago actualizada exitosamente');
    }

    public function destroy($id)
    {
        try {
            $forma_pago = FormaPago::findOrFail($id);
            $forma_pago->delete();
            return response()->json(['success' => true, 'message' => 'Forma de pago eliminada exitosamente']);
        } catch (\Throwable $th) {
            error_log($th);
            return response()->json(['success' => false, 'message' => 'Error al eliminar la forma de pago']);
        }
    }
}
