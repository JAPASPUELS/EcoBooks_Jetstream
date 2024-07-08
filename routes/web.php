<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role:2'])->group(function () {
    Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
});


Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit']);
Route::put('/clientes/{id}', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

Route::resource('vistas/categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',
    'store' => 'categorias.store',
    'edit' => 'categorias.edit',
    'update' => 'categorias.update',
    'destroy' => 'categorias.destroy'
]);


Route::get('/report/excel', [ReportController::class, 'exportExcel'])->name('report.excel');
Route::get('/report/pdf', [ReportController::class, 'exportPDF'])->name('report.pdf');

Route::get('/reportcli/excel', [ReportController::class, 'exportExcelClients'])->name('reportcli.excel');
Route::get('/reportcli/pdf', [ReportController::class, 'exportPDFClients'])->name('reportcli.pdf');

// Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
// Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
// Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');


// Rutas para gestionar proveedores
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit']);
Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

Route::get('/reportprov/excel', [ReportController::class, 'exportExcelProveedores'])->name('reportprov.excel');
Route::get('reportprov/pdf', [ReportController::class, 'exportPDFProveedores'])->name('reportprov.pdf');






//Rutas para gestionar inventario
Route::get('/inventario/create', [InventarioController::class, 'create'])->name('inventario.create');

// Rutas para gestionar Clientess
// routes/web.php

Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit']);
Route::put('/clientes/{id}', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');




Route::get('/ventas/create', [VentasController::class, 'create']);
Route::post('/ventas/add-product', [VentasController::class, 'addProduct']);
Route::get('/ventas/cliente/cedula/{cedula}', [VentasController::class, 'buscarPorCedula']);

Route::resource('vistas/ventas', VentasController::class)->names([
    'index' => 'ventas.index',
    'create' => 'ventas.create',
    'store' => 'ventas.store',
    'show' => 'ventas.show',
    'edit' => 'ventas.edit',
    'update' => 'ventas.update',
    'destroy' => 'ventas.destroy'
]);


// ! auditoria 
// Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
// Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');