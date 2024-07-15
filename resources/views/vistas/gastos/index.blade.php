@extends('dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> --}}


    <style>
        /* proveedores.css */
        #dataTable th,
        #dataTable td {
            padding: 12px 15px;
            text-align: left;
        }

        #dataTable th {
            background-color: #f1f5f9;
            font-weight: bold;
            text-transform: uppercase;
        }

        #dataTable tr:nth-child(even) {
            background-color: #f9fafb;
        }

        #dataTable tr:hover {
            background-color: #f1f5f9;
        }

        .pagination-links .page-link {
            padding: 8px 12px;
            margin: 0 4px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            color: #374151;
            text-decoration: none;
        }

        .pagination-links .page-link:hover {
            background-color: #e5e7eb;
            border-color: #d1d5db;
        }

        /* Set a minimum height for tbody to keep the table height consistent */
        tbody {
            display: block;
            min-height: 400px;
            /* Adjust this value as needed */
        }

        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
    </style>

    {{-- <div class="mt-5 flex justify-center ">
        <div class="flex items-center ">
            <div class="relative text-center">
                <label for="datepicker-range-start"
                    class="block text-blue-500 font-bold text-4xl">$ {{ $calculateValue }}</label>
                <label for="datepicker-range-start" class="block text-gray-700 text-sm ">Total
                    Gastos</label>
            </div>
        </div>
    </div> --}}
    <div>
        <!-- Filtros de selección de usuario, fechas, productos y búsqueda -->
        <form method="GET" action="{{ route('gastos.index') }}"
            class="pl-16 flex justify-center mb-5 bg-gray-100 p-2 rounded-lg shadow-md">
            <div class="flex items-center mr-8">
                <div class="relative text-center">
                    <label for="datepicker-range-start" class="block text-blue-500 font-bold text-4xl">$
                        {{ $calculateValue }}</label>
                    <label for="datepicker-range-start" class="block text-gray-700 text-sm ">Total
                        Gastos</label>
                </div>
            </div>

            <!-- Date Range Picker -->
            <div id="date-range-picker" class="flex items-center mr-5 mt-5 mb-5">
                <div class="relative mr-4">
                    <label for="datepicker-range-start" class="block text-gray-700 text-sm font-bold mb-2">Fecha
                        Inicio</label>
                    <input id="datepicker-range-start" name="fechaInicio" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-4 py-2.5 placeholder-gray-400"
                        placeholder="Seleccionar fecha inicio">
                </div>
                <div class="relative">
                    <label for="datepicker-range-end" class="block text-gray-700 text-sm font-bold mb-2">Fecha Fin</label>
                    <input id="datepicker-range-end" name="fechaFin" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-4 py-2.5 placeholder-gray-400"
                        placeholder="Seleccionar fecha fin">
                </div>
            </div>

            <!-- Dropdown de Usuarios -->
            <div class="relative mr-5 mt-5 mb-5">
                <label for="userDropdown" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Usuario</label>
                <select id="userDropdown" name="usuario"
                    class="block appearance-none w-48 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="0">TODO</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Búsqueda General -->
            <div class="relative mr-5 mt-5 mb-5">
                <label for="searchInput" class="block text-gray-700 text-sm font-bold mb-2">Búsqueda General</label>
                <input id="searchInput" name="searchTerm" type="text"
                    class="block w-64 px-4 py-2 pr-8 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                    placeholder="Buscar...">
            </div>

            <!-- Botón de Filtrado -->
            <div class="mt-12 mb-7">
                <button type="submit" id="filterButton"
                    class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Filtrar</button>
            </div>
            <!-- Botón de agregar nuevo registro -->
            <div class="mt-12 mb-7">

                <button type="button" id="addBtn"
                    class="bg-indigo-500 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg ml-3">Nuevo</button>
            </div>

            <!-- Botón de Reportes -->
            <div class="mt-12 mb-7">
                <button type="button" id="reportBtn"
                    class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-lg ml-3">Reportes</button>
            </div>
        </form>

        <!-- Tabla de auditoría -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table id="dataTable" class=" table table-striped table-hover">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descripción</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor
                        </th>
                        <th
                            scope="col"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credo Por
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                        </th>
                    </tr>
                </thead>
                <tbody id="auditoriaTableBody" class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">{{ $item->gast_id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                {{ $item->gast_descripcion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">$ {{ $item->gast_valor }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">{{ $item->gast_fecha }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">{{ $item->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                <div class="action-icons">
                                    <button onclick="openEditModal({{ $item->gast_id }})" class="btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal({{ $item->gast_id }})" class="btn btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-links flex justify-between">

                @if ($data->hasPages())
                    <ul class="pagination flex justify-center mt-4 mb-4">
                        @if ($data->onFirstPage())
                            <li class="page-item disabled"><span
                                    class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Anterior</span></li>
                        @else
                            <li class="page-item"><a href="{{ $data->previousPageUrl() }}" class="page-link">Anterior</a>
                            </li>
                        @endif

                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            @if ($page == $data->currentPage())
                                <li class="page-item active"><span
                                        class="page-link bg-blue-500 text-white">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a href="{{ $url }}"
                                        class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($data->hasMorePages())
                            <li class="page-item"><a href="{{ $data->nextPageUrl() }}" class="page-link">Siguiente</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span
                                    class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Siguiente</span></li>
                        @endif

                    </ul>
                @endif
                <p class="text-sm text-gray-500 px-4 py-4">
                    Mostrando {{ $data->firstItem() }} - {{ $data->lastItem() }} de {{ $data->total() }} registros
                </p>

            </div>

        </div>
    </div>

    <!-- Modal para selección de reportes -->
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
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seleccionar Tipo de
                            Reporte
                        </h3>
                        <!-- Botones de selección de reporte -->
                        <div class="mt-2 ">
                            <span class=" text-yellow-400">Version Pro ✨ </span>
                            <button
                                class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-500 text-yellow-400 font-medium  hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm opacity-50 cursor-not-allowed"
                                disabled id="vPro">
                                Filtros de Reportes
                            </button>
                        </div>
                        <div class="border-t border-gray-300 my-4"></div>
                        <div class="mt-2 ">
                            <button
                                class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
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


    <!-- Modal para Editar -->
    <div id="editModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    {{-- <div class="sm:flex sm:items-start"> --}}
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Editar Gasto
                            </h3>
                            <button onclick="closeEditModal()" class="text-red-500">&times;</button>
                        </div>

                        <div class="mt-2">
                            <form id="editForm" method="POST" action="">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="editDescripcion">Descripción</label>
                                    <textarea type="text" name="gast_descripcion" id="editDescripcion" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="editValor">Valor</label>
                                    <input type="text" name="gast_valor" id="editValor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="editFecha">Fecha</label>
                                    <input type="date" name="gast_fecha" id="editFecha" class="form-control"
                                        disabled>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="editUsuario">Usuario</label>
                                    <select name="created_by" id="editUsuario" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  --}}
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse justify-between">

                                    <button type="submit"
                                        class="btn bg-blue-500 rounded-lg px-4 py-2 text-white hover:bg-blue-700">Actualizar</button>
                                    <button type="button"
                                        class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded-lg mr-2"
                                        onclick="closeEditModal()">Cancelar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
                {{-- <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeEditModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar -->
    <div id="deleteModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Eliminar Gasto
                            </h3>
                            <div class="mt-2">
                                <p>¿Estás seguro de que quieres eliminar este gasto?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Eliminar
                        </button>
                    </form>
                    <button onclick="closeDeleteModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar nuevo registro -->
    <div id="addModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    {{-- <div class="sm:flex sm:items-start"> --}}
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Agregar Nuevo Registro
                        </h3>
                        <div class="mt-2">
                            <form id="addForm" method="POST" action="{{ route('gastos.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="descripcion"
                                        class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <input type="text" id="descripcion" name="descripcion"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                                    <input type="number" id="valor" name="valor" step="0.01"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>
                                {{-- <div class="mb-4">
                                        <label for="fecha"
                                            class="block text-sm font-medium text-gray-700">Fecha</label>
                                        <input type="date" id="fecha" name="fecha"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="usuario"
                                            class="block text-sm font-medium text-gray-700">Usuario</label>
                                        <select id="usuario" name="usuario"
                                            class="block appearance-none w-full px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                <div class="flex justify-between">
                                    <button type="button" onclick="closeAddModal()"
                                        class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded-lg mr-3">Cancelar</button>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addBtn');
            const addModal = document.getElementById('addModal');
            const addForm = document.getElementById('addForm');

            addBtn.addEventListener('click', function() {
                addModal.classList.remove('hidden');
            });

            window.closeAddModal = function() {
                addModal.classList.add('hidden');
                addForm.reset();
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportModal = document.getElementById('reportModal');
            const reportBtn = document.getElementById('reportBtn');
            const closeReportModalBtn = document.getElementById('closeReportModal');
            const excelBtn = document.getElementById('excelBtn');
            const pdfBtn = document.getElementById('pdfBtn');


            const addBtn = document.getElementById('addBtn');
            const addModal = document.getElementById('addModal');
            const addForm = document.getElementById('addForm');

            addBtn.addEventListener('click', function() {
                addModal.classList.remove('hidden');
            });

            window.closeAddModal = function() {
                addModal.classList.add('hidden');
                addForm.reset();
            }



            // Evita que el formulario se envíe y recargue la página al hacer clic en el botón de generar reporte
            document.getElementById('reportBtn').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('reportModal').classList.remove('hidden');
            });

            reportBtn.addEventListener('click', function() {
                reportModal.classList.remove('hidden');
            });

            closeReportModalBtn.addEventListener('click', function() {
                reportModal.classList.add('hidden');
            });

            excelBtn.addEventListener('click', function() {
                // Aquí puedes redirigir a la ruta de generación de reporte Excel
                window.location.href = "{{ route('reportgast.excel') }}";
            });

            pdfBtn.addEventListener('click', function() {
                // Aquí puedes redirigir a la ruta de generación de reporte PDF
                window.location.href = "{{ route('reportgast.pdf') }}";
            });

            // Función para abrir el modal de editar

        });

        function openEditModal(id) {
            fetch(`/vistas/gastos/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editDescripcion').value = data.gasto.gast_descripcion;
                    document.getElementById('editValor').value = data.gasto.gast_valor;
                    // Formatear la fecha en aaaa-mm-dd
                    document.getElementById('editFecha').value = new Date(data.gasto.gast_fecha).toISOString().slice(0,
                        10);
                    // document.getElementById('editUsuario').value = data.gasto.created_by;
                    document.getElementById('editForm').action = `/vistas/gastos/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                });
        }
        // Función para cerrar el modal de editar
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Función para abrir el modal de eliminar
        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `/vistas/gastos/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Función para cerrar el modal de eliminar
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

      
    </script>
@endsection
