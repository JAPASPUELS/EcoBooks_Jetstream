<?php

namespace App\Exports;

use App\Models\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticulosExport implements FromCollection
{
    public function collection()
    {
        $articulos = Articulo::all();
        return $articulos ;
    }
}
