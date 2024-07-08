<dialog id="productModal" class="modal">
    <div class="modal-header flex items-center justify-between p-4 border-b border-gray-200 rounded-t">
        <h5 class="modal-title text-xl font-medium">Buscar productos</h5>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" onclick="closeProductModal()">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9l4-4a1 1 0 10-1.4-1.4L10 6.6 6.4 3a1 1 0 00-1.4 1.4l4 4-4 4a1 1 0 001.4 1.4l4-4 4 4a1 1 0 001.4-1.4l-4-4z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    <div class="modal-body p-6">
        <input type="text" class="form-control mb-3 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar productos" id="searchProductInput">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agregar</th>
                </tr>
            </thead>
            <tbody id="productos-lista" class="bg-white divide-y divide-gray-200">
                <!-- Productos serán agregados dinámicamente aquí -->
            </tbody>
        </table>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="inline-flex items-center -space-x-px" id="pagination">
                <!-- Paginación será agregada dinámicamente aquí -->
            </ul>
        </nav>
    </div>
    <div class="modal-footer flex items-center justify-end p-4 border-t border-gray-200 rounded-b">
        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md" onclick="closeProductModal()">Cerrar</button>
    </div>
</dialog>
