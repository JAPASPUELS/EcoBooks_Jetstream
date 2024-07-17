<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\User;
use App\Models\Articulo;
use App\Models\Movimientos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventario::query();

        if ($request->has('usuario') && $request->usuario != 0) {
            $query->where('created_by', $request->usuario);
        }

        if ($request->has('fechaInicio') && $request->fechaInicio != '') {
            $query->whereDate('inv_fecha', '>=', $request->fechaInicio);
        }
        if ($request->has('fechaFin') && $request->fechaFin != '') {
            $query->whereDate('inv_fecha', '<=', $request->fechaFin);
        }

        // Seleccionar las columnas necesarias y agrupar por la fecha y el usuario
        $query->select(
            DB::raw('DATE(inv_fecha) as inv_fecha'),
            DB::raw('SUM(inv_cantidad_ing) as total_cantidad'),
            'created_by'
        )
            ->groupBy(
                DB::raw('DATE(inv_fecha)'),
                'created_by'
            );

        $data = $query->paginate(12);

        $users = User::all();

        return view('vistas.inventario.index', [
            'data' => $data,
            'users' => $users,
        ]);
    }
    public function detalle($fecha)
    {
        $data = Inventario::with(['user', 'product'])->whereDate('inv_fecha', $fecha)->paginate(2);

        return view('vistas.inventario.partials.detalle', [
            'data' => $data,
            'fecha' => $fecha,
        ]);
    }
    public function nuevo()
    {
        $data = Articulo::with(['user'])->get();
        return view('vistas.inventario.partials.ninventario', [
            'data' => $data,
        ]);
    }


    public function save(Request $request)
    {
        $changes = $request->input('changes');
        $allInventory = $request->input('allInventory');
        $cantidadmovimiento = 0;
        $identificador = 0;
        $articulo = null ;
        // Crear movimientos a partir del arreglo changes
        foreach ($changes as $change) {
            $articulo = Articulo::where('art_id', $change['id'])->first();

            if($change['cantidad']>$articulo->art_cantidad){
                $cantidadmovimiento = $change['cantidad'] - $articulo->art_cantidad;
                $identificador = 1;
            }else if($change['cantidad']<$articulo->art_cantidad){
                $cantidadmovimiento = $articulo->art_cantidad - $change['cantidad'];
                $identificador = 2;
            }else{
                $cantidadmovimiento = $change['cantidad'];
            }
            
            Movimientos::create([
                'mov_tipo' => "AJUSTE",
                'mov_cantidad' => $cantidadmovimiento,
                'mov_fecha' => Carbon::now()->format('Y-m-d H:i:s.u'),
                'art_id' => $change['id'],
                'stock_previo' => $articulo->art_cantidad,
                'stock_actual'=> $identificador == 2 ? $articulo->art_cantidad - $cantidadmovimiento : $articulo->art_cantidad + $cantidadmovimiento ,
                'created_by' => Auth::id()
                // Agregar otros campos necesarios
            ]);

            $articulo->art_cantidad = $change['cantidad'];
            $articulo->save();

        }

        // Crear inventarios a partir del arreglo allInventory
        foreach ($allInventory as $inventory) {
            Inventario::create([
	            'art_id' => $inventory['id'],
                'inv_fecha' => Carbon::now()->format('Y-m-d H:i:s.u'),
	            'inv_cantidad_ing' => $inventory['cantidad'],
                'created_by' => Auth::id()

                ]
            );
        }

        // return response()->json(['message' => 'Datos guardados correctamente']);
        return view('vistas.inventario.index');
    }
}
