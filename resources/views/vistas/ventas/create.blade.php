@extends('dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
<div class="container mx-auto mt-5">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-500 text-white p-4 rounded-t-lg">
            <h4 class="text-xl font-semibold">+ Nueva Factura</h4>
        </div>
        <div class="p-6">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group relative">
                        <label for="cedula" class="block text-sm font-medium text-gray-700">Cedula</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cedula" placeholder="9999999999">
                        <button type="button" class="absolute top-1/2 right-3 transform -translate-y-1/2" onclick="buscarCliente()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cliente" placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="pago" class="block text-sm font-medium text-gray-700">Pago</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="pago" placeholder="Efectivo">
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="fecha" value="2024-07-04">
                    </div>
                </div>
                <div class="form-group flex items-center mt-4">
                    <input class="form-check-input h-4 w-4 text-indigo-600 border-gray-300 rounded" type="checkbox" id="pagado">
                    <label class="ml-2 block text-sm text-gray-900" for="pagado">
                        Pagado
                    </label>
                </div>
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" class="btn btn-product bg-blue-500 text-white py-2 px-4 rounded-md" onclick="openProductModal()">+ Nuevo producto</button>
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md">+ Nuevo cliente</button>
                    <button type="button" class="bg-green-500 text-white py-2 px-4 rounded-md" id="addProductsButton">Agregar productos</button>
                    <button type="button" class="bg-teal-500 text-white py-2 px-4 rounded-md">Guardar</button>
                </div>
                <table class="min-w-full divide-y divide-gray-200 mt-6">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CODIGO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CANT.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DESCRIPCION</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ENVASE</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRECIO UNIT.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRECIO TOTAL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productsTable" class="bg-white divide-y divide-gray-200">
                        <!-- Productos añadidos aparecerán aquí -->
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">SUBTOTAL $</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900" id="subtotal">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">IVA (13%) $</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900" id="iva">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">TOTAL $</td>
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
    const articulos = json($articulos);

    function buscarCliente() {
        const cedula = document.getElementById('cedula').value;

        fetch(`/ventas/cliente/cedula/${cedula}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cliente').value = `${data.data.cli_nombre} ${data.data.cli_apellido}`;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert(cedula)
                console.error('Error:', error);
                alert('Hubo un error al buscar el cliente');
            });
    }
</script>

<script src="{{ asset('js/ventas.js') }}"></script>
@endsection