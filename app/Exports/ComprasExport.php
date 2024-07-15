<?php

namespace App\Exports;
use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;

class ComprasExport implements FromCollection
{
    public function collection()
    {
        $compras = Compra::all();
        return $compras ;
    }
}