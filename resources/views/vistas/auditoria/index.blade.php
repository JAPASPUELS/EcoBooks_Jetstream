@extends('dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

    <div class="mt-5">
        <div class="mt-5">
            <!-- Contadores de acciones -->
            <div class="flex gap-6 mb-6">
                <div class="w-1/3">
                    <div id="insertCountBox"
                        class="flex flex-col items-center justify-center py-8 px-4 mb-2 bg-gray-100 rounded-lg">
                        <span id="insertCount" class="text-8xl font-bold text-blue-500 mb-2">0</span>
                        <span class="text-xs font-semibold text-gray-700">INSERT</span>
                    </div>
                </div>
                <div class="w-1/3">
                    <div id="updateCountBox"
                        class="flex flex-col items-center justify-center py-8 px-4 mb-2 bg-gray-100 rounded-lg">
                        <span id="updateCount" class="text-8xl font-bold text-blue-500 mb-2">0</span>
                        <span class="text-xs font-semibold text-gray-700">UPDATE</span>
                    </div>
                </div>
                <div class="w-1/3">
                    <div id="deleteCountBox"
                        class="flex flex-col items-center justify-center py-8 px-4 mb-2 bg-gray-100 rounded-lg">
                        <span id="deleteCount" class="text-8xl font-bold text-blue-500 mb-2">0</span>
                        <span class="text-xs font-semibold text-gray-700">DELETE</span>
                    </div>
                </div>
            </div>

            <!-- Filtros de selección de tabla, usuario y fechas -->
            <div class="pl-16 flex justify-center mb-5 bg-gray-100">

                <!-- Date Range Picker -->
                <div id="date-range-picker" class="flex items-center mr-5 mt-5 mb-5">
                    <div class="relative mr-4">
                        <label for="datepicker-range-start" class="block text-gray-700 text-sm font-bold mb-2">Fecha
                            Inicio</label>
                        <input id="datepicker-range-start" name="start" type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-4 py-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date start">
                    </div>
                    <div class="relative">
                        <label for="datepicker-range-end" class="block text-gray-700 text-sm font-bold mb-2">Fecha
                            Fin</label>

                        <input id="datepicker-range-end" name="end" type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-4 py-2.5 placeholder-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date end">
                    </div>
                </div>

                <!-- Dropdown de Usuarios -->
                <div class="relative mr-5 mt-5 mb-5">
                    <label for="userDropdown" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Usuario</label>
                    <select id="userDropdown"
                        class="block appearance-none w-48 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown de Tablas -->
                <div class="relative mr-5 mt-5 mb-5">
                    <label for="tablaDropdown" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Tabla</label>
                    <select id="tablaDropdown"
                        class="block appearance-none w-48 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="ventas">Ventas</option>
                        <option value="proveedores">Proveedores</option>
                        <option value="articulos">Articulos</option>
                        <option value="movimientos">Movimientos</option>
                        <option value="categorias">Categorías</option>
                        <option value="clientes">Clientes</option>
                        <option value="detalle_ventas">Detalles de Ventas</option>
                        <option value="forma_pagos">Formas De Pago</option>
                        <option value="pagos">Pagos</option>
                        <option value="inventario">Inventario</option>
                        <option value="compras">Compras</option>
                        <option value="gastos">Gastos</option>
                        <option value="roles">Roles</option>
                        <option value="users">Usuarios</option>
                    </select>

                </div>
                <div class="mt-12 mb-7">
                    <button id="filterButton" class="bg-blue-500 hover:bg-blue-700 text-white  py-2 px-4 rounded-lg ">
                        Filtrar
                    </button>
                    <button id="openModalButton"
                        class="bg-orange-500 hover:bg-orange-700 text-white py-2 px-4 rounded-lg ml-2">Datos</button>

                </div>


                <!-- Existing code for charts -->

                <!-- Modal -->
                <div id="dataModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-4/5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Datos</h3>

                            <button id="closeModalButton" class="text-red-500">&times;</button>
                        </div>
                        <button id="reportButton"
                            class="bg-green-500 hover:bg-green-700 text-white py-2 px-3 rounded-lg my-2">
                            Reporte</button>
                        <table id="dataTable" class="w-full bg-white">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tabla</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                    <th>Descripción</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody id="auditoriaTableBody">
                                <!-- Datos se llenarán con JavaScript -->
                            </tbody>
                        </table>
                        <div id="paginationLinks" class="mt-4 flex justify-center">
                            <!-- Links de paginación se llenarán con JavaScript -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="flex gap-6 ">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 ">
            <canvas id="auditoriaChart" width="430" height="430"></canvas>
        </div>
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <canvas id="barChart" width="430" height="430"></canvas>
        </div>
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <canvas id="richterChart" width="430" height="430"></canvas>
        </div>
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <canvas id="likertChart" width="430" height="430"></canvas>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var and = {};


            const ctxAuditoria = document.getElementById('auditoriaChart').getContext('2d');
            const ctxBar = document.getElementById('barChart').getContext('2d');
            const ctxRichter = document.getElementById('richterChart').getContext('2d');
            const ctxLikert = document.getElementById('likertChart').getContext('2d');
            const paginationLinks = document.getElementById(
                'paginationLinks'); // Asegúrate de tener un elemento con id 'paginationLinks'

            const countElements = {
                'INSERT': document.getElementById('insertCount'),
                'UPDATE': document.getElementById('updateCount'),
                'DELETE': document.getElementById('deleteCount')
            };

            document.getElementById('filterButton').addEventListener('click', function() {
                const tableName = document.getElementById('tablaDropdown').value;
                const userId = document.getElementById('userDropdown').value;
                let startDate = document.getElementById('datepicker-range-start').value;
                let endDate = document.getElementById('datepicker-range-end').value;

                if (userId) {
                    and.user_id = userId;
                }
                if (tableName) {
                    and.aud_table = tableName;
                }
                if (startDate) {
                    and.start = startDate;
                }
                if (endDate) {
                    and.end = endDate;
                }

                fetch('/chart-data', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            and
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        updateCounters(data.countByAction);
                        initPieChart(data, and.aud_table);
                        initBarChart(data, and.aud_table);
                        initRichterChart(data.richterData, and.aud_table);
                        initLikertChart(data.likertData, and.aud_table);
                        fillAuditoriaTable(data);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            });

            // Modal event listeners
            const dataModal = document.getElementById('dataModal');
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');

            openModalButton.addEventListener('click', function() {
                dataModal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', function() {
                dataModal.classList.add('hidden');
            });

            // Función para llenar la tabla de auditoría dentro del modal
            function fillAuditoriaTable(auditoriaData) {
                const tableBody = document.getElementById('auditoriaTableBody');
                tableBody.innerHTML = ''; // Limpiar contenido previo de la tabla

                auditoriaData.data.data.forEach(entry => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td class="border border-gray-300 px-4 py-2">${entry.id_aud}</td>
                <td class="border border-gray-300 px-4 py-2">${entry.aud_table}</td>
                <td class="border border-gray-300 px-4 py-2">${entry.aud_fecha}</td>
                <td class="border border-gray-300 px-4 py-2">${entry.aud_accion}</td>
                <td class="border border-gray-300 px-4 py-2">${entry.aud_descripcion}</td>
                <td class="border border-gray-300 px-4 py-2">${entry.user.name}</td>
            `;
                    tableBody.appendChild(row);
                });

                // Limpiar y generar los links de paginación
                paginationLinks.innerHTML = '';
                const {
                    prev_page_url,
                    next_page_url,
                    current_page,
                    last_page
                } = auditoriaData.data;
                // Establecer las clases de Tailwind para los estilos
                const baseLinkClasses = 'inline-block rounded px-3 py-1 mx-1';

                if (current_page > 1) {
                    paginationLinks.innerHTML +=
                        `<a href="#" class="${baseLinkClasses} pagination-link  bg-gray-200 hover:bg-gray-300 text-gray-700 hover:text-gray-900" data-page="${current_page - 1}">&laquo; Previo</a>`;
                }

                for (let i = 1; i <= last_page; i++) {
                    paginationLinks.innerHTML +=
                        `<a href="#" class="${baseLinkClasses} pagination-link ${i === current_page ? 'active bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700 hover:text-gray-900'}" data-page="${i}">${i}</a>`;
                }

                if (current_page < last_page) {
                    paginationLinks.innerHTML +=
                        `<a href="#" class="${baseLinkClasses} pagination-link bg-gray-200 hover:bg-gray-300 text-gray-700 hover:text-gray-900" data-page="${current_page + 1}">Siguiente &raquo;</a>`;
                }

                // Event listeners para los links de paginación
                document.querySelectorAll('.pagination-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        let page = this.getAttribute('data-page');
                        fetchAuditoriaData(page);
                    });
                });
            }


            // Función para actualizar los contadores
            function updateCounters(countByAction) {
                for (const action in countByAction) {
                    countElements[action].textContent = countByAction[action];
                }
            }

            function destroyChart(chartInstance) {
                if (chartInstance && chartInstance instanceof Chart) {
                    chartInstance.destroy();
                }
            }

            function getColorForValue(value, min, max) {
                const ratio = (value - min) / (max - min);
                const red = Math.round(255 * (1 - ratio));
                const green = Math.round(255 * ratio);
                return `rgba(${red}, ${green}, 0, 0.5)`;
            }

            function getDynamicColors(data) {
                const values = Object.values(data);
                const min = Math.min(...values);
                const max = Math.max(...values);
                return values.map(value => getColorForValue(value, min, max));
            }

            function initPieChart(data, tableName) {
                destroyChart(window.auditoriaChart);
                const dynamicColors = getDynamicColors(data.countByAction);

                window.auditoriaChart = new Chart(ctxAuditoria, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(data.countByAction),
                        datasets: [{
                            label: 'Registros',
                            data: Object.values(data.countByAction),
                            backgroundColor: dynamicColors,
                            borderColor: dynamicColors.map(color => color.replace('0.5', '1')),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: tableName,
                                font: {
                                    size: 18,
                                    weight: 'bold'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 10
                                },
                                color: '#333',
                                align: 'center'
                            }
                        }
                    }
                });
            }

            function initBarChart(data, tableName) {
                destroyChart(window.barChart);
                const dynamicColors = getDynamicColors(data.countByAction);

                window.barChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data.countByAction),
                        datasets: [{
                            label: 'Registros',
                            data: Object.values(data.countByAction),
                            backgroundColor: dynamicColors,
                            borderColor: dynamicColors.map(color => color.replace('0.5', '1')),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: tableName,
                                font: {
                                    size: 18,
                                    weight: 'bold'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 10
                                },
                                color: '#333',
                                align: 'center'
                            }
                        }
                    }
                });
            }

            function initRichterChart(data, tableName) {
                destroyChart(window.richterChart);
                const dynamicColors = getDynamicColors(data.map(point => point.y));

                window.richterChart = new Chart(ctxRichter, {
                    type: 'scatter',
                    data: {
                        datasets: [{
                            label: "Registros",
                            data: data,
                            backgroundColor: dynamicColors,
                            borderColor: dynamicColors.map(color => color.replace('0.5', '1')),
                            borderWidth: 1,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: tableName,
                                font: {
                                    size: 18,
                                    weight: 'bold'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 10
                                },
                                color: '#333',
                                align: 'center'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.raw.action || '';
                                        return label + ': (' + context.raw.x + ', ' + context.raw.y +
                                            ')';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                type: 'linear',
                                position: 'bottom',
                                title: {
                                    display: true,
                                    text: 'Conteo de Acción'
                                }
                            },
                            y: {
                                type: 'linear',
                                position: 'left',
                                title: {
                                    display: true,
                                    text: 'Conteo de Acción'
                                }
                            }
                        }
                    }
                });
            }

            function initLikertChart(data, tableName) {
                destroyChart(window.likertChart);
                const dynamicColors = getDynamicColors(data.datasets.flatMap(dataset => dataset.data));

                const datasets = data.datasets.map(dataset => ({
                    ...dataset,
                    backgroundColor: dataset.data.map(value => getColorForValue(value, Math.min(...
                        dataset.data), Math.max(...dataset.data))),
                    borderColor: dataset.data.map(value => getColorForValue(value, Math.min(...dataset
                        .data), Math.max(...dataset.data)).replace('0.5', '1')),
                    borderWidth: 1
                }));

                window.likertChart = new Chart(ctxLikert, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: datasets
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                beginAtZero: true,
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false,
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
            // Función para realizar la solicitud de datos de auditoría paginados
            function fetchAuditoriaData(page) {
                const tableName = document.getElementById('tablaDropdown').value;
                const userId = document.getElementById('userDropdown').value;
                const startDate = document.getElementById('datepicker-range-start').value;
                const endDate = document.getElementById('datepicker-range-end').value;
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const and = {
                    page: page
                };

                if (userId) {
                    and.user_id = userId;
                }
                if (tableName) {
                    and.aud_table = tableName;
                }
                if (startDate) {
                    and.start = startDate;
                }
                if (endDate) {
                    and.end = endDate;
                }

                fetch('/chart-data', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            and
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        updateCounters(data.countByAction);
                        fillAuditoriaTable(data);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            fetch('/chart-data', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        updateCounters(data.countByAction);
                        initPieChart(data, and.aud_table);
                        initBarChart(data, and.aud_table);
                        initRichterChart(data.richterData, and.aud_table);
                        initLikertChart(data.likertData, and.aud_table);
                        fillAuditoriaTable(data);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
        });
    </script>
@endsection
