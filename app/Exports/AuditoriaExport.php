<?php

namespace App\Exports;

use App\Models\Auditoria;
use Maatwebsite\Excel\Concerns\FromCollection;

class AuditoriaExport implements FromCollection
{
    public function collection()
    {
        $registros = Auditoria::with('user')->get();
        return $registros;
    }
}
