@extends('dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<style>
    /* estilos personalizados */
    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        cursor: pointer;
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .btn-primary:hover {
        color: #fff;
        background-color: #0056b3;
        border-color: #004085;
    }
    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
    }
    .table th {
        background-color: #f1f5f9;
        font-weight: bold;
        text-transform: uppercase;
    }
    .table tr:nth-child(even) {
        background-color: #f9fafb;
    }
    .table tr:hover {
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
</style>

<div class="mt-5">
    <!-- Filtros de selección de fechas -->
    <form method="GET" action="{{ route('ventas.index') }}" class="flex justify-center mb-5 bg-gray-100 p-4 rounded-lg shadow-md">
        <!-- Date Range Picker -->
        <div id="date-range-picker" class="flex items-center mr-5 mt-5 mb-5">
            <div class="relative mr-4">
                <label for="fechaInicio" class="block text-gray-700 text-sm font-bold mb-2">Fecha Inicio</label>
                <input id="fechaInicio" name="fechaInicio" type="date"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-4 py-2.5 placeholder-gray-400"
                    placeholder="Seleccionar fecha inicio">
            </div>
            <div class="relative">
                <label for="fechaFin" class="block text-gray-700 text-sm font-bold mb-2">Fecha Fin</label>
                <input id="fechaFin" name="fechaFin" type="date"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-4 py-2.5 placeholder-gray-400"
                    placeholder="Seleccionar fecha fin">
            </div>
        </div>
        <!-- Botón de Filtrado -->
        <div class="mt-12 mb-7">
            <button type="submit" class="btn-primary">Filtrar</button>
        </div>
    </form>

    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $vnt)
                <tr>
                    <td data-label="vent_numero">{{ $vnt->vent_numero }}</td>
                    <td data-label="cli_codigo">{{ $vnt->cli_codigo }}</td>
                    <td data-label="vent_fecha">{{ $vnt->vent_fecha }}</td>
                    <td data-label="vent_total">{{ $vnt->vent_total }}</td>
                    <td data-label="Acciones">
                        <button class="btn btn-show" id="pdfBtn" data-venta-id="{{ $vnt->vent_numero }}" onclick="test('{{ $vnt->vent_numero }}')">
                            <i class='bx bx-show'></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $ventas->links() }}
        </div>
    </div>
</div>

<script>
    function test(first) {
        console.log(first);
        window.location.href = `/reportvent/pdf/${first}`;
    }
</script>
@endsection
