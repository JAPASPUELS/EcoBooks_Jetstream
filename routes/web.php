<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentasController;

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