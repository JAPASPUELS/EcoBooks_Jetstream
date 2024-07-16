<dialog id="editArticuloModal" class="modal">
    <div class="modal-header">
        <h5 class="modal-title">Editar Artículo</h5>
        <button type="button" class="close" onclick="document.getElementById('editArticuloModal').close();">
            &times;
        </button>
    </div>
    <form id="editArticuloForm">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_art_id" name="art_id">
            <div class="form-group">
                <label for="edit_art_nombre">Nombre del Artículo</label>
                <input type="text" id="edit_art_nombre" name="art_nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_art_precio">Precio</label>
                <input type="text" id="edit_art_precio" name="art_precio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_art_cantidad">Cantidad</label>
                <input type="text" id="edit_art_cantidad" name="art_cantidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_art_unidades">Unidades</label>
                <input type="text" id="edit_art_unidades" name="art_unidades" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_cat_id">Categoría</label>
                <select id="edit_cat_id" name="cat_id" class="form-control" required>
                    <!-- Aquí se llenarán las opciones con JavaScript -->
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-cancel" onclick="document.getElementById('editArticuloModal').close();">Cancelar</button>
        </div>
    </form>
</dialog>