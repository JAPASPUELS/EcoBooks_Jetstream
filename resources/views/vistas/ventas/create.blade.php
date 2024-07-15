@extends('dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
<div class="mx-auto mt-5">
    <div class="h-1/4 bg-white shadow-md rounded-lg">
        <div class="bg-blue-500 text-white p-4 rounded-t-lg flex justify-between items-center">
            <div>
                <h4 class="text-xl font-semibold">+ Nueva Factura</h4>
                <span id="fechaActual" class="text-sm"></span>
            </div>
        </div>
        <div class="p-6">
            <form id="ventaForm">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-group relative">
                        <label for="cedula" class="block text-sm font-medium text-gray-700">Cedula</label>
                        <div class="relative">
                            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 pl-3 pr-10 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cedula" name="cedula" placeholder="9999999999">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="buscarCliente()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 pl-3 pr-10 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cliente" name="cliente" placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="pago" class="block text-sm font-medium text-gray-700">Pago</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 pl-3 pr-10 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="pago" name="pago">
                            @foreach($forma_Pagos as $formaPago)
                            <option value="{{ $formaPago->fpa_id }}">{{ $formaPago->fpa_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end mt-4 space-x-3 items-center">
                    <div class="form-group flex items-center">
                        <label for="discount" class="block text-sm font-medium text-gray-700 mr-2">Descuento (%)</label>
                        <input type="number" class="mt-1 block border border-gray-300 rounded-md shadow-sm py-2 pl-3 pr-10 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="discount" placeholder="0" value="0" min="0" max="100">
                        <button type="button" class="btn btn-product bg-blue-500 text-white py-1 px-3 rounded-md ml-2" onclick="confirmDiscount()">OK</button>
                    </div>
                    <button type="button" class="btn btn-product bg-blue-500 text-white py-1 px-3 rounded-md" onclick="openProductModal()">+ Nuevo producto</button>
                    <button type="button" class="bg-teal-500 text-white py-1 px-3 rounded-md" onclick="guardarVenta()">Guardar</button>
                </div>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">CODIGO</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">CANT.</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">DESCRIPCION</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ENVASE</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">PRECIO UNIT.</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">PRECIO TOTAL</th>
                                <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productsTable" class="bg-white divide-y divide-gray-200">
                            <!-- Productos añadidos aparecerán aquí -->
                        </tbody>
                    </table>
                    
                    {{-- <div class="overflow-y-auto" style="max-height: 300px;"> --}}
                       
                    {{-- </div> --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">SUBTOTAL SIN DESCUENTO $</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900" id="subtotal">0.00</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">DESCUENTO $</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900" id="descuento">0.00</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">IVA (15%) $</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900" id="iva">0.00</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-right text-sm font-medium text-gray-500">TOTAL $</td>
                                <td class="px-6 py-3 text-sm font-medium text-gray-900" id="total">0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@include('vistas.ventas.modal')
@include('vistas.ventas.register-client-modal')

<script>
    const articulos = @json($articulos);

    function validarCedula(cedula) {
        if (cedula.length !== 10) return false;

        var digito_region = cedula.substring(0, 2);
        if (digito_region < 1 || digito_region > 24) return false;

        var ultimo_digito = cedula.substring(9, 10);
        var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));
        var numero1 = cedula.substring(0, 1) * 2;
        if (numero1 > 9) { numero1 -= 9; }
        var numero3 = cedula.substring(2, 3) * 2;
        if (numero3 > 9) { numero3 -= 9; }
        var numero5 = cedula.substring(4, 5) * 2;
        if (numero5 > 9) { numero5 -= 9; }
        var numero7 = cedula.substring(6, 7) * 2;
        if (numero7 > 9) { numero7 -= 9; }
        var numero9 = cedula.substring(8, 9) * 2;
        if (numero9 > 9) { numero9 -= 9; }
        var impares = numero1 + numero3 + numero5 + numero7 + numero9;
        var suma_total = pares + impares;
        var primer_digito_suma = String(suma_total).substring(0, 1);
        var decena = (parseInt(primer_digito_suma) + 1) * 10;
        var digito_validador = decena - suma_total;
        if (digito_validador == 10) { digito_validador = 0; }

        return digito_validador == ultimo_digito;
    }

    function validarRUC(ruc) {
        if (ruc.length !== 13) return false;

        const numeroProvincia = parseInt(ruc.substring(0, 2));
        if (numeroProvincia < 1 || numeroProvincia > 24) return false;

        const tipo = parseInt(ruc.charAt(2));
        if (![6, 9].includes(tipo) && tipo > 5) return false;

        const coeficientesPub = [3, 2, 7, 6, 5, 4, 3, 2];
        const coeficientesPri = [4, 3, 2, 7, 6, 5, 4, 3, 2];
        const coeficientesNat = [2, 1, 2, 1, 2, 1, 2, 1, 2];

        let suma = 0;
        let digitoVerificador = parseInt(ruc.charAt(9));

        if (tipo === 6) { // Público
            for (let i = 0; i < 8; i++) {
                suma += parseInt(ruc.charAt(i)) * coeficientesPub[i];
            }
            let residuo = suma % 11;
            residuo = residuo === 0 ? 0 : 11 - residuo;
            return residuo === digitoVerificador;
        } else if (tipo === 9) { // Privado
            for (let i = 0; i < 9; i++) {
                suma += parseInt(ruc.charAt(i)) * coeficientesPri[i];
            }
            let residuo = suma % 11;
            residuo = residuo === 0 ? 0 : 11 - residuo;
            return residuo === digitoVerificador;
        } else { // Natural
            for (let i = 0; i < 9; i++) {
                let valor = parseInt(ruc.charAt(i)) * coeficientesNat[i];
                suma += valor >= 10 ? valor - 9 : valor;
            }
            let residuo = suma % 10;
            residuo = residuo === 0 ? 0 : 10 - residuo;
            return residuo === digitoVerificador;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Set current date next to the title
        const fechaActual = new Date().toISOString().split('T')[0];
        document.getElementById('fechaActual').textContent = "Fecha: " + fechaActual;

        window.buscarCliente = function() {
            const cedula = document.getElementById('cedula').value;

            if (!validarCedula(cedula) && !validarRUC(cedula)) {
                Swal.fire({
                    title: 'Error',
                    text: 'Cédula o RUC inválido',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

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
                        }).then((result) => {
                            if (result.isConfirmed) {
                                abrirModalRegistrarCliente(cedula);
                            }
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: "Debe ingresar una cédula válida",
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                });
        }

        window.guardarVenta = function() {
            const cedula = document.getElementById('cedula').value;
            const cliente = document.getElementById('cliente').value;
            
            if (!validarCedula(cedula) && !validarRUC(cedula)) {
                Swal.fire({
                    title: 'Error',
                    text: 'Cédula o RUC inválido',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            if (!cliente) {
                Swal.fire({
                    title: 'Cliente no encontrado',
                    text: '¿Desea facturar a consumidor final?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cedula').value = '9999999999';
                        document.getElementById('cliente').value = 'Consumidor Final';
                        proceedWithSale();
                    }
                });
            } else {
                proceedWithSale();
            }
        }

        function proceedWithSale() {
            const productos = [];

            document.querySelectorAll('#productsTable tr').forEach(row => {
                const art_id = row.querySelector('td:nth-child(1)').textContent;
                const det_unidades = row.querySelector('td:nth-child(2) input').value;
                const det_precio = row.querySelector('td:nth-child(5)').textContent;
                const det_total = row.querySelector('td:nth-child(6)').textContent;
                const art_envase = row.querySelector('td:nth-child(4) input').checked ? true : false;

                const producto = {
                    art_id: art_id,
                    det_precio: det_precio,
                    det_unidades: det_unidades,
                    det_precio_total: det_total,
                    art_envase: art_envase
                };

                productos.push(producto);
            });

            if (productos.length === 0) {
                Swal.fire({
                    title: 'Error',
                    text: 'Debe agregar al menos un producto a la venta',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            const ventaData = {
                cli_codigo: document.getElementById('cedula').value,
                vent_total: parseFloat(document.getElementById('total').innerText),
                vent_subtotal: parseFloat(document.getElementById('subtotal').innerText),
                fpa_id: document.getElementById('pago').value,
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

        // Update total when discount is applied
        window.confirmDiscount = function() {
            const descuentoInput = document.getElementById('discount').value;
            if (descuentoInput) {
                Swal.fire({
                    title: 'Confirmar descuento',
                    text: `¿Deseas aplicar un descuento del ${descuentoInput}% a esta compra?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateTotals();
                    }
                });
            }
        }

        window.updateTotals = function() {
            const productsTable = document.getElementById('productsTable');
            let subtotal = 0;
            let descuento = 0;

            productsTable.querySelectorAll('tr').forEach(row => {
                const cantidad = row.querySelector('input[type="number"]').value;
                const precio = row.querySelector('.product-precio').innerText;
                let totalProducto = parseFloat(cantidad) * parseFloat(precio);

                // Aplicar descuento por envase
                const envaseCheckbox = row.querySelector('input[name="envase_si"]');
                if (envaseCheckbox && envaseCheckbox.checked) {
                    totalProducto -= 0.10; // Descuento de 0.10 por envase
                }

                row.querySelector('.product-total').innerText = totalProducto.toFixed(2);
                subtotal += totalProducto;
            });

            const descuentoInput = document.getElementById('discount').value;
            if (descuentoInput) {
                descuento = (subtotal * (parseFloat(descuentoInput) / 100));
            }

            const iva = (subtotal - descuento) * 0.15; // Cambié el IVA a 15% según tu tabla
            const total = (subtotal - descuento) + iva;

            document.getElementById('subtotal').innerText = subtotal.toFixed(2);
            document.getElementById('descuento').innerText = descuento.toFixed(2);
            document.getElementById('iva').innerText = iva.toFixed(2);
            document.getElementById('total').innerText = total.toFixed(2);
        }

        window.openProductModal = function() {
            document.getElementById('productModal').showModal();
            renderProducts(articulos, 1);
        };

        window.closeProductModal = function() {
            document.getElementById('productModal').close();
        };

        window.abrirModalRegistrarCliente = function(cedula) {
            document.getElementById('cli_codigo').value = cedula;
            document.getElementById('modalRegistrarCliente').classList.remove('hidden');
        };

        window.cerrarModalRegistrarCliente = function() {
            document.getElementById('modalRegistrarCliente').classList.add('hidden');
        };

    });
    document.getElementById('clienteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    formData.append('from_ventas', true); // Añadir el indicador de origen

    fetch('/clientes', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al registrar el cliente');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('cliente').value = `${data.cliente.cli_nombre} ${data.cliente.cli_apellido}`;
            cerrarModalRegistrarCliente();
            Swal.fire({
                title: 'Éxito',
                text: 'Cliente registrado exitosamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
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
            text: error.message,
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
});


</script>

<script src="{{ asset('js/ventas.js') }}"></script>
@endsection