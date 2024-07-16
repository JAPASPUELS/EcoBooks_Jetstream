<?php

namespace App\Exports;

use App\Models\Gasto;
use Maatwebsite\Excel\Concerns\FromCollection;

class GastosExport implements FromCollection
{
    public function collection()
    {
        $gastos = Gasto::with(['user'])->get();
        return $gastos;
    }
}
