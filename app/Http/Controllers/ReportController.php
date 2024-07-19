<?php

namespace App\Http\Controllers;

use App\Exports\AuditoriaExport;
use App\Exports\MovimientoExport;
use App\Exports\InventarioExcelExport;
use App\Models\Clientes;
use App\Models\Movimientos;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Articulo;
use App\Models\Auditoria;
use App\Models\Inventario;
use App\Models\Gasto;
use App\Models\Proveedor;
use App\Models\Ventas;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriesExport;
use App\Exports\ClientesExport;
use App\Exports\ProveedoresExport;
use App\Exports\GastosExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }

    public function exportPDF()
    {
        $categories = Categoria::all();
        // Verificar qué categorías están en uso
        foreach ($categories as $category) {
            $enUso = Articulo::where('cat_id', $category->cat_id)->exists();
            $category->enUso = $enUso ? 'Ok' : '';
        }
        $pdf = PDF::loadView('reports.categories', compact('categories'));
        return $pdf->download('categories.pdf');
    }
    public function exportExcelClients()
    {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }

    public function exportPDFClients()
    {
        $clientes = Clientes::all();
        $pdf = PDF::loadView('reports.clientes', compact('clientes'));
        return $pdf->download('clientes.pdf');
    }

    // Exportar proveedores
    public function exportExcelProveedores()
    {
        return Excel::download(new ProveedoresExport, 'proveedores.xlsx');
    }

    public function exportPDFProveedores()
    {
        $proveedores = Proveedor::all();
        $pdf = PDF::loadView('reports.proveedores', compact('proveedores'));
        return $pdf->download('proveedores.pdf');
    }


    public function exportExcelAuditoria()
    {
        return Excel::download(new AuditoriaExport, 'auditoria.xlsx');
    }

    public function exportPDFAuditoria()
    {
        $registros = Auditoria::all();
        $pdf = PDF::loadView('reports.auditoria', compact('registros'));
        return $pdf->download('auditoria.pdf');
    }


    public function exportExcelMovimiento()
    {
        return Excel::download(new MovimientoExport, 'movimientos.xlsx');
    }

    public function exportPDFMovimiento()
    {
        $registros = Movimientos::all();
        $pdf = PDF::loadView('reports.movimiento', compact('registros'));
        return $pdf->download('movimientos.pdf');
    }

    public function exportExcelGasto()
    {
        return Excel::download(new GastosExport, 'gastos.xlsx');
    }

    public function exportPDFGasto()
    {
        $gastos = Gasto::with('user')->get();
        $pdf = PDF::loadView('reports.gastos', compact('gastos'));
        return $pdf->download('gastos.pdf');
    }

    public function exportExcelInventario(Request $request)
    {
        $query = Inventario::with('user', 'product');

        if ($request->has('fecha') && $request->fecha != '') {
            $fecha = date('Y-m-d', strtotime($request->fecha));
            $query->whereDate('inv_fecha', '>=', $fecha)
                ->whereDate('inv_fecha', '<=', $fecha);
        }

        $registros = $query->get();

        return Excel::download(new InventarioExcelExport($registros), 'inventario.xlsx');
    }


    public function exportPDFInventario(Request $request)
    {
        $query = Inventario::with('user', 'product');

        if ($request->has('fecha') && $request->fecha != '') {
            $fecha = date('Y-m-d', strtotime($request->fecha));
            $query->whereDate('inv_fecha', '>=', $fecha)
                ->whereDate('inv_fecha', '<=', $fecha);
        }

        $registros = $query->get();
        $pdf = PDF::loadView('reports.inventario', compact('registros'));
        return $pdf->download('inventario.pdf');
    }   
     public function exportPDFVenta($id)
    {
        try {
            $venta = Ventas::with(['user', 'detalles.articulo', 'pagos.formaPago'])
            ->where('vent_numero', $id)
            ->first();
            $user = Clientes::where("cli_codigo",$venta->cli_codigo)->first();
            Log::info( $venta);
            Log::info( $user);

            if (!$venta) {
                return redirect()->back()->withErrors('Venta no encontrada');
            }
            
            $pdf = PDF::loadView('reports.venta', compact('venta','user'));
            return $pdf->download('venta.pdf');
        } catch (\Throwable $th) {
            error_log("Error Generated Document -> $th");
            return redirect()->back()->withErrors('Error al generar el PDF');
        }
    }
    

    

}
