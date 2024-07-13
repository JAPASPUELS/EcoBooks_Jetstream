<?php
namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Articulo;
use App\Models\Proveedor;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriesExport;
use App\Exports\ClientesExport;
use App\Exports\ProveedoresExport;
use App\Exports\ArticulosExport;
use Barryvdh\DomPDF\Facade\Pdf;

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
    // Exportar Articulos
    public function exportExcelArticulos()
    {
        return Excel::download(new ArticulosExport, 'articulos.xlsx');
    }

    public function exportPDFArticulos()
    {
        $articulos = Articulo::all();
        $pdf = PDF::loadView('reports.articulos', compact('articulos'));
        return $pdf->download('articulos.pdf');
    }


}
