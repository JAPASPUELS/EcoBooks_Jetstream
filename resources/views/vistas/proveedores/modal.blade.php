<dialog id="editProveedorModal" class="modal">
    <div class="modal-header">
        <h5 class="modal-title">Editar Proveedor</h5>
        <button type="button" class="close" onclick="document.getElementById('editProveedorModal').close();">
            &times;
        </button>
    </div>
    <form id="editProveedorForm">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_pro_id" name="pro_id">
            <div class="form-group">
                <label for="edit_pro_nombre">Nombre del Proveedor</label>
                <input type="text" id="edit_pro_nombre" name="pro_nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_direccion_pro">Dirección del Proveedor</label>
                <input type="text" id="edit_direccion_pro" name="direccion_pro" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_pro_email">Email del Proveedor</label>
                <input type="email" id="edit_pro_email" name="pro_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_pro_telefono1">Teléfono 1</label>
                <input type="text" id="edit_pro_telefono1" name="pro_telefono1" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_pro_telefono2">Teléfono 2 (Opcional)</label>
                <input type="text" id="edit_pro_telefono2" name="pro_telefono2" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-cancel" onclick="document.getElementById('editProveedorModal').close();">Cancelar</button>
        </div>
    </form>
</dialog>
