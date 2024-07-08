<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getData($tableName)
    {
        // Lógica para obtener los datos según $tableName
        $data = Auditoria::where('aud_table', $tableName)->get();

        // Procesa $data según necesidades específicas (por ejemplo, contar registros por acción)
        $countByAction = $data->groupBy('aud_accion')->map->count();

        return response()->json($countByAction);
    }
}
