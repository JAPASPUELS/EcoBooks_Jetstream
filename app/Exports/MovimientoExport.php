<?php

namespace App\Exports;

use App\Models\Movimientos;
use Maatwebsite\Excel\Concerns\FromCollection;

class MovimientoExport implements FromCollection
{
    public function collection()
    {
        $registros = Movimientos::with(['user','product'])->get();
        return $registros;
    }
}
