<dialog id="editClienteModal" class="modal">
    <div class="modal-header">
        <h5 class="modal-title">Editar Cliente</h5>
        <button type="button" class="close" onclick="document.getElementById('editClienteModal').close();">
            &times;
        </button>
    </div>
    <form id="editClienteForm">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_cli_codigo" name="cli_codigo">
            <div class="form-group">
                <label for="edit_cli_nombre">Nombre del Cliente</label>
                <input type="text" id="edit_cli_nombre" name="cli_nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_cli_apellido">Apellido del Cliente</label>
                <input type="text" id="edit_cli_apellido" name="cli_apellido" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_cli_correo">Email del Cliente</label>
                <input type="email" id="edit_cli_correo" name="cli_correo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_cli_direccion">Dirección del Cliente</label>
                <input type="text" id="edit_cli_direccion" name="cli_direccion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_cli_identificacion">Identificación del Cliente</label>
                <select id="edit_cli_identificacion" name="cli_identificacion" class="form-control" required>
                    <option value="CI">Cédula (CI)</option>
                    <option value="PP">Pasaporte (PP)</option>
                    <option value="RUC">RUC</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-cancel" onclick="document.getElementById('editClienteModal').close();">Cancelar</button>
        </div>
    </form>
</dialog>
