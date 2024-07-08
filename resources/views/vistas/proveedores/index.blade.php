@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Proveedores -->
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div>
    <div>
        <div>
            <h3>Modificar Proveedor</h3>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" id="reportProvBtn">
                Reportes
            </button>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar...">
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Teléfono 1</th>
                        <th>Teléfono 2</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="proveedoresTable">
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td data-label="Nombre">{{ $proveedor->pro_nombre }}</td>
                            <td data-label="Dirección">{{ $proveedor->direccion_pro }}</td>
                            <td data-label="Email">{{ $proveedor->pro_email }}</td>
                            <td data-label="Teléfono 1">{{ $proveedor->pro_telefono1 }}</td>
                            <td data-label="Teléfono 2">{{ $proveedor->pro_telefono2 }}</td>
                            <td data-label="Acciones">
                                <button class="btn btn-edit" data-id="{{ $proveedor->pro_id }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-delete" data-id="{{ $proveedor->pro_id }}">
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

<div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="reportModal" aria-labelledby="modal-title"
role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-20 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Fondo oscuro transparente -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Contenedor principal del modal -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Encabezado del modal -->
                <div class="mt-3 text-center sm:items-start sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seleccionar Tipo de Reporte
                    </h3>
                    <!-- Botones de selección de reporte -->
                    <div class="mt-2 ">
                        <span class=" text-yellow-400">Version Pro ✨ </span>
                        <button
                            class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-500 text-yellow-400 font-medium  hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm opacity-50 cursor-not-allowed" disabled
                            id="vPro">
                            Filtros de Reportes
                        </button>
                    </div>
                    <div class="border-t border-gray-300 my-4"></div>
                    <div class="mt-2">
                        <button
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
                            id="excelBtn">
                            Excel
                        </button>
                        <button
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-900 text-white font-medium hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm"
                            id="pdfBtn">
                            PDF
                        </button>
                    </div>
                </div>
            </div>
            <!-- Botón para cerrar modal -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                    id="closeReportModal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

@include('vistas.proveedores.modal')

<script src="{{ asset('js/proveedores.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reportModal = document.getElementById('reportModal');
    const reportBtn = document.getElementById('reportProvBtn');
    const closeReportModalBtn = document.getElementById('closeReportModal');
    const excelBtn = document.getElementById('excelBtn');
    const pdfBtn = document.getElementById('pdfBtn');
    const searchInput = document.getElementById('searchInput');
    const proveedoresTable = document.getElementById('proveedoresTable');

    reportBtn.addEventListener('click', function() {
        reportModal.classList.remove('hidden');
    });

    closeReportModalBtn.addEventListener('click', function() {
        reportModal.classList.add('hidden');
    });

    excelBtn.addEventListener('click', function() {
        // Aquí puedes redirigir a la ruta de generación de reporte Excel
        window.location.href = "{{ route('reportprov.excel') }}";
    });

    pdfBtn.addEventListener('click', function() {
        // Aquí puedes redirigir a la ruta de generación de reporte PDF
        window.location.href = "{{ route('reportprov.pdf') }}";
    });

    // Filtrado de la tabla
    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        const rows = proveedoresTable.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    if (cells[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
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
