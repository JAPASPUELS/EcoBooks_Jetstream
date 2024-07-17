@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Articulos -->
<link rel="stylesheet" href="{{ asset('css/articulos.css') }}">

<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
    <div>
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900">Modificar Artículo</h3>
        </div>
        <div class="px-6 py-4 flex items-center space-x-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="reportArticulosBtn">
                Reportes
            </button>
            <form method="GET" action="{{ route('articulos.index') }}" class="flex items-center space-x-2">
                <select id="searchCriteria" name="criteria" class="custom-select">
                    <option value="nombre" {{ request('criteria') == 'nombre' ? 'selected' : '' }}>Buscar por Nombre</option>
                    <option value="categoria" {{ request('criteria') == 'categoria' ? 'selected' : '' }}>Buscar por Categoría</option>
                </select>
                <input type="text" id="searchInput" name="search" class="custom-input" placeholder="Buscar..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>
</div>

<h2 class="title-custom">Tabla de Articulos</h2>
<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
    <table id="dataTable" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidad de Medida</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody id="articulosTable" class="table bg-white divide-y divide-gray-200">
            @foreach($articulos as $articulo)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $articulo->art_nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $articulo->art_precio }}$</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $articulo->art_cantidad }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $articulo->art_unidades }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($articulo->categoria)->cat_name ?? 'Sin categoría' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $articulo->art_estado ? 'Activo' : 'Inactivo' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <button class="btn btn-edit" data-id="{{ $articulo->art_id }}">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn btn-status" data-id="{{ $articulo->art_id }}" data-estado="{{ $articulo->art_estado }}">
                        <i class='bx bx-refresh'></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div class="pagination-links flex justify-between px-6 py-4">
        @if ($articulos->hasPages())
        <ul class="pagination flex justify-center mt-4 mb-4">
            @if ($articulos->onFirstPage())
            <li class="page-item disabled"><span class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Anterior</span></li>
            @else
            <li class="page-item"><a href="{{ $articulos->previousPageUrl() }}&search={{ request('search') }}&criteria={{ request('criteria') }}" class="page-link">Anterior</a></li>
            @endif

            @foreach ($articulos->getUrlRange(1, $articulos->lastPage()) as $page => $url)
            @if ($page == $articulos->currentPage())
            <li class="page-item active"><span class="page-link bg-blue-500 text-white">{{ $page }}</span></li>
            @else
            <li class="page-item"><a href="{{ $url }}&search={{ request('search') }}&criteria={{ request('criteria') }}" class="page-link">{{ $page }}</a></li>
            @endif
            @endforeach

            @if ($articulos->hasMorePages())
            <li class="page-item"><a href="{{ $articulos->nextPageUrl() }}&search={{ request('search') }}&criteria={{ request('criteria') }}" class="page-link">Siguiente</a></li>
            @else
            <li class="page-item disabled"><span class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Siguiente</span></li>
            @endif
        </ul>
        @endif
        <p class="text-sm text-gray-500 px-4 py-4">
            Mostrando {{ $articulos->firstItem() }} - {{ $articulos->lastItem() }} de {{ $articulos->total() }} registros
        </p>
    </div>
</div>

<div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="reportModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-20 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Fondo oscuro transparente -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Contenedor principal del modal -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Encabezado del modal -->
                <div class="mt-3 text-center sm:items-start sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seleccionar Tipo de Reporte
                    </h3>
                    <!-- Botones de selección de reporte -->
                    <div class="mt-2 ">
                        <span class=" text-yellow-400">Versión Pro ✨ </span>
                        <button class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-500 text-yellow-400 font-medium hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm opacity-50 cursor-not-allowed" disabled id="vPro">
                            Filtros de Reportes
                        </button>
                    </div>
                    <div class="border-t border-gray-300 my-4"></div>
                    <div class="mt-2">
                        <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm" id="excelBtn">
                            Excel
                        </button>
                        <button class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-900 text-white font-medium hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm" id="pdfBtn">
                            PDF
                        </button>
                    </div>
                </div>
            </div>
            <!-- Botón para cerrar modal -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" id="closeReportModal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

@include('vistas.articulos.modal')

<script src="{{ asset('js/articulos.js') }}"></script>

@endsection