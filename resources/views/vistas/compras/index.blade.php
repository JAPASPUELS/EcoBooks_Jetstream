@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Compras -->
<link rel="stylesheet" href="{{ asset('css/compras.css') }}">

<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
    <div>
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900">Modificar Compras</h3>
        </div>
        <div class="px-6 py-4 flex items-center space-x-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="reportComprasBtn">
                Reportes
            </button>
            <form method="GET" action="{{ route('compras.index') }}" class="flex items-center space-x-2">
                <select id="searchCriteria" name="criteria" class="custom-select">
                    <option value="articulo">Buscar por Artículo</option>
                    <option value="proveedor">Buscar por Proveedor</option>
                </select>
                <input type="text" id="searchInput" name="search" class="custom-input" placeholder="Buscar...">
            </form>
        </div>
    </div>
</div>

<h2 class="title-custom">Tabla de Compras</h2>
<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
    <table id="dataTable" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Artículo</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proveedor</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número de Factura</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalles</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado por</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody id="comprasTable" class="table bg-white divide-y divide-gray-200">
            @foreach($compras as $compra)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $compra->articulo->art_nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->proveedor->pro_nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->comp_numfac }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->comp_cantidad }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->com_detalles }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $compra->user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <button class="btn btn-edit" data-id="{{ $compra->comp_id }}">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn btn-delete" data-id="{{ $compra->comp_id }}">
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-links flex justify-between px-6 py-4">
        @if ($compras->hasPages())
        <ul class="pagination flex justify-center mt-4 mb-4">
            @if ($compras->onFirstPage())
            <li class="page-item disabled"><span class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Anterior</span></li>
            @else
            <li class="page-item"><a href="{{ $compras->previousPageUrl() }}" class="page-link">Anterior</a></li>
            @endif

            @foreach ($compras->getUrlRange(1, $compras->lastPage()) as $page => $url)
            @if ($page == $compras->currentPage())
            <li class="page-item active"><span class="page-link bg-blue-500 text-white">{{ $page }}</span></li>
            @else
            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
            @endif
            @endforeach

            @if ($compras->hasMorePages())
            <li class="page-item"><a href="{{ $compras->nextPageUrl() }}" class="page-link">Siguiente</a></li>
            @else
            <li class="page-item disabled"><span class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Siguiente</span></li>
            @endif
        </ul>
        @endif
        <p class="text-sm text-gray-500 px-4 py-4">
            Mostrando {{ $compras->firstItem() }} - {{ $compras->lastItem() }} de {{ $compras->total() }} registros
        </p>
    </div>
</div>

<div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="reportModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-20 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 text-center sm:items-start sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seleccionar Tipo de Reporte</h3>
                    <div class="mt-2">
                        <span class="text-yellow-400">Versión Pro ✨</span>
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
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" id="closeReportModal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

@include('vistas.compras.modal')

<script src="{{ asset('js/compras.js') }}"></script>
@endsection