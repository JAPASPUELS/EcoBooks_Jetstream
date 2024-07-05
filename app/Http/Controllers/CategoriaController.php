<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Articulo;


class CategoriaController extends Controller
{
    public function create()
    {
        // return view('vistas.proveedores.create');
        return view('vistas.categorias.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:50',
            'cat_description' => 'required|string|max:150',
        ]);

        Categoria::create([
            'cat_name' => $request->cat_nombre,
            'cat_description' => $request->cat_description,
        ]);

        return redirect()->route('categorias.create')->with('success', 'Categoría registrada exitosamente');
        // return with('success', 'Proveedor registrado exitosamente');
    }

    public function index()
    {
          // Obtener todas las categorías
    $categories = Categoria::all();

    // Verificar qué categorías están en uso
    foreach ($categories as $category) {
        $enUso = Articulo::where('cat_id', $category->cat_id)->exists();
        $category->enUso = $enUso ? 'Ok' : '';
    }

    // return view('categories.index', compact('categories'));
        // $categories = Categoria::orderBy('cat_id', 'asc')->get();
        return view('vistas.categorias.index', compact('categories'));
    }


    // public function edit($id)
    // {
    //     $proveedor = Proveedor::findOrFail($id);
    //     return response()->json($proveedor);
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'pro_nombre' => 'required|string|max:50',
    //         'direccion_pro' => 'required|string|max:150',
    //         'pro_email' => 'required|string|email|max:100',
    //         'pro_telefono1' => 'required|string|max:20',
    //         'pro_telefono2' => 'nullable|string|max:20',
    //     ]);

    //     $proveedor = Proveedor::findOrFail($id);
    //     $proveedor->update([
    //         'pro_nombre' => $request->pro_nombre,
    //         'direccion_pro' => $request->direccion_pro,
    //         'pro_email' => $request->pro_email,
    //         'pro_telefono1' => $request->pro_telefono1,
    //         'pro_telefono2' => $request->pro_telefono2,
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Proveedor actualizado exitosamente']);
    // }



    // ! falta modificar para cuadno un producto tenga registrado con una categoria no le permita eliminar la categoria
    public function destroy($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
        return response()->json(['success' => true, 'message' => 'Categoria eliminada exitosamente']);
        } catch (\Throwable $th) {
            error_log($th);
        }

    }
}
