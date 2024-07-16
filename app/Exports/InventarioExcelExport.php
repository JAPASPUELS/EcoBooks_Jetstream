<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarioExcelExport implements FromCollection, WithHeadings, WithStyles
{
    protected $registros;

    public function __construct($registros)
    {
        $this->registros = $registros;
    }

    public function collection()
    {
        return $this->registros->map(function($item) {
            return [
                'ID Producto' => $item->art_id,
                'Producto' => $item->product->art_nombre,  
                'Cantidad' => $item->inv_cantidad_ing,
                'Fecha' => date('Y-m-d', strtotime($item->inv_fecha)), // Formatear fecha si es necesario
                'Registrado Por' => $item->user->name,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Producto',
            'Producto',
            'Cantidad',
            'Fecha',
            'Registrado Por'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Establecer estilos para las filas de encabezado (header)
            1 => ['font' => ['bold' => true]],

            // Ajustar el ancho de las columnas
            'A' => ['width' => 10],
            'B' => ['width' => 30],
            'C' => ['width' => 15],
            'D' => ['width' => 15],
            'E' => ['width' => 20],
        ];
    }
}
