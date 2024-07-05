@extends('dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>+ Nueva Factura</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input type="text" class="form-control" id="cedula" placeholder="9999999999">
                    </div>
                    <div class="form-group">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="cliente" placeholder="Juan Perez">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="juanhernandezm2208@gmail.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celular" placeholder="09981345688">
                    </div>
                    <div class="form-group">
                        <label for="pago" class="form-label">Pago</label>
                        <input type="text" class="form-control" id="pago" placeholder="Efectivo">
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" value="2024-07-04">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="pagado">
                        <label class="form-check-label ms-2" for="pagado">
                            Pagado
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#productModal">+ Nuevo producto</button>
                    <button type="button" class="btn btn-secondary me-2">+ Nuevo cliente</button>
                    <button type="button" class="btn btn-success me-2" id="addProductsButton">Agregar productos</button>
                    <button type="button" class="btn btn-info">Guardar</button>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10%;">CODIGO</th>
                        <th style="width: 10%;">CANT.</th>
                        <th style="width: 30%;">DESCRIPCION</th>
                        <th style="width: 10%;">ENVASE</th>
                        <th style="width: 10%;">PRECIO UNIT.</th>
                        <th style="width: 10%;">PRECIO TOTAL</th>
                        <th style="width: 10%;">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="productsTable">
                        <!-- Productos añadidos aparecerán aquí -->
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6" class="text-end">SUBTOTAL $</td>
                        <td id="subtotal">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">IVA (13%) $</td>
                        <td id="iva">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">TOTAL $</td>
                        <td id="total">0.00</td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>

@include('vistas.ventas.modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const productsTable = document.getElementById('productsTable');
    const subtotalElement = document.getElementById('subtotal');
    const ivaElement = document.getElementById('iva');
    const totalElement = document.getElementById('total');
    const addProductsButton = document.getElementById('addProductsButton');

    addProductsButton.addEventListener('click', function () {
        // Obtener los productos seleccionados del modal
        const selectedProducts = []; // Reemplazar con la lógica para obtener productos seleccionados

        selectedProducts.forEach(product => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.art_id}</td>
                <td><input type="number" value="1" class="form-control" onchange="updateTotals()"></td>
                <td>${product.art_nombre}</td>
                <td>
                    <input type="checkbox" id="envase_si" name="envase_si"> Sí
                    <input type="checkbox" id="envase_no" name="envase_no"> No
                </td>
                <td>${product.art_precio}</td>
                <td>${product.art_precio}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(this)">Eliminar</button></td>
            `;
            productsTable.appendChild(row);
        });

        updateTotals();
    });

    window.updateTotals = function () {
        let subtotal = 0;
        productsTable.querySelectorAll('tr').forEach(row => {
            const quantity = row.querySelector('input[type="number"]').value;
            const price = row.children[4].innerText;
            const total = quantity * price;
            row.children[5].innerText = total.toFixed(2);
            subtotal += total;
        });
        const iva = subtotal * 0.13;
        const total = subtotal + iva;
        subtotalElement.innerText = subtotal.toFixed(2);
        ivaElement.innerText = iva.toFixed(2);
        totalElement.innerText = total.toFixed(2);
    };

    window.removeProduct = function (button) {
        const row = button.parentElement.parentElement;
        productsTable.removeChild(row);
        updateTotals();
    };
});
</script>
@endsection
