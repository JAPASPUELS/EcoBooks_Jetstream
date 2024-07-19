<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Auditoria;
use App\Models\Ventas;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{

    //     $tableName = $request->input('tableName');
    //     $start = $request->input('start');
    //     $end = $request->input('end');





    public function getData(Request $request)
    {
        $and = $request->input('and', []);
        $page = isset($and['page']) ? $and['page'] : 1; // Obtener el número de página actual

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

    public function getDataDashboard(Request $request)
    {
        $and = $request->input('and', []);
        $page = isset($and['page']) ? $and['page'] : 1; // Obtener el número de página actual
    
        Log::info('Request parameters', $and);
    
        $query = Ventas::query();
    
        foreach ($and as $key => $value) {
            switch ($key) {
                case 'start':
                    $query->where('vent_fecha', '>=', $value);
                    break;
                case 'end':
                    $query->where('vent_fecha', '<=', $value);
                    break;
                default:
                    break;
            }
        }
    
        $data = $query->get();
        $totalVentas = $data->count();
        $sumVentTotal = $data->sum('vent_total');
    
        // Conteo por acciones de auditoría
        $countByAction = [
            'NUMERODEVENTAS' => $totalVentas,
            'SUMATOTALVENTAS' => $sumVentTotal,
            'SUMATOTALVENTAS2' => 1,
        ];
        $auxiliar = [
            'INSERT' => 1, 
            'UPDATE' => 1,
            'DELETE' => 1,
        ];
    
        // Datos paginados
        $paginatedData = $query->with(['user', 'detalles.articulo', 'pagos.formaPago'])->paginate(5, ['*'], 'page', $page);
    
        // Conteo general de acciones de auditoría
        $countByActionGeneral = [
            'NUMERODEVENTAS' => Auditoria::where('aud_accion', 'INSERT')->count(),
            'SUMATOTALVENTAS' => Auditoria::where('aud_accion', 'UPDATE')->count(),
            'SUMATOTALVENTAS2' => Auditoria::where('aud_accion', 'DELETE')->count(),
        ];
    
        // Datos para el gráfico de dispersión (richterData)
        $richterData = [];
        foreach ($auxiliar as $accion => $count) {
            $richterData[] = ['x' => $count, 'y' => $count, 'action' => $accion];
        }
    
        // Datos para el gráfico de barras (likertData)
        $likertData = [
            'labels' => ['INSERT', 'UPDATE', 'DELETE'],
            'datasets' => [
                [
                    'label' => 'Acciones',
                    'data' => [$auxiliar['INSERT'], $auxiliar['UPDATE'], $auxiliar['DELETE']],
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
    
        // Número de registros después del filtrado
        $filteredCount = $query->count();
    
        // Total de ventas y cálculo de vent_total
        $totalVentas = $data->count();
        $sumVentTotal = $data->sum('vent_total');
    
        // Obtener todos los artículos
        $articulos = Articulo::all();
    
        // Productos más vendidos en función de las fechas ingresadas
        // $productosMasVendidos = DB::table('detalle_ventas')
        //     ->select('articulos.art_nombre', DB::raw('SUM(detalle_ventas.det_unidades) as total_vendido'))
        //     ->join('articulos', 'detalle_ventas.art_id', '=', 'articulos.art_id')
        //     ->join('ventas', 'detalle_ventas.vent_id', '=', 'ventas.vent_id')
        //     ->when(isset($and['start']), function ($query) use ($and) {
        //         $query->where('ventas.vent_fecha', '>=', $and['start']);
        //     })
        //     ->when(isset($and['end']), function ($query) use ($and) {
        //         $query->where('ventas.vent_fecha', '<=', $and['end']);
        //     })
        //     ->groupBy('articulos.art_nombre')
        //     ->having(DB::raw('SUM(detalle_ventas.det_cantidad)'), '>', 25)
        //     ->get();
    
        Log::info('Request final', [
            'countByActionGeneral' => $countByActionGeneral,
            'countByAction' => $countByAction,
            'richterData' => $richterData,
            'likertData' => $likertData,
            'data' => $paginatedData,
            'filteredCount' => $filteredCount,
            'totalVentas' => $totalVentas,
            'sumVentTotal' => $sumVentTotal,
            'articulos' => $articulos,
            // 'productosMasVendidos' => $productosMasVendidos,
        ]);
    
        // Devolver los datos en formato JSON
        return response()->json([
            'countByActionGeneral' => $countByActionGeneral,
            'countByAction' => $countByAction,
            'richterData' => $richterData,
            'likertData' => $likertData,
            'data' => $paginatedData,
            'filteredCount' => $filteredCount,
            'totalVentas' => $totalVentas,
            'sumVentTotal' => $sumVentTotal,
            'articulos' => $articulos,
            // 'productosMasVendidos' => $productosMasVendidos,
        ]);
    }
    
}
