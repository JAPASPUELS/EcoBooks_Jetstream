<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $data = Inventario::with(['user','product'])->whereDate('inv_fecha', $fecha)->paginate(10);
    
        return view('vistas.inventario.partials.detalle', [
            'data' => $data,
            'fecha' => $fecha,
        ]);
    }
    
    
}
