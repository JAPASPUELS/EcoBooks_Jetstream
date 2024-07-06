<?php
namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Articulo;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriesExport;
use App\Exports\ClientesExport;
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
}
