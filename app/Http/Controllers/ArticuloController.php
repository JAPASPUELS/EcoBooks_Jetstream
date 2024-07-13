<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Movimientos;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        $query = Articulo::query()->with('categoria');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $criteria = $request->input('criteria');

            if ($criteria === 'nombre') {
                $query->where('art_nombre', 'LIKE', '%' . $search . '%');
            } elseif ($criteria === 'categoria') {
                $query->whereHas('categoria', function ($q) use ($search) {
                    $q->where('cat_name', 'LIKE', '%' . $search . '%');
                });
            }
        }

        $articulos = $query->paginate(10);

        return view('vistas.articulos.index', compact('articulos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('vistas.articulos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'art_nombre' => 'required|string|max:255',
            'art_precio' => 'required|numeric|min:0',
            'art_cantidad' => 'required|integer|min:0',
            'cat_id' => 'required|exists:categorias,cat_id',
            'art_unidades' => 'required|string|max:255',
        ]);

        $articulo = Articulo::create([
            'art_nombre' => $validated['art_nombre'],
            'art_precio' => $validated['art_precio'],
            'art_cantidad' => $validated['art_cantidad'],
            'cat_id' => $validated['cat_id'],
            'created_by' => auth()->user()->id,
            'art_unidades' => $validated['art_unidades'],
        ]);

        // Crear un movimiento
        Movimientos::create([
            'mov_tipo' => 'CREACION',
            'mov_cantidad' => $articulo->art_cantidad,
            'mov_fecha' => now(),
            'art_id' => $articulo->art_id,
            'stock_previo' => 0,
            'stock_actual' => $articulo->art_cantidad,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('articulos.create')->with('success', '¡Artículo registrado con éxito!');
    }

    public function edit(Articulo $articulo)
    {
        $categorias = Categoria::all();
        return response()->json([
            'articulo' => $articulo,
            'categorias' => $categorias,
        ]);
    }

    public function update(Request $request, Articulo $articulo)
    {
        $validated = $request->validate([
            'art_nombre' => 'required|string|max:255',
            'art_precio' => 'required|numeric',
            'art_cantidad' => 'required|integer',
            'cat_id' => 'required|integer',
            'art_unidades' => 'required|string|max:255',
        ]);

        $stockPrevio = $articulo->art_cantidad;

        $articulo->update($validated);

        // Crear un movimiento si la cantidad ha cambiado
        if ($articulo->wasChanged('art_cantidad')) {
            Movimientos::create([
                'mov_tipo' => 'ACTUALIZACION',
                'mov_cantidad' => $articulo->art_cantidad,
                'mov_fecha' => now(),
                'art_id' => $articulo->art_id,
                'stock_previo' => $stockPrevio,
                'stock_actual' => $articulo->art_cantidad,
                'created_by' => auth()->user()->id,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Artículo actualizado correctamente.']);
    }

    public function destroy(Articulo $articulo)
    {
        $articulo->delete();

        return response()->json(['success' => true, 'message' => 'Articulo eliminado exitosamente']);
    }
}
