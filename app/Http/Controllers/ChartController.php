<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ChartController extends Controller
{

    //     $tableName = $request->input('tableName');
    //     $start = $request->input('start');
    //     $end = $request->input('end');





    public function getData(Request $request)
    {
        $and = $request->input('and', []);
        $page = isset($and['page']) ? $and['page'] : 1;

        // Registrar los valores de las variables en el log para depuración
        Log::info('Request parameters', $and);

        Log::info('Request after', $and);

        // Inicializar la consulta
        $query = Auditoria::query();

        // Aplicar filtros dinámicos basados en las propiedades de 'and'
        foreach ($and as $key => $value) {
            switch ($key) {
                case 'aud_table':
                    $query->where('aud_table', $value);
                    break;
                case 'user_id':
                    $query->where('user_id', $value);
                    break;
                case 'start':
                    $query->where('aud_fecha', '>=', $value);
                    break;
                case 'end':
                    $query->where('aud_fecha', '<=', $value);
                    break;
                    // Puedes agregar más casos según las propiedades que necesites filtrar
                default:
                    // Puedes manejar cualquier otra propiedad aquí si es necesario
                    break;
            }
        }

        // Obtener los datos filtrados
        $data = $query->get();

        // Conteo general de acciones INSERT, UPDATE y DELETE
        $countByAction = [
            'INSERT' => $data->where('aud_accion', 'INSERT')->count(),
            'UPDATE' => $data->where('aud_accion', 'UPDATE')->count(),
            'DELETE' => $data->where('aud_accion', 'DELETE')->count(),
        ];

        // $paginatedData = $query->with('user')->paginate(10); // Obtener los datos filtrados paginados
        $paginatedData = $query->with('user')->paginate(10, ['*'], 'page', $page);

        // Conteo general de acciones para toda la tabla
        $countByActionGeneral = [
            'INSERT' => Auditoria::where('aud_accion', 'INSERT')->count(),
            'UPDATE' => Auditoria::where('aud_accion', 'UPDATE')->count(),
            'DELETE' => Auditoria::where('aud_accion', 'DELETE')->count(),
        ];

        // Datos para el gráfico de dispersión (richterData)
        $richterData = [];
        foreach ($countByAction as $accion => $count) {
            $richterData[] = ['x' => $count, 'y' => $count, 'action' => $accion];
        }

        // Datos para el gráfico de barras (likertData)
        $likertData = [
            'labels' => ['INSERT', 'UPDATE', 'DELETE'],
            'datasets' => [
                [
                    'label' => 'Acciones',
                    'data' => [$countByAction['INSERT'], $countByAction['UPDATE'], $countByAction['DELETE']],
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.2)', // Azul
                        'rgba(255, 206, 86, 0.2)', // Amarillo
                        'rgba(255, 99, 132, 0.2)', // Rojo
                    ],
                    'borderColor' => [
                        'rgba(54, 162, 235, 1)', // Azul
                        'rgba(255, 206, 86, 1)', // Amarillo
                        'rgba(255, 99, 132, 1)', // Rojo
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];

        Log::info('Request final', [
            'countByActionGeneral' => $countByActionGeneral,
            'countByAction' => $countByAction,
            'richterData' => $richterData,
            'likertData' => $likertData,
            'data' => $paginatedData
        ]);


        // Devolver los datos en formato JSON
        return response()->json([
            'countByActionGeneral' => $countByActionGeneral,
            'countByAction' => $countByAction,
            'richterData' => $richterData,
            'likertData' => $likertData,
            'data' => $paginatedData
        ]);
    }
}
