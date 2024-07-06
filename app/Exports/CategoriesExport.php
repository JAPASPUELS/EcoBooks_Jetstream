<?php

namespace App\Exports;

use App\Models\Categoria;
use App\Models\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection
{
    public function collection()
    {
        // Verificar qué categorías están en uso
        $categories = Categoria::all();
        foreach ($categories as $category) {
            $enUso = Articulo::where('cat_id', $category->cat_id)->exists();
            $category->enUso = $enUso ? 'Ok' : '';
        }
        return $categories;
    }
}
