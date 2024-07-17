<?php

namespace App\Exports;

use App\Models\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticulosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Articulo::with('categoria')
            ->orderBy('art_id')  // Ordenar por art_id
            ->get()
            ->map(function ($articulo) {
                return [
                    'Id' => $articulo->art_id,
                    'Nombre' => $articulo->art_nombre,
                    'Precio' => $articulo->art_precio,
                    'Cantidad' => $articulo->art_cantidad,
                    'Categoría' => $articulo->categoria->cat_name ?? 'Sin categoría',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Precio',
            'Cantidad',
            'Categoría',
        ];
    }
}
