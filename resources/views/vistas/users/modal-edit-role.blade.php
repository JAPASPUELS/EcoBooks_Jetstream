<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editRoleModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full modal-custom">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Editar Rol de Usuario</h3>
                    <button type="button" class="close absolute right-4 top-4" id="closeEditRoleModalBtn">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mt-2">
                    <form method="POST" action="{{ route('users.updateRole') }}" id="editRoleForm" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="form-group">
                            <label for="edit_user_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit_user_name" name="user_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_user_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="edit_user_email" name="user_email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_role_id" class="form-label">Rol</label>
                            <select class="form-control" id="edit_role_id" name="role_id" required>
                                @foreach($roles as $role)
                                <option value="{{ $role->rol_id }}">{{ $role->rol_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" id="closeEditRoleModal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>