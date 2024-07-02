<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VentasFormRequest;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $ventas = DB::table('ventas')
                ->join('clientes', 'ventas.cli_codigo', '=', 'clientes.cli_codigo')
                ->select('ventas.vent_numero', 'ventas.vent_fecha', 'ventas.vent_total', 'clientes.cli_nombre as cliente')
                ->where('ventas.vent_numero', 'LIKE', '%' . $query . '%')
                ->orderBy('ventas.vent_numero', 'asc')
                ->paginate(7);
            return view('vistas.ventas.index', ['ventas' => $ventas, 'searchText' => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vistas.ventas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ventas = new Ventas();
        $ventas->vent_numero = $request->get('vent_numero');
        $ventas->cli_codigo = $request->get('cli_codigo');
        $ventas->vent_fecha = $request->get('vent_fecha');
        $ventas->vent_total = $request->get('vent_total');
        $ventas->save();
        return Redirect::to('vistas/ventas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('vistas.ventas.show', ['ventas' => Ventas::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
