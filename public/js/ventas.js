document.addEventListener('DOMContentLoaded', function () {
    const productsPerPage = 7;
    let currentPage = 1;
    const products = articulos;

    function openProductModal() {
        document.getElementById('productModal').showModal();
        renderProducts(products, currentPage);
        renderPagination(products);
    }

    function closeProductModal() {
        document.getElementById('productModal').close();
    }

    function renderProducts(products, page) {
        const start = (page - 1) * productsPerPage;
        const end = start + productsPerPage;
        const paginatedProducts = products.slice(start, end);

        const productosLista = document.getElementById('productos-lista');
        productosLista.innerHTML = '';

        paginatedProducts.forEach(product => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${product.art_id}</td>
                <td class="px-6 py-4 whitespace-nowrap">${product.art_nombre}</td>
                <td class="px-6 py-4 whitespace-nowrap">${product.art_cantidad}</td>
                <td class="px-6 py-4 whitespace-nowrap">${product.art_precio}</td>
                <td class="px-6 py-4 whitespace-nowrap"><button type="button" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm" data-id="${product.art_id}" data-nombre="${product.art_nombre}" data-precio="${product.art_precio}" data-stock="${product.art_cantidad}">Agregar</button></td>
            `;
            productosLista.appendChild(tr);
        });
    }

    function renderPagination(products) {
        const totalPages = Math.ceil(products.length / productsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.classList.add('page-item');
            li.innerHTML = `<a class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700" href="#">${i}</a>`;
            li.addEventListener('click', function (e) {
                e.preventDefault();
                currentPage = i;
                renderProducts(products, currentPage);
                renderPagination(products);
            });
            pagination.appendChild(li);
        }
    }

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
            closeProductModal();
        }
    });

    function addProductToTable(product) {
        const productsTable = document.getElementById('productsTable');
        const existingRow = productsTable.querySelector(`tr[data-id="${product.art_id}"]`);
        if (existingRow) {
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
        const productsTable = document.getElementById('productsTable');
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

        document.getElementById('subtotal').innerText = subtotal.toFixed(2);
        document.getElementById('iva').innerText = iva.toFixed(2);
        document.getElementById('total').innerText = total.toFixed(2);
    }
    

    window.openProductModal = openProductModal;
    window.closeProductModal = closeProductModal;
});
