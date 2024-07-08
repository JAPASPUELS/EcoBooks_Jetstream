@extends('dashboard')

@section('content')
    <!-- Incluir el archivo CSS de Proveedores -->
    <link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

    <div class="mt-5">
        <div class="flex justify-center items-center mb-5">
            {{-- <h2 class="text-2xl font-bold">Auditoria</h2> --}}
            <div class="relative">
                <select id="tablaDropdown"
                    class="block appearance-none w-48 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="vendedores">Vendedores</option>
                    <option value="proveedores">Proveedores</option>
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 14.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414l-5-5a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="flex gap-6 p-16">
            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                <canvas id="auditoriaChart" width="400" height="400"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                <canvas id="richterChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <div class="pl-16">
        <div>
            {{-- <h3 class="text-purple-600">Registros Auditoria</h3> --}}
        </div>
        <div>
            <table class="table table-striped table-hover mt-4">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                        <th>Descripción</th>
                        <th>Tabla</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditoria as $aud)
                        <tr>
                            <td data-label="usu_id">{{ $aud->id_aud }}</td>
                            <td data-label="aud_fecha">{{ $aud->aud_fecha }}</td>
                            <td data-label="aud_accion">{{ $aud->aud_accion }}</td>
                            <td data-label="aud_descripcion">{{ $aud->aud_descripcion }}</td>
                            <td data-label="aud_table">{{ $aud->aud_table }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const ctxAuditoria = document.getElementById('auditoriaChart').getContext('2d');
    const ctxBar = document.getElementById('barChart').getContext('2d');
    const ctxRichter = document.getElementById('richterChart').getContext('2d');

     // Función para obtener los datos según la tabla seleccionada
     function fetchData(tableName) {
                return fetch("{{ url('/chart-data') }}/" + tableName)
                    .then(response => response.json());
            }

    // Función para destruir un gráfico existente
    function destroyChart(chartInstance) {
        if (chartInstance && chartInstance instanceof Chart) {
            chartInstance.destroy();
        } else {
            // console.warn('El objeto chartInstance no tiene el método destroy o no es una instancia de Chart.');
        }
    }

    // Función para inicializar el gráfico de pie
    function initPieChart(data) {
        destroyChart(window.auditoriaChart); // Destruye el gráfico anterior si existe
        window.auditoriaChart = new Chart(ctxAuditoria, {
            type: 'pie',
            data: {
                labels: Object.keys(data),
                datasets: [{
                    label: 'Registros por Acción',
                    data: Object.values(data),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
                        text: 'Auditoria Registros Generales de la Aplicación',
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

    // Función para inicializar el gráfico de barras
    function initBarChart(data) {
        destroyChart(window.barChart); // Destruye el gráfico anterior si existe
        window.barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: Object.keys(data),
                datasets: [{
                    label: 'Número de Registros',
                    data: Object.values(data),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
                        text: 'Gráfico de Barras Ejemplo',
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

    // Función para inicializar el gráfico de escalas de Richter
    function initRichterChart(data) {
        destroyChart(window.richterChart); // Destruye el gráfico anterior si existe
        window.richterChart = new Chart(ctxRichter, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Sismos',
                    data: data,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
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
                        text: 'Gráfico de Escalas de Richter',
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
                },
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom'
                    },
                    y: {
                        type: 'linear',
                        position: 'left'
                    }
                }
            }
        });
    }

    // Evento de cambio en el dropdown
    document.getElementById('tablaDropdown').addEventListener('change', function() {
        const selectedTable = this.value;

        // Obtener datos y actualizar gráficos
        fetchData(selectedTable)
            .then(data => {
                // Actualizar gráfico de pie
                initPieChart(data);

                // Actualizar gráfico de barras
                initBarChart(data);

                // Actualizar gráfico de escalas de Richter (ejemplo)
                // Asegúrate de adaptar los datos para el gráfico de Richter según tu modelo de datos
                const richterData = [{
                        x: 1,
                        y: 5
                    },
                    {
                        x: 2,
                        y: 6
                    },
                    {
                        x: 3,
                        y: 7
                    },
                    {
                        x: 4,
                        y: 8
                    },
                    {
                        x: 5,
                        y: 9
                    }
                    // Agrega más datos según tu necesidad
                ];
                initRichterChart(richterData);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });

    // Inicializar gráficos al cargar la página con la tabla por defecto (auditoria)
    fetchData('vendedores')
        .then(data => {
            // Inicializar gráfico de pie
            initPieChart(data);

            // Inicializar gráfico de barras
            initBarChart(data);

            // Inicializar gráfico de escalas de Richter (ejemplo)
            // Asegúrate de adaptar los datos para el gráfico de Richter según tu modelo de datos
            const richterData = [{
                    x: 1,
                    y: 5
                },
                {
                    x: 2,
                    y: 6
                },
                {
                    x: 3,
                    y: 7
                },
                {
                    x: 4,
                    y: 8
                },
                {
                    x: 5,
                    y: 9
                }
                // Agrega más datos según tu necesidad
            ];
            initRichterChart(richterData);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});

    </script>
@endsection
