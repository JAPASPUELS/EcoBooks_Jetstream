@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Articulos -->
<link rel="stylesheet" href="{{ asset('css/articulos.css') }}">

<div>
    <div>
        <div>
            <h3>Modificar Artículo</h3>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" id="reportArticulosBtn">
                Reportes
            </button>
        </div>
        <div>
            <form method="GET" action="{{ route('articulos.index') }}">
                <div class="mb-4">
                    <select id="searchCriteria" name="criteria" class="form-control mb-2">
                        <option value="nombre">Buscar por Nombre</option>
                        <option value="categoria">Buscar por Categoría</option>
                    </select>
                    <input type="text" id="searchInput" name="search" class="form-control" placeholder="Buscar...">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Unidad de Medida</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="articulosTable">
                    @foreach($articulos as $articulo)
                    <tr>
                        <td data-label="Nombre">{{ $articulo->art_nombre }}</td>
                        <td data-label="Precio">{{ $articulo->art_precio }}$</td>
                        <td data-label="Cantidad">{{ $articulo->art_cantidad }}</td>
                        <td data-label="Unidad de Medida">{{ $articulo->art_unidades }}</td>
                        <td data-label="Categoría">{{ optional($articulo->categoria)->cat_name ?? 'Sin categoría' }}</td>
                        <td data-label="Acciones">
                            <button class="btn btn-edit" data-id="{{ $articulo->art_id }}">
                                <i class='bx bx-edit'></i>
                            </button>
                            <button class="btn btn-delete" data-id="{{ $articulo->art_id }}">
                                <i class='bx bx-trash'></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Paginación -->
<div class="d-flex justify-content-center">
    {{ $articulos->appends(request()->input())->links() }}
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
                        <span class=" text-yellow-400">Version Pro ✨ </span>
                        <button class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-500 text-yellow-400 font-medium  hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm opacity-50 cursor-not-allowed" disabled id="vPro">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reportModal = document.getElementById('reportModal');
        const reportBtn = document.getElementById('reportArticulosBtn');
        const closeReportModalBtn = document.getElementById('closeReportModal');
        const excelBtn = document.getElementById('excelBtn');
        const pdfBtn = document.getElementById('pdfBtn');
        const searchInput = document.getElementById('searchInput');
        const searchCriteria = document.getElementById('searchCriteria');
        const articulosTable = document.getElementById('articulosTable');

        reportBtn.addEventListener('click', function() {
            reportModal.classList.remove('hidden');
        });

        closeReportModalBtn.addEventListener('click', function() {
            reportModal.classList.add('hidden');
        });

        excelBtn.addEventListener('click', function() {
            // Aquí puedes redirigir a la ruta de generación de reporte Excel
            window.location.href = "{{ route('reportart.excel') }}";
        });

        pdfBtn.addEventListener('click', function() {
            // Aquí puedes redirigir a la ruta de generación de reporte PDF
            window.location.href = "{{ route('reportart.pdf') }}";
        });

        // Filtrado de la tabla
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const criteria = searchCriteria.value;
            const rows = articulosTable.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        if ((criteria === 'nombre' && cells[0].innerHTML.toLowerCase().indexOf(filter) > -1) ||
                            (criteria === 'categoria' && cells[3].innerHTML.toLowerCase().indexOf(filter) > -1)) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    });
</script>
@endsection