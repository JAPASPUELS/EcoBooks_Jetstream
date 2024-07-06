@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Clientes -->
<link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

<div>
    <div>
        <div>
            <h3>Modificar Cliente</h3>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" id="reportCliBtn">
                Reportes
            </button>
        </div>
        <div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Identificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td data-label="Código">{{ $cliente->cli_codigo }}</td>
                            <td data-label="Nombre">{{ $cliente->cli_nombre }}</td>
                            <td data-label="Apellido">{{ $cliente->cli_apellido }}</td>
                            <td data-label="Correo">{{ $cliente->cli_correo }}</td>
                            <td data-label="Dirección">{{ $cliente->cli_direccion }}</td>
                            <td data-label="Identificación">{{ $cliente->cli_identificacion }}</td>
                            <td data-label="Acciones">
                                <button class="btn btn-edit" data-id="{{ $cliente->cli_codigo }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-delete" data-id="{{ $cliente->cli_codigo }}">
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
                <div class="mt-2">
                    <button
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
                        id="excelBtn">
                        Excel
                    </button>
                    <button
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-900 text-white font-medium  hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm"
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

@include('vistas.clientes.modal')

<script src="{{ asset('js/clientes.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reportModal = document.getElementById('reportModal');
    const reportBtn = document.getElementById('reportCliBtn');
    const closeReportModalBtn = document.getElementById('closeReportModal');
    const excelBtn = document.getElementById('excelBtn');
    const pdfBtn = document.getElementById('pdfBtn');

    reportBtn.addEventListener('click', function() {
        reportModal.classList.remove('hidden');
    });

    closeReportModalBtn.addEventListener('click', function() {
        reportModal.classList.add('hidden');
    });

    excelBtn.addEventListener('click', function() {
        // Aquí puedes redirigir a la ruta de generación de reporte Excel
        window.location.href = "{{ route('reportcli.excel') }}";
    });

    pdfBtn.addEventListener('click', function() {
        // Aquí puedes redirigir a la ruta de generación de reporte PDF
        window.location.href = "{{ route('reportcli.pdf') }}";
    });

    
});
</script>
@endsection
