@extends('dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mx-5">
        <div class="flex justify-start items-center mb-5">
            <form method="GET" action="{{ route('pagos.index') }}" class="flex space-x-4">
                <div>
                    <label for="forma_pago" class="block text-sm font-medium text-gray-700">Forma de Pago</label>
                    <select name="forma_pago" id="forma_pago" class="form-control">
                        <option value="">Todas</option>
                        @foreach($formas_pago as $fp)
                            <option value="{{ $fp->fpa_id }}">{{ $fp->fpa_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                </div>
                <div>
                    <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>

        <div class="flex justify-end mb-5">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="openModalBtn">
                Nuevo Pago
            </button>
        </div>

        <div class="mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Forma de Pago</th>
                        <th>Número de Venta</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr>
                            <td data-label="Id">{{ $pago->pag_id }}</td>
                            <td data-label="Forma de Pago">{{ $pago->formaPago->fpa_nombre }}</td>
                            <td data-label="Número de Venta">{{ $pago->vent_numero }}</td>
                            <td data-label="Valor">{{ $pago->pag_valor }}</td>
                            <td data-label="Fecha">{{ $pago->pag_fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para nuevo pago -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="registroModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-20 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Fondo oscuro transparente -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Contenedor principal del modal -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Encabezado del modal -->
                <div class="mt-3 text-center sm:items-start sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Nuevo Pago</h3>
                    <!-- Formulario dentro del modal -->
                    <div class="mt-2">
                        <form id="registroForm" method="POST" action="{{ route('pagos.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="fpa_id" class="block text-sm font-medium text-gray-700">Forma de Pago</label>
                                <select name="fpa_id" id="fpa_id" class="form-control">
                                    <option value="001">Efectivo</option>
                                    <option value="002">Transferencia</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="vent_numero" class="block text-sm font-medium text-gray-700">Número de Venta</label>
                                <input type="number" name="vent_numero" id="vent_numero" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="pag_valor" class="block text-sm font-medium text-gray-700">Valor</label>
                                <input type="number" step="0.01" name="pag_valor" id="pag_valor" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="pag_fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="date" name="pag_fecha" id="pag_fecha" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Botones de acción del modal -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" id="saveBtn">
                    Guardar
                </button>
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" id="closeModal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('registroModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModal');
        const saveBtn = document.getElementById('saveBtn');
        const registroForm = document.getElementById('registroForm');

        openModalBtn.addEventListener('click', function() {
            registroForm.reset();
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        saveBtn.addEventListener('click', function() {
            registroForm.submit();
        });
    });
</script>
@endsection
