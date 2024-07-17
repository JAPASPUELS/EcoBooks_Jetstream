<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComprasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Compra::with('articulo', 'proveedor')
            ->orderBy('comp_id', 'asc')
            ->get()
            ->map(function ($compra) {
                return [
                    'Id' => $compra->comp_id,
                    'Artículo' => $compra->articulo->art_nombre,
                    'Proveedor' => $compra->proveedor->pro_nombre,
                    'Número de Factura' => $compra->comp_numfac,
                    'Cantidad' => $compra->comp_cantidad,
                    'Detalles' => $compra->com_detalles,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Artículo',
            'Proveedor',
            'Número de Factura',
            'Cantidad',
            'Detalles',
        ];
    }
}
