<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\CategoriaController;

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

Route::resource('vistas/ventas', VentasController::class)->names([
    'index' => 'ventas.index',
    'create' => 'ventas.create',
    'store' => 'ventas.store',
    'show' => 'ventas.show',
    'edit' => 'ventas.edit',
    'update' => 'ventas.update',
    'destroy' => 'ventas.destroy'
]);

Route::resource('vistas/categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',
    'create' => 'categorias.create',
    'store' => 'categorias.store',
    'show' => 'categorias.show',
    'edit' => 'categorias.edit',
    'update' => 'categorias.update',
    // 'destroy' => 'categorias.destroy'
]);

Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');


// Rutas para gestionar proveedores
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit']);
Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');



// ! auditoria 
Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
// Route::get('/auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');