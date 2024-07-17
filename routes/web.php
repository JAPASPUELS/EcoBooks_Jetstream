<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SecurityQuestionController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\GastoController;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role:2'
])->group(function () {
    Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
});


Route::resource('vistas/categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',
    'store' => 'categorias.store',
    'edit' => 'categorias.edit',
    'update' => 'categorias.update',
    'destroy' => 'categorias.destroy'
]);

Route::resource('vistas/roles', RolesController::class)->names([
    'index' => 'roles.index',
    'store' => 'roles.store',
    'edit' => 'roles.edit',
    'update' => 'roles.update',
    'destroy' => 'roles.destroy'
]);

//Rutas para generar reportes
Route::get('/report/excel', [ReportController::class, 'exportExcel'])->name('report.excel');
Route::get('/report/pdf', [ReportController::class, 'exportPDF'])->name('report.pdf');


// Rutas para gestionar proveedores
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit']);
Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
Route::get('/reportprov/excel', [ReportController::class, 'exportExcelProveedores'])->name('reportprov.excel');
Route::get('reportprov/pdf', [ReportController::class, 'exportPDFProveedores'])->name('reportprov.pdf');


// Rutas de movimientos
// Route::resource('vistas/movimientos', MovimientoController::class)->names([
//     'index' => 'movimientos.index',
//     'store' => 'movimientos.store',
//     'edit' => 'movimientos.edit',
//     'update' => 'movimientos.update',
//     'destroy' => 'movimientos.destroy'
// ]);

Route::get('/charts', function () {
    return view('auditoria.index');
});

Route::get('/chart-data/{tableName}', [ChartController::class, 'getData'])->name('chart.data');
Route::resource('vistas/movimientos', MovimientoController::class)->names([
    'index' => 'movimientos.index',
]);

Route::resource('vistas/gastos', GastoController::class)->names([
    'index' => 'gastos.index',
    'store' => 'gastos.store',
    'edit' => 'gastos.edit',
    'update' => 'gastos.update',
    'destroy' => 'gastos.destroy',
]);


//Rutas para gestionar Articulos
Route::resource('articulos', ArticuloController::class);
Route::get('/reportart/excel', [ReportController::class, 'exportExcelArticulos'])->name('reportart.excel');
Route::get('/reportart/pdf', [ReportController::class, 'exportPDFArticulos'])->name('reportart.pdf');


// Rutas para gestionar Clientes
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit']);
Route::put('/clientes/{id}', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::get('/reportcli/excel', [ReportController::class, 'exportExcelClients'])->name('reportcli.excel');
Route::get('/reportcli/pdf', [ReportController::class, 'exportPDFClients'])->name('reportcli.pdf');



//Rutas para gestionar Ventas
Route::get('/ventas/create', [VentasController::class, 'create']);
Route::post('/ventas/add-product', [VentasController::class, 'addProduct']);
Route::get('/ventas/cliente/cedula/{cedula}', [VentasController::class, 'buscarPorCedula']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role:2'
])->group(function () {
    Route::resource('vistas/auditoria', AuditoriaController::class)->names([
        'index' => 'auditoria.index',
    ]);

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

Route::resource('vistas/roles', RolesController::class)->names([
    'index' => 'roles.index',
    'store' => 'roles.store',
    'edit' => 'roles.edit',
    'update' => 'roles.update',
    'destroy' => 'roles.destroy'
]);


// Route::resource('vistas/inventario', InventarioController::class)->names([
//     'index' => 'inventario.index',
// ]);

Route::get('vistas/inventario/detalle/{fecha}', [InventarioController::class, 'detalle'])->name('inventario.detalle');
Route::get('vistas/inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('vistas/inventario/nuevo', [InventarioController::class, 'nuevo'])->name('inventario.nuevo');


// Route::resource('vistas/users', UsersController::class)->names([
//     'index' => 'users.index',
//     // 'store' => 'roles.store',
//     // 'edit' => 'roles.edit',
//     // 'update' => 'roles.update',
//     // 'destroy' => 'roles.destroy'
// ]);
//Rutas para Recuperar contraseña

// Ruta para mostrar el formulario de opciones de recuperación de contraseña
Route::get('forgot-password-option', [ForgotPasswordController::class, 'showForgotPasswordOptionForm'])->name('password.option');
Route::post('forgot-password-option', [ForgotPasswordController::class, 'handleForgotPasswordOption'])->name('password.option.handle');
// Ruta para mostrar el formulario de la pregunta de seguridad
Route::get('forgot-password/security-question', [SecurityQuestionController::class, 'showSecurityQuestionForm'])->name('password.security-question');
Route::post('forgot-password/security-question', [SecurityQuestionController::class, 'verifySecurityQuestion'])->name('password.security.verify');
// Ruta para obtener la pregunta de seguridad basada en el correo electrónico
Route::post('get-security-question', [ForgotPasswordController::class, 'getSecurityQuestion'])->name('password.get-security-question');




// generacion de reportes
Route::get('/report/excel', [ReportController::class, 'exportExcel'])->name('report.excel');
Route::get('/report/pdf', [ReportController::class, 'exportPDF'])->name('report.pdf');

Route::get('/reportcli/excel', [ReportController::class, 'exportExcelClients'])->name('reportcli.excel');
Route::get('/reportcli/pdf', [ReportController::class, 'exportPDFClients'])->name('reportcli.pdf');

Route::get('/reportprov/excel', [ReportController::class, 'exportExcelProveedores'])->name('reportprov.excel');
Route::get('reportprov/pdf', [ReportController::class, 'exportPDFProveedores'])->name('reportprov.pdf');

Route::get('/reportaud/excel', [ReportController::class, 'exportExcelAuditoria'])->name('reportaud.excel');
Route::get('/reportaud/pdf', [ReportController::class, 'exportPDFAuditoria'])->name('reportaud.pdf');

Route::get('/reportmov/excel', [ReportController::class, 'exportExcelMovimiento'])->name('reportmov.excel');
Route::get('/reportmov/pdf', [ReportController::class, 'exportPDFMovimiento'])->name('reportmov.pdf');

Route::get('/reportgast/excel', [ReportController::class, 'exportExcelGasto'])->name('reportgast.excel');
Route::get('/reportgast/pdf', [ReportController::class, 'exportPDFGasto'])->name('reportgast.pdf');

Route::get('/reportinv/excel', [ReportController::class, 'exportExcelInventario'])->name('reportinv.excel');
Route::get('/reportinv/pdf', [ReportController::class, 'exportPDFInventario'])->name('reportinv.pdf');



// Rutas para gestionar proveedores
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit']);
Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');




//Formas de Pago
Route::resource('formaPago', FormaPagoController::class);

// Route::get('/auditoria', function() {
//     return view('auditoria.index');
// });


Route::post('/chart-data', [ChartController::class, 'getData'])->name('chart.data');


// Rutas para gestionar Clientess

Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit']);
Route::put('/clientes/{id}', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');




Route::get('/ventas/create', [VentasController::class, 'create']);
Route::post('/ventas/add-product', [VentasController::class, 'addProduct']);
Route::get('/ventas/cliente/cedula/{cedula}', [VentasController::class, 'buscarPorCedula']);
Route::resource('ventas', VentasController::class);

Route::resource('vistas/ventas', VentasController::class)->names([
    'index' => 'ventas.index',
    'create' => 'ventas.create',
    'store' => 'ventas.store',
    'show' => 'ventas.show',
    'edit' => 'ventas.edit',
    'update' => 'ventas.update',
    'destroy' => 'ventas.destroy'
]);


