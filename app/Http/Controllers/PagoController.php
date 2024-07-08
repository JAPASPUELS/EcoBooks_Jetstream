<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\FormaPago;

class PagoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pago::with('formaPago');

        if ($request->has('forma_pago')) {
            $forma_pago = $request->input('forma_pago');
            $query->where('fpa_id', $forma_pago);
        }

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $query->whereBetween('pag_fecha', [$fecha_inicio, $fecha_fin]);
        }

        $pagos = $query->get();
        $formas_pago = FormaPago::all();

        return view('vistas.pagos.index', compact('pagos', 'formas_pago'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fpa_id' => 'required|string|max:3',
            'vent_numero' => 'required|integer',
            'pag_valor' => 'required|numeric',
            'pag_fecha' => 'required|date',
        ]);

        Pago::create([
            'fpa_id' => $request->fpa_id,
            'vent_numero' => $request->vent_numero,
            'pag_valor' => $request->pag_valor,
            'pag_fecha' => $request->pag_fecha,
        ]);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado exitosamente');
    }
}

