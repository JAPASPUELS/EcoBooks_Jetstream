document.addEventListener('DOMContentLoaded', function () {
    const productsTable = document.getElementById('productsTable');
    const subtotalElement = document.getElementById('subtotal');
    const ivaElement = document.getElementById('iva');
    const totalElement = document.getElementById('total');

    // Usar delegación de eventos para evitar duplicidad en la asignación de eventos
    document.getElementById('productModal').addEventListener('click', function (event) {
        if (event.target && event.target.matches('button[data-id]')) {
            const button = event.target;
            const productId = button.getAttribute('data-id');
            const productNombre = button.getAttribute('data-nombre');
            const productPrecio = parseFloat(button.getAttribute('data-precio'));
            const stock = parseInt(button.getAttribute('data-stock'));
            
            const product = {
                art_id: productId,
                art_nombre: productNombre,
                art_precio: productPrecio,
                stock: stock,
                cantidad: 1 // Asumiendo que por defecto se añade 1 unidad
            };

            addProductToTable(product);
            $('#productModal').modal('hide');
        }
    });

    function addProductToTable(product) {
        // Verificar si el producto ya existe en la tabla
        const existingRow = productsTable.querySelector(`tr[data-id="${product.art_id}"]`);
        if (existingRow) {
            // Actualizar la cantidad si el producto ya existe
            const cantidadInput = existingRow.querySelector('input[type="number"]');
            cantidadInput.value = parseInt(cantidadInput.value) + product.cantidad;
            updateTotals();
            return;
        }

        const row = document.createElement('tr');
        row.setAttribute('data-id', product.art_id);
        row.innerHTML = `
            <td>${product.art_id}</td>
            <td><input type="number" class="form-control" value="${product.cantidad}" min="1" max="${product.stock}" onchange="updateTotals()"></td>
            <td>${product.art_nombre}</td>
            <td>
                <input type="checkbox" id="envase_si_${product.art_id}" name="envase_si"> Sí
                <input type="checkbox" id="envase_no_${product.art_id}" name="envase_no"> No
            </td>
            <td class="product-precio">${product.art_precio.toFixed(2)}</td>
            <td class="product-total">${(product.art_precio * product.cantidad).toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm">Eliminar</button></td>
        `;

        row.querySelector('.btn-danger').addEventListener('click', function () {
            row.remove();
            updateTotals();
        });

        productsTable.appendChild(row);
        updateTotals();
    }

    window.updateTotals = function() {
        let subtotal = 0;

        productsTable.querySelectorAll('tr').forEach(row => {
            const cantidad = row.querySelector('input[type="number"]').value;
            const precio = row.querySelector('.product-precio').innerText;
            const totalProducto = parseFloat(cantidad) * parseFloat(precio);
            row.querySelector('.product-total').innerText = totalProducto.toFixed(2);
            subtotal += totalProducto;
        });

        const iva = subtotal * 0.13;
        const total = subtotal + iva;

        subtotalElement.innerText = subtotal.toFixed(2);
        ivaElement.innerText = iva.toFixed(2);
        totalElement.innerText = total.toFixed(2);
    }
});
