<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProveedoresExport implements FromCollection
{
    public function collection()
    {
        $proveedores = Proveedor::all();
        return $proveedores ;
    }
}
