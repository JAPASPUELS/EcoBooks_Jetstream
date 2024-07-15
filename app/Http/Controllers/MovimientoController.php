<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimientos;
use App\Models\User;
use App\Models\Articulo;

class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Movimientos::query();

        // Filtrar los datos basados en los parámetros de consulta
        if ($request->has('tipo') && $request->tipo != "todo") {
            $query->where('mov_tipo', $request->tipo);
        }
        if ($request->has('usuario') && $request->usuario != 0) {
            $query->where('created_by', $request->usuario);
        }

        if ($request->has('producto') && $request->producto != 0) {
            $query->where('art_id', $request->producto);
        }

        if ($request->has('fechaInicio') && $request->fechaInicio != '') {
            $query->whereDate('mov_fecha', '>=', $request->fechaInicio);
        }

        if ($request->has('fechaFin') && $request->fechaFin != '') {
            $query->whereDate('mov_fecha', '<=', $request->fechaFin);
        }

        if ($request->has('searchTerm') && $request->searchTerm != '') {
            $query->where(function ($q) use ($request) {
                $q->where('mov_tipo', 'like', '%' . $request->searchTerm . '%')
                    ->where('mov_cantidad', 'like', '%' . $request->searchTerm . '%')
                    ->where('mov_fecha', 'like', '%' . $request->searchTerm . '%')
                    ->where('stock_previo', 'like', '%' . $request->searchTerm . '%')
                    ->where('stock_actual', 'like', '%' . $request->searchTerm . '%')
                    ->orWhereHas('product', function ($query) use ($request) {
                        $query->where('art_nombre', 'like', '%' . $request->searchTerm . '%');
                    })
                    ->orWhereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->searchTerm . '%');
                    });
            });
        }

        $data = $query->paginate(12);

        $users = User::all();
        $products = Articulo::all();

        return view('vistas.movimientos.index', [
            'data' => $data,
            'users' => $users,
            'products' => $products
        ]);
    }
}
