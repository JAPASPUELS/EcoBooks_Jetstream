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
                <input type="text" class="form-control mb-3" placeholder="Buscar productos" id="searchProductInput">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody id="productos-lista">
                        @foreach ($articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->art_id }}</td>
                            <td>{{ $articulo->art_nombre }}</td>
                            <td>{{ $articulo->art_cantidad }}</td>
                            <td>{{ $articulo->art_precio }}</td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-id="{{ $articulo->art_id }}" data-nombre="{{ $articulo->art_nombre }}" data-precio="{{ $articulo->art_precio }}" data-stock="{{ $articulo->art_cantidad }}">Agregar</button></td>
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
