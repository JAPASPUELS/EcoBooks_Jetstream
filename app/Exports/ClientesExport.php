<?php

namespace App\Exports;

use App\Models\Clientes;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientesExport implements FromCollection
{
    public function collection()
    {
        // Verificar qué categorías están en uso
        $clientes = Clientes::all();
        return $clientes;
    }
}
