
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
            <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad
                Inventariada</th>
            <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
            <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Registrado
                Por</th>
        </tr>
    </thead>
    <tbody id="detalleTable" class="bg-white divide-y divide-gray-200">
        @foreach ($data as $item)
            <tr>
                <td class="py-3">{{ $item->product->art_nombre }}</td>
                <td class="py-3">{{ $item->inv_cantidad_ing }}</td>
                <td class="py-3">{{ $item->inv_fecha }}</td>
                <td class="py-3">{{ $item->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="pagination-links flex justify-between">
    @if ($data->hasPages())
        <ul class="pagination flex justify-center mt-4 mb-4">
            @if ($data->onFirstPage())
                <li class="page-item disabled"><span
                        class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Anterior</span>
                </li>
            @else
                <li class="page-item"><a href="{{ $data->previousPageUrl() }}" class="page-link"
                        onclick="fetchPage('{{ $data->previousPageUrl() }}'); return false;">Anterior</a>
                </li>
            @endif

            @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                @if ($page == $data->currentPage())
                    <li class="page-item active"><span
                            class="page-link bg-blue-500 text-white">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link"
                            onclick="fetchPage('{{ $url }}'); return false;">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            @if ($data->hasMorePages())
                <li class="page-item"><a href="{{ $data->nextPageUrl() }}" class="page-link"
                        onclick="fetchPage('{{ $data->nextPageUrl() }}'); return false;">Siguiente</a>
                </li>
            @else
                <li class="page-item disabled"><span
                        class="page-link bg-gray-200 text-gray-500 cursor-not-allowed">Siguiente</span>
                </li>
            @endif
        </ul>
    @endif
    <p class="text-sm text-gray-500 px-4 py-4">
        Mostrando {{ $data->firstItem() }} - {{ $data->lastItem() }} de {{ $data->total() }}
        registros
    </p>
</div>