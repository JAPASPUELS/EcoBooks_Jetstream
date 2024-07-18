@extends('dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

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

    <div class="mt-5">
        <!-- Filtros de selección de usuario, fechas, productos y búsqueda -->
        <form method="GET" action="{{ route('inventario.index') }}"
            class="pl-16 flex justify-center mb-5 bg-gray-100 p-4 rounded-lg shadow-md">

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

            {{-- <!-- Dropdown de Productos -->
            <div class="relative mr-5 mt-5 mb-5">
                <label for="productDropdown" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Producto</label>
                <select id="productDropdown" name="producto"
                    class="block appearance-none w-48 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="0">TODO</option>
                    @foreach ($products as $producto)
                        <option value="{{ $producto->art_id }}">{{ $producto->art_nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Dropdown de Tipo de Transaccion --}}
            {{-- <div class="relative mr-5 mt-5 mb-5">
                <label for="tipoDropdown" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Tipo</label>
                <select id="tipoDropdown" name="tipo"
                    class="block appearance-none w-48 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="todo">TODO</option>
                    <option value="INGRESO">INGRESO</option>
                    <option value="EGRESO">EGRESO</option>
                    <option value="AJUSTE">AJUSTE</option>
                </select>
            </div>  --}}

            <!-- Búsqueda General -->
            {{-- <div class="relative mr-5 mt-5 mb-5">
                <label for="searchTerm" class="block text-gray-700 text-sm font-bold mb-2">Búsqueda General</label>
                <input id="searchTerm" name="searchTerm" type="text"
                    class="block w-64 px-4 py-2 pr-8 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                    placeholder="Buscar...">
            </div> --}}

            <!-- Botón de Filtrado -->
            <div class="mt-12 mb-7">
                <button type="submit" id="filterButton"
                    class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">Filtrar</button>
            </div>
            <!-- Botón de agregar nuevo registro -->
            <div class="mt-12 mb-7">

                <button type="button" id="openModalnInventarioBtn"
                    class="bg-indigo-500 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg ml-3">Nuevo</button>
            </div>
        </form>

        <!-- Tabla de auditoría -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Inventario Fecha
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad
                            Total de Inventario</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado
                            Por</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                        </th>
                    </tr>
                </thead>
                <tbody id="auditoriaTableBody" class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->inv_fecha }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->total_cantidad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button
                                    class="btn btn-edit bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-lg ml-3"
                                    data-fecha="{{ $item->inv_fecha }}" onclick="openModal('{{ $item->inv_fecha }}')">
                                    <i class='fas fa-eye'></i> Detalle de Inventario
                                </button>
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
    <div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="reportModal" role="dialog" aria-modal="true">
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

    <!-- Modal -->
    <div id="detalleModal" class="fixed ml-10 inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-left">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="ml-7 text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Detalle de Inventario
                    </h3>
                    <button onclick="closeModal()" class="text-red-500 mr-9" id="closeModal">&times;</button>
                </div>
                <div class="ml-7 mt-1 mb-1 justify-start">
                    <button type="button" id="reportBtn"
                        class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-lg ">Reporte</button>
                </div>
                <div class="mt-2
                        px-7 py-3">
                    <div id="detalleContent"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div id="nInventarioModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden ml-14">
        <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-left">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="ml-7 text-lg leading-6 font-medium text-gray-900" id="modal-title-inv">
                        Nuevo Inventario
                    </h3>
                    <button class="text-red-500 mr-9" id="closeModalnInventario">&times;</button>
                </div>
                <div class="mt-2 px-7 py-3">
                    <button id="saveButton"
                        class="bg-green-500 hover:bg-green-700 px-3 py-2 text-white my-2 rounded-lg">Guardar
                        Inventario</button>
                    <div id="detalleContentnInventario"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const closeModalnInventarioButton = document.getElementById('closeModalnInventario');
        //     const openModalnInventarioButton = document.getElementById('openModalnInventarioBtn');
        //     const today = new Date().toISOString().split('T')[0];
        //     document.getElementById('modal-title-inv').innerText = 'Nuevo Inventario ' + today;

        //     if (closeModalnInventarioButton) {
        //         closeModalnInventarioButton.addEventListener('click', function(event) {
        //             event.preventDefault();
        //             document.getElementById('nInventarioModal').classList.add('hidden');
        //         });
        //     }

        //     if (openModalnInventarioButton) {
        //         openModalnInventarioButton.addEventListener('click', function(event) {
        //             event.preventDefault();
        //             openModalnInventario();
        //         });
        //     }

        //     function openModalnInventario() {
        //         fetch(`/vistas/inventario/nuevo`)
        //             .then(response => response.text())
        //             .then(html => {
        //                 document.getElementById('detalleContentnInventario').innerHTML = html;
        //                 document.getElementById('nInventarioModal').classList.remove('hidden');
        //                 attachTableEventListeners();
        //             });
        //     }

        //     function attachTableEventListeners() {
        //         const inputsInventariada = document.querySelectorAll('.inventariada-input');
        //         const editButtons = document.querySelectorAll('.edit-btn');
        //         const cantidadInputs = document.querySelectorAll('.cantidad-input');

        //         inputsInventariada.forEach(input => {
        //             input.addEventListener('input', function() {
        //                 const row = input.closest('tr');
        //                 const cantidadProducto = row.querySelector('.cantidad-input').value;
        //                 const validationIcon = row.querySelector('.validation-icon');

        //                 if (input.value == cantidadProducto) {
        //                     validationIcon.innerHTML =
        //                         '<i class="fas fa-check text-green-500"></i>';
        //                 } else {
        //                     validationIcon.innerHTML = '<i class="fas fa-times text-red-500"></i>';
        //                 }
        //             });
        //         });

        //         editButtons.forEach(button => {
        //             button.addEventListener('click', function() {
        //                 const row = button.closest('tr');
        //                 const cantidadInput = row.querySelector('.cantidad-input');
        //                 cantidadInput.disabled = !cantidadInput.disabled;

        //                 if (!cantidadInput.disabled) {
        //                     cantidadInput.focus();
        //                 }
        //             });
        //         });

        //         const saveButton = document.getElementById('saveButton');
        //         if (saveButton) {
        //             saveButton.addEventListener('click', function() {
        //                 const changes = [];
        //                 cantidadInputs.forEach(input => {
        //                     if (!input.disabled) {
        //                         const row = input.closest('tr');
        //                         changes.push({
        //                             id: row.dataset.id,
        //                             cantidad: input.value
        //                         });
        //                     }
        //                 });

        //                 console.log('Changes:', changes);

        //                 // Aquí puedes enviar el array de cambios al backend utilizando AJAX o un formulario oculto
        //             });
        //         }
        //     }

        //     attachTableEventListeners();
        // });
        function fetchPage(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('detalleContent').innerHTML = html;
                });
        }

        function openModal(fecha) {
            fetch(`/vistas/inventario/detalle/${fecha}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar los datos');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('detalleContent').innerHTML = html;
                    document.getElementById('detalleModal').classList.remove('hidden');
                    document.getElementById('reportBtn').onclick = function() {
                        generateReport(fecha);
                    };
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Aquí puedes manejar el error mostrando un mensaje al usuario o realizando alguna acción adecuada
                });
        }


        const closeReportModalBtn = document.getElementById('closeReportModal');
        closeReportModalBtn.addEventListener('click', function() {
            reportModal.classList.add('hidden');
        });

        function generateReport(fecha) {
            document.getElementById('reportModal').classList.remove('hidden');

            document.getElementById('excelBtn').onclick = function() {
                window.location.href = `/reportinv/excel?fecha=${fecha}`;
            };

            document.getElementById('pdfBtn').onclick = function() {
                window.location.href = `/reportinv/pdf?fecha=${fecha}`;
            };
        }

        function closeModal() {
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('detalleModal').classList.add('hidden');
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const closeModalnInventarioButton = document.getElementById('closeModalnInventario');
            const openModalnInventarioButton = document.getElementById('openModalnInventarioBtn');
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('modal-title-inv').innerText = 'Nuevo Inventario ' + today;






            if (closeModalnInventarioButton) {
                closeModalnInventarioButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('nInventarioModal').classList.add('hidden');
                });
            }

            if (openModalnInventarioButton) {
                openModalnInventarioButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    openModalnInventario();
                });
            }

            function openModalnInventario() {
                fetch(`/vistas/inventario/nuevo`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('detalleContentnInventario').innerHTML = html;
                        document.getElementById('nInventarioModal').classList.remove('hidden');
                        attachTableEventListeners();
                    })
                    .catch(error => {
                        console.error('Error loading modal content:', error);
                    });
            }

            function attachTableEventListeners() {
                const inputsInventariada = document.querySelectorAll('.inventariada-input');
                const editButtons = document.querySelectorAll('.edit-btn');
                const cantidadInputs = document.querySelectorAll('.cantidad-input');

                inputsInventariada.forEach(input => {
                    input.addEventListener('input', function() {
                        const row = input.closest('tr');
                        const cantidadProducto = row.querySelector('.cantidad-input').value;
                        const validationIcon = row.querySelector('.validation-icon');

                        if (input.value == cantidadProducto) {
                            validationIcon.innerHTML =
                                '<i class="fas fa-check text-green-500"></i>';
                        } else {
                            validationIcon.innerHTML = '<i class="fas fa-times text-red-500"></i>';
                        }
                    });
                });

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const row = button.closest('tr');
                        const cantidadInput = row.querySelector('.cantidad-input');
                        cantidadInput.disabled = !cantidadInput.disabled;

                        if (!cantidadInput.disabled) {
                            cantidadInput.focus();
                        }
                    });
                });

                const saveButton = document.getElementById('saveButton');
            //     if (saveButton) {
            //         saveButton.addEventListener('click', function() {
            //             const changes = [];
            //             const allinventoryitems = [];
            //             cantidadInputs.forEach(input => {
            //                 if (!input.disabled) {
            //                     const row = input.closest('tr');
            //                     changes.push({
            //                         id: row.dataset.id,
            //                         cantidad: input.value
            //                     });
            //                 }
            //             });
            //             inputsInventariada.forEach(input => {
            //                 const row = input.closest('tr');
            //                 allinventoryitems.push({
            //                     id: row.dataset.id,
            //                     cantidad: input.value
            //                 });
            //             });
            //             Swal.fire({
            //                 title: '¿Estás seguro?',
            //                 text: "Se registrara el inventario co la data ingresada!",
            //                 icon: 'warning',
            //                 showCancelButton: true,
            //                 confirmButtonColor: '#3085d6',
            //                 cancelButtonColor: '#d33',
            //                 confirmButtonText: 'Sí, Guardar!'
            //             }).then((result) => {
            //                 if (result.isConfirmed) {
            //                     fetch(`/vistas/inventario/save`, {
            //                             method: 'POST',
            //                             headers: {
            //                                 'Content-Type': 'application/json',
            //                                 'X-CSRF-TOKEN': document.querySelector(
            //                                         'meta[name="csrf-token"]')
            //                                     .getAttribute('content')
            //                             },
            //                             body: JSON.stringify({
            //                                 changes,
            //                                 allInventory
            //                             })
            //                         })
            //                         .then(response => response.json())
            //                         .then(data => {
            //                             if (data.success) {
            //                                 Swal.fire(
            //                                     'Inventario Agregado!',
            //                                     'Inventario Agregado exitosamente.',
            //                                     'success'
            //                                 ).then(() => {
            //                                     location.reload();
            //                                 });
            //                             } else {
            //                                 Swal.fire(
            //                                     'Error!',
            //                                     data.message,
            //                                     'error'
            //                                 );
            //                             }
            //                         });
            //                 }
            //             });
            //             // console.log('Changes:', changes);
            //             // console.log('Changes:', allinventoryitems);

            //             // Aquí puedes enviar el array de cambios al backend utilizando AJAX o un formulario oculto
            //         });
            //     }
            // }

            // attachTableEventListeners();


                if (saveButton) {
                    saveButton.addEventListener('click', function() {
                        const changes = [];
                        const allInventory = [];
                        cantidadInputs.forEach(input => {
                            const row = input.closest('tr');
                            allInventory.push({
                                id: row.dataset.id,
                                cantidad: input.value
                            });
                            if (!input.disabled) {
                                changes.push({
                                    id: row.dataset.id,
                                    cantidad: input.value
                                });
                            }
                        });

                        console.log('Changes:', changes);
                        console.log('All Inventory:', allInventory);

                        fetch('/vistas/inventario/save', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({
                                    changes,
                                    allInventory
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Success:', data);
                                document.getElementById('nInventarioModal').classList.add('hidden');
                                window.location.reload();
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    });
                }
            }


        });
    </script>




@endsection
