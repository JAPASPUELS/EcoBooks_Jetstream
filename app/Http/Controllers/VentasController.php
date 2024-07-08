<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use App\Models\Articulo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VentasFormRequest;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        try {
            $ventas = Ventas::orderBy('vent_numero', 'asc')->get();
            return view('vistas.ventas.index', compact('ventas'));
        } catch (\Throwable $th) {
            //throw $th;
            error_log("Error Load Audit Data -> $th");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $articulos = Articulo::all();
        return view('vistas.ventas.create', compact('articulos'));
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

    /**
     * Add product to the sale.
     */
    public function addProduct(Request $request)
    {
        $articulo = Articulo::find($request->art_id);
        return response()->json($articulo);
    }
    public function buscarPorCedula($cedula)
    {
        $cliente = Cliente::where('cli_codigo', $cedula)->first();
    
        if ($cliente) {
            return response()->json([
                'cli_nombre' => $cliente->cli_nombre,
                'cli_apellido' => $cliente->cli_apellido,
            ]);
        } else {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
    }
}
