<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Articulo;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\Movimientos;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        $query = Compra::query()->with('articulo', 'proveedor', 'user');

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $criteria = $request->input('criteria');

            if ($criteria === 'articulo') {
                $query->whereHas('articulo', function ($q) use ($search) {
                    $q->whereRaw('LOWER(art_nombre) LIKE ?', [$search . '%']);
                });
            } elseif ($criteria === 'proveedor') {
                $query->whereHas('proveedor', function ($q) use ($search) {
                    $q->whereRaw('LOWER(pro_nombre) LIKE ?', [$search . '%']);
                });
            }
        }

        $compras = $query->paginate(10)->appends($request->all());

        return view('vistas.compras.index', compact('compras'));
    }

    public function create()
    {
        $articulos = Articulo::all();
        $proveedores = Proveedor::all();
        return view('vistas.compras.create', compact('articulos', 'proveedores'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'art_id' => 'required|exists:articulos,art_id',
            'pro_id' => 'required|exists:proveedores,pro_id',
            'comp_numfac' => 'required|string|max:255',
            'com_detalles' => 'nullable|string',
            'comp_cantidad' => 'required|integer|min:1',
        ]);

        // Obtener el artículo
        $articulo = Articulo::findOrFail($validated['art_id']);
        $stockPrevio = $articulo->art_cantidad;

        // Actualizar la cantidad del artículo
        $articulo->increment('art_cantidad', $validated['comp_cantidad']);

        // Crear la nueva compra
        $compra = Compra::create(array_merge($validated, ['created_by' => auth()->user()->id]));

        // Crear un movimiento
        Movimientos::create([
            'mov_tipo' => 'ajuste',
            'mov_cantidad' => $validated['comp_cantidad'],
            'mov_fecha' => now(),
            'art_id' => $articulo->art_id,
            'stock_previo' => $stockPrevio,
            'stock_actual' => $articulo->art_cantidad,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('compras.create')->with('success', '¡Compra registrada con éxito!');
    }

    public function edit(Compra $compra)
    {
        $articulos = Articulo::all();
        $proveedores = Proveedor::all();
        return response()->json([
            'compra' => $compra,
            'articulos' => $articulos,
            'proveedores' => $proveedores,
        ]);
    }

    public function update(Request $request, Compra $compra)
    {
        $validated = $request->validate([
            'art_id' => 'required|exists:articulos,art_id',
            'pro_id' => 'required|exists:proveedores,pro_id',
            'comp_numfac' => 'required|string|max:255',
            'com_detalles' => 'nullable|string',
            'comp_cantidad' => 'required|integer|min:1',
        ]);

        $articulo = Articulo::findOrFail($validated['art_id']);
        $stockPrevio = $articulo->art_cantidad;

        // Actualizar la cantidad del artículo
        $articulo->increment('art_cantidad', $validated['comp_cantidad']);

        // Actualizar la compra
        $compra->update($validated);

        // Crear un movimiento
        Movimientos::create([
            'mov_tipo' => 'ajuste',
            'mov_cantidad' => $validated['comp_cantidad'],
            'mov_fecha' => now(),
            'art_id' => $articulo->art_id,
            'stock_previo' => $stockPrevio,
            'stock_actual' => $articulo->art_cantidad,
            'created_by' => auth()->user()->id,
        ]);

        return response()->json(['success' => true, 'message' => 'Compra actualizada correctamente.']);
    }

    public function destroy($id)
    {
        $compra = Compra::find($id);
        if ($compra) {
            // Lógica para disminuir la cantidad en el artículo asociado
            $articulo = Articulo::find($compra->art_id);
            if ($articulo) {
                $articulo->art_cantidad -= $compra->comp_cantidad;
                $articulo->save();

                // Crear movimiento de eliminación
                Movimientos::create([
                    'mov_tipo' => 'EGRESO',
                    'mov_cantidad' => $compra->comp_cantidad,
                    'mov_fecha' => now(),
                    'art_id' => $compra->art_id,
                    'stock_previo' => $articulo->art_cantidad + $compra->comp_cantidad,
                    'stock_actual' => $articulo->art_cantidad,
                    'created_by' => auth()->user()->id,
                ]);

                // Eliminar la compra
                $compra->delete();

                return response()->json(['success' => true, 'message' => 'Compra eliminada correctamente.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Compra no encontrada.']);
        }
    }
}
