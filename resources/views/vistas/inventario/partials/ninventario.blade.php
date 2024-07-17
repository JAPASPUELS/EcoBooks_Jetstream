<table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-sm">
    <thead class="bg-gray-50">
        <tr>
            <th class="py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
            <th class="py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Unidades</th>
            <th class="py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
            <th class="py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad Producto</th>
            <th class="py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad Inventariada</th>
            <th class="py-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider justify-center text-center">Validación</th>
        </tr>
    </thead>
    <tbody id="detalleTable" class="bg-white divide-y divide-gray-200" style="display: block; height: 200px; overflow-y: auto;">
        @foreach ($data as $item)
            <tr data-id="{{ $item->art_id }}" style="display: table; width: 100%; table-layout: fixed; " class="hover:bg-gray-100">
                <td class="py-3 px-4">{{ $item->art_nombre }}</td>
                <td class="py-3 px-4">{{ $item->art_unidades }}</td>
                <td class="py-3 px-4">{{ $item->art_precio }}</td>
                <td class="py-3 px-6">
                    <input type="number" value="{{ $item->art_cantidad }}" disabled class="cantidad-input w-20 rounded-lg mr-2">
                    <button class="edit-btn text-blue-500"><i class="fas fa-pencil-alt"></i></button>
                </td>
                <td class="py-3 px-6">
                    <input type="number" class="inventariada-input w-20 rounded-lg">
                </td>
                <td class="validation-icon px-3 justify-center text-center"></td>
            </tr>
        @endforeach
    </tbody>
</table>