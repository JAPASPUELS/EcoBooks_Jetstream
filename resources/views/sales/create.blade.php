@extends('dashboard')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-lg font-bold">Nueva Factura</h1>
    <div>
        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Nuevo Producto
        </button>
        <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Nuevo Cliente
        </button>
        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-print mr-2"></i> Imprimir
        </button>
        <button type="button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-box-open mr-2"></i> Agregar Productos
        </button>
    </div>
</div>

<form>
    <!-- Botones para acciones -->
    <div class="mb-4">
        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Nuevo Producto
        </button>
        <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Nuevo Cliente
        </button>
        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-print mr-2"></i> Imprimir
        </button>
        <button type="button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <i class="fas fa-box-open mr-2"></i> Agregar Productos
        </button>
    </div>

    <!-- Tabla de productos agregados -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <!-- Filas de productos -->
        </tbody>
    </table>
</form>

@endsection
