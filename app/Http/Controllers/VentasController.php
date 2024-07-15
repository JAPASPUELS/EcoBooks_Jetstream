<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use App\Models\Pago;
use App\Models\FormaPago;
use App\Models\Clientes;
use App\Models\Articulo;
use App\Models\Movimientos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

class VentasController extends Controller
{
    public function index()
    {
        try {
            $ventas = Ventas::orderBy('vent_numero', 'asc')->get();
            return view('vistas.ventas.index', compact('ventas'));
        } catch (\Throwable $th) {
            error_log("Error Load Audit Data -> $th");
        }
    }

    public function create()
    {
        $articulos = Articulo::all();
        $forma_Pagos = FormaPago::all();
        return view('vistas.ventas.create', compact('articulos', 'forma_Pagos'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            Log::info('Datos recibidos para crear una venta:', $request->all());
    
            // Crear la venta
            $venta = new Ventas();
            $venta->cli_codigo = $request->cli_codigo;
            $venta->vent_total = $request->vent_total;
            $venta->vent_subtotal = $request->vent_subtotal;
            $venta->vent_fecha = $request->vent_fecha;
            $venta->created_by = Auth::id();
            $venta->save();
    
            // Crear el detalle de la venta y registrar movimientos
            foreach ($request->detalle_ventas as $detalle) {
                $articulo = Articulo::find($detalle['art_id']);
                if (!$articulo) {
                    throw new \Exception("Artículo no encontrado");
                }
    
                $detalleVenta = new DetalleVentas();
                $detalleVenta->vent_numero = $venta->vent_numero;
                $detalleVenta->art_id = $detalle['art_id'];
                $detalleVenta->det_precio = $detalle['det_precio'];
                $detalleVenta->det_unidades = $detalle['det_unidades'];
                $detalleVenta->art_envase = $detalle['art_envase'];
                $detalleVenta->created_by = Auth::id();
                $detalleVenta->save();
    
                // Registrar movimiento
                $movimiento = new Movimientos();
                $movimiento->mov_tipo = 'EGRESO';
                $movimiento->mov_cantidad = $detalle['det_unidades'];
                $movimiento->mov_fecha = now();
                $movimiento->art_id = $detalle['art_id'];
                $movimiento->stock_previo = $articulo->art_cantidad;
                $movimiento->stock_actual = $articulo->art_cantidad - $detalle['det_unidades'];
                $movimiento->created_by = Auth::id();
                $movimiento->save();
    
                // Actualizar stock del artículo
                $articulo->art_cantidad = $movimiento->stock_actual;
                $articulo->save();
            }
    
            // Crear el pago
            $pago = new Pago();
            $pago->vent_numero = $venta->vent_numero;
            $pago->fpa_id = $request->fpa_id;
            $pago->pag_valor = $request->vent_total;
            $pago->created_by = Auth::id();
            $pago->save();
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => 'Venta guardada exitosamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar la venta: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al guardar la venta', 'error' => $e->getMessage()]);
        }
    }
    

    public function show(string $id)
    {
        return view('vistas.ventas.show', ['ventas' => Ventas::findOrFail($id)]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function addProduct(Request $request)
    {
        $articulo = Articulo::find($request->art_id);
        return response()->json($articulo);
    }

    public function buscarPorCedula($cedula)
    {
        $cliente = Clientes::where('cli_codigo', $cedula)->first();

        if ($cliente) {
            return response()->json([
                'success' => 'Ok!',
                'cli_nombre' => $cliente->cli_nombre,
                'cli_apellido' => $cliente->cli_apellido,
            ]);
        } else {
            return response()->json(['error' => 'Cliente no encontrado']);
        }
    }
}
