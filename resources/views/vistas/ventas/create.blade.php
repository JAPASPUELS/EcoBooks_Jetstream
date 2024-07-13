@extends('dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
<div class="container mx-auto mt-5">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-500 text-white p-4 rounded-t-lg">
            <h4 class="text-xl font-semibold">+ Nueva Factura</h4>
        </div>
        <div class="p-6">
            <form id="ventaForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group relative">
                        <label for="cedula" class="block text-sm font-medium text-gray-700">Cedula</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cedula" name="cedula" placeholder="9999999999">
                        <button type="button" class="absolute top-1/2 right-3 transform -translate-y-1/2" onclick="buscarCliente()">
                            <i class="fas fa-search mt-6"></i>
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cliente" name="cliente" placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="pago" class="block text-sm font-medium text-gray-700">Pago</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="pago" name="pago">
                            @foreach($forma_Pagos as $formaPago)
                            <option value="{{ $formaPago->fpa_id }}">{{ $formaPago->fpa_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="fecha" name="fecha" value="2024-07-04">
                    </div>
                </div>
                <div class="form-group flex items-center mt-4">
                    <input class="form-check-input h-4 w-4 text-indigo-600 border-gray-300 rounded" type="checkbox" id="pagado" name="pagado">
                    <label class="ml-2 block text-sm text-gray-900" for="pagado">
                        Pagado
                    </label>
                </div>
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" class="btn btn-product bg-blue-500 text-white py-2 px-4 rounded-md" onclick="openProductModal()">+ Nuevo producto</button>
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md">+ Nuevo cliente</button>
                    <button type="button" class="bg-green-500 text-white py-2 px-4 rounded-md" id="addProductsButton">Agregar productos</button>
                    <button type="button" class="bg-teal-500 text-white py-2 px-4 rounded-md" onclick="guardarVenta()">Guardar</button>
                </div>
                <table class="min-w-full divide-y divide-gray-200 mt-6">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                CODIGO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                CANT.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                DESCRIPCION</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ENVASE</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                PRECIO UNIT.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                PRECIO TOTAL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productsTable" class="bg-white divide-y divide-gray-200">
                        <!-- Productos añadidos aparecerán aquí -->
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">SUBTOTAL $
                            </td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900" id="subtotal">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">IVA (13%)
                                $</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900" id="iva">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">TOTAL $
                            </td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900" id="total">0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>

@include('vistas.ventas.modal')

<script>
    const articulos = @json($articulos);

    function buscarCliente() {
        const cedula = document.getElementById('cedula').value;

        fetch(`/ventas/cliente/cedula/${cedula}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cliente').value = `${data.cli_nombre} ${data.cli_apellido}`;
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.error,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: "Debe ingresar una cédula",
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
    }

    function guardarVenta() {
        const productos = [];

        document.querySelectorAll('#productsTable tr').forEach(row => {
            // console.log(row);
            const art_id = row.querySelector('td:nth-child(1)').textContent;
            const det_unidades = row.querySelector('td:nth-child(2) input').value;
            // const art_nombre = row.querySelector('td:nth-child(3)').textContent;
            const det_precio = row.querySelector('td:nth-child(5)').textContent;
            const det_total = row.querySelector('td:nth-child(6)').textContent;
            console.log(det_total);
            productos.push({
                art_id: art_id,
                det_precio: det_precio,
                det_unidades: det_unidades,
                det_precio_total: det_total,
            });
        });
        let fpa_id_value = document.getElementById('pago').value;
        let fpa_id;
        if (fpa_id_value == 0) {
            fpa_id = 'EFE';
        } else if (fpa_id_value == 1) {
            fpa_id = 'TR';
        }
        const ventaData = {
            cli_codigo: document.getElementById('cedula').value,
            vent_total: parseFloat(document.getElementById('total').innerText),
            vent_fecha: document.getElementById('fecha').value,
            fpa_id: fpa_id,
            detalle_ventas: productos
        };

        fetch('/vistas/ventas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(ventaData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data);
                        Swal.fire({
                            title: 'Éxito',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            window.location.href = '/vistas/ventas';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un error al guardar la venta',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
    }
</script>

<script src="{{ asset('js/ventas.js') }}"></script>
@endsection