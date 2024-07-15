<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Articulo;
use Illuminate\Support\Facades\Auth;



class CategoriaController extends Controller
{
    // public function create()
    // {
    //     // return view('vistas.proveedores.create');
    //     return view('vistas.categorias.index');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:50',
            'cat_description' => 'required|string|max:150',
        ]);

        Categoria::create([
            'cat_name' => $request->cat_name,
            'cat_description' => $request->cat_description,
            'created_by' => Auth::id()

        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría registrada exitosamente');
        // return with('success', 'Proveedor registrado exitosamente');
    }

    // public function indexo()
    // {
    //     // Obtener todas las categorías
    //     $categories = Categoria::all();

    //     // Verificar qué categorías están en uso
    //     foreach ($categories as $category) {
    //         $enUso = Articulo::where('cat_id', $category->cat_id)->exists();
    //         $category->enUso = $enUso ? 'Ok' : '';
    //     }

    //     // return view('categories.index', compact('categories'));
    //     // $categories = Categoria::orderBy('cat_id', 'asc')->get();
    //     return view('vistas.categorias.index', compact('categories'));
    // }

    public function index(Request $request)
    {
        $query = Categoria::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('cat_name', 'LIKE', "%{$search}%")
                ->orWhere('cat_description', 'LIKE', "%{$search}%");
        }

        $categories = $query->get();

        foreach ($categories as $category) {
            $enUso = Articulo::where('cat_id', $category->cat_id)->exists();
            $category->enUso = $enUso ? 'Ok' : '';
        }

        return view('vistas.categorias.index', compact('categories'));
    }


    public function edit($id)
    {
        $category = Categoria::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cat_name' => 'required|string|max:50',
            'cat_description' => 'required|string|max:150',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'cat_name' => $request->cat_name,
            'cat_description' => $request->cat_description,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }




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
