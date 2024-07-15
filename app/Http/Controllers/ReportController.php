<?php

namespace App\Http\Controllers;

use App\Exports\AuditoriaExport;
use App\Exports\MovimientoExport;
use App\Models\Clientes;
use App\Models\Movimientos;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Articulo;
use App\Models\Compra;
use App\Models\Auditoria;
use App\Models\Gasto;
use App\Models\Proveedor;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriesExport;
use App\Exports\ClientesExport;
use App\Exports\ProveedoresExport;
use App\Exports\GastosExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ArticulosExport;
use App\Exports\ComprasExport;

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

    // Exportar artículos
    public function exportPDFArticulos()
    {
        $articulos = Articulo::with('categoria')->get();
        $pdf = PDF::loadView('reports.articulos', compact('articulos'));
        return $pdf->download('articulos.pdf');
    }

    public function exportExcelArticulos()
    {
        return Excel::download(new ArticulosExport, 'articulos.xlsx');
    }

    // Exportar compras a PDF
    public function exportPDFCompras()
    {
        $compras = Compra::with('articulo', 'proveedor', 'user')->get();
        $pdf = PDF::loadView('reports.compras', compact('compras'));
        return $pdf->download('reporte_Compras.pdf');
    }

    // Exportar compras a Excel
    public function exportExcelCompras()
    {
        return Excel::download(new ComprasExport, 'compras.xlsx');
    }
}
