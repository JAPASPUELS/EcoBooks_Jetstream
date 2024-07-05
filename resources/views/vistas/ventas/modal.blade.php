<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Buscar productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" placeholder="Buscar productos">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Precio</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->art_id }}</td>
                            <td>{{ $articulo->art_nombre }}</td>
                            <td><input type="number" class="form-control" value="1"></td>
                            <td>{{ $articulo->art_precio }}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" onclick="addProduct('{{ $articulo->art_id }}', '{{ $articulo->art_nombre }}', '{{ $articulo->art_precio }}')">Agregar</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function addProduct(id, nombre, precio) {
    // Esta función se encargará de agregar el producto a la tabla de la vista principal
    // Puedes agregar la lógica para agregar el producto a la tabla y cerrar el modal
}
</script>
