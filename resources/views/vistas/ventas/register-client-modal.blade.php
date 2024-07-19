<div id="modalRegistrarCliente" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Registrar Cliente</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="cerrarModalRegistrarCliente()">
                <span class="sr-only">Cerrar</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.293 4.293a1 1 0 011.414 0L10 6.586l2.293-2.293a1 1 0 111.414 1.414L11.414 8l2.293 2.293a1 1 0 01-1.414 1.414L10 9.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 8 6.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <form id="clienteForm" class="p-4">
            @csrf
            <div class="mb-4">
                <label for="cli_identificacion" class="block text-sm font-medium text-gray-700">Tipo de Identificación</label>
                <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cli_identificacion" name="cli_identificacion" required>
                    <option value="">Seleccione...</option>
                    <option value="CI">Cédula (CI)</option>
                    <option value="RUC">RUC</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="cli_codigo" class="block text-sm font-medium text-gray-700">Identificación del Cliente</label>
                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cli_codigo" name="cli_codigo" required>
            </div>
            <div class="mb-4">
                <label for="cli_nombre" class="block text-sm font-medium text-gray-700">Nombre del Cliente</label>
                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cli_nombre" name="cli_nombre" required>
            </div>
            <div class="mb-4">
                <label for="cli_apellido" class="block text-sm font-medium text-gray-700">Apellido del Cliente</label>
                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cli_apellido" name="cli_apellido" required>
            </div>
            <div class="mb-4">
                <label for="cli_correo" class="block text-sm font-medium text-gray-700">Email del Cliente</label>
                <input type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cli_correo" name="cli_correo" required>
            </div>
            <div class="mb-4">
                <label for="cli_direccion" class="block text-sm font-medium text-gray-700">Dirección del Cliente</label>
                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cli_direccion" name="cli_direccion" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="cerrarModalRegistrarCliente()">Cancelar</button>
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Registrar</button>
            </div>
        </form>
    </div>
</div>