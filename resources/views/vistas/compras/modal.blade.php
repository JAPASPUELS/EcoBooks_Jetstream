<dialog id="editCompraModal" class="modal">
    <div class="modal-header">
        <h5 class="modal-title">Editar Compra</h5>
        <button type="button" class="close" onclick="document.getElementById('editCompraModal').close();">
            &times;
        </button>
    </div>
    <form id="editCompraForm">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_comp_id" name="comp_id">
            <div class="form-group">
                <label for="edit_art_id">Artículo</label>
                <select id="edit_art_id" name="art_id" class="form-control" required>
                    <!-- Aquí se llenarán las opciones con JavaScript -->
                </select>
            </div>
            <div class="form-group">
                <label for="edit_pro_id">Proveedor</label>
                <select id="edit_pro_id" name="pro_id" class="form-control" required>
                    <!-- Aquí se llenarán las opciones con JavaScript -->
                </select>
            </div>
            <div class="form-group">
                <label for="edit_comp_numfac">Número de Factura</label>
                <input type="text" id="edit_comp_numfac" name="comp_numfac" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_comp_cantidad">Cantidad</label>
                <input type="number" id="edit_comp_cantidad" name="comp_cantidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_com_detalles">Detalles</label>
                <textarea id="edit_com_detalles" name="com_detalles" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-cancel" onclick="document.getElementById('editCompraModal').close();">Cancelar</button>
        </div>
    </form>
</dialog>