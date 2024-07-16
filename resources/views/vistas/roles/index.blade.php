@extends('dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">
    <div>
        <div class="mx-5">
            <div class="flex justify-start items-center">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="openModalBtn">
                    Nuevo
                </button>
                {{-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" id="reportBtn">
                    Reportes
                </button> --}}

            </div>

            <!-- Barra de búsqueda -->
            <div class="mt-5">
                <input type="text" id="search" class="form-control" placeholder="Buscar categorías...">
            </div>

            <div class="mt-5">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTable">
                        @foreach ($roles as $rol)
                            <tr>
                                <td data-label="Id">{{ $rol->rol_id }}</td>
                                <td data-label="Nombre">{{ $rol->rol_nombre }}</td>
                                <td data-label="Descripción">{{ $rol->rol_descripcion }}</td>
                                <td data-label="Estado">
                                    @if ($rol->active == 1)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td data-label="Acciones">
                                    <button class="btn btn-edit" data-id="{{ $rol->rol_id }}"
                                        data-name="{{ $rol->rol_nombre }}" data-description="{{ $rol->rol_descripcion }}"
                                        data-active="{{ $rol->active }}">
                                        <i class='bx bx-edit'></i>
                                    </button>
                                    <button class="btn btn-delete" data-id="{{ $rol->rol_id }}"
                                        data-uso="{{ $rol->active }}">
                                        <i class='bx bx-refresh'></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    <nav class="flex items-center  justify-center">
                        {{ $roles->links() }}
                        {{-- {{ $roles->onEachSide(1)->links('pagination::tailwind') }} --}}
                    </nav>
                </div>
            </div>
        </div>

        <!-- Modal para nuevo registro y edición -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="registroModal" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-20 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Fondo oscuro transparente -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Contenedor principal del modal -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Encabezado del modal -->
                        <div class="mt-3 text-center sm:items-start sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Nuevo Registro</h3>
                            <!-- Formulario dentro del modal -->
                            <div class="mt-2">
                                <form id="registroForm" method="POST" action="">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="rol_nombre"
                                            class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <input type="text" name="rol_nombre" id="cat_name_modal"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="mb-4">
                                        <label for="rol_descripcion"
                                            class="block text-sm font-medium text-gray-700">Descripción</label>
                                        <textarea name="rol_descripcion" id="cat_description_modal"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Botones de acción del modal -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                            id="saveBtn">
                            Guardar
                        </button>
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                            id="closeModal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para selección de reportes -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden mt-40" id="reportModal" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-20 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Fondo oscuro transparente -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Contenedor principal del modal -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Encabezado del modal -->
                        <div class="mt-3 text-center sm:items-start sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Seleccionar Tipo de
                                Reporte
                            </h3>
                            <!-- Botones de selección de reporte -->
                            <div class="mt-2 ">
                                <span class=" text-yellow-400">Version Pro ✨ </span>
                                <button
                                    class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-500 text-yellow-400 font-medium  hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm opacity-50 cursor-not-allowed"
                                    disabled id="vPro">
                                    Filtros de Reportes
                                </button>
                            </div>
                            <div class="border-t border-gray-300 my-4"></div>
                            <div class="mt-2 ">
                                <button
                                    class="w-full inline-flex justify-center mr-16 rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:w-auto sm:text-sm"
                                    id="excelBtn">
                                    Excel
                                </button>
                                <button
                                    class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-900 text-white font-medium  hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm"
                                    id="pdfBtn">
                                    PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Botón para cerrar modal -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                            id="closeReportModal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('registroModal');
                const openModalBtn = document.getElementById('openModalBtn');
                const closeModalBtn = document.getElementById('closeModal');
                const saveBtn = document.getElementById('saveBtn');
                const registroForm = document.getElementById('registroForm');
                const modalTitle = document.getElementById('modal-title');

                openModalBtn.addEventListener('click', function() {
                    registroForm.action = "{{ route('roles.store') }}";
                    registroForm.reset();
                    modalTitle.textContent = 'Nuevo Registro';
                    registroForm.method = 'POST';
                    const methodInput = registroForm.querySelector('input[name="_method"]');
                    if (methodInput) methodInput.remove();
                    modal.classList.remove('hidden');
                });

                closeModalBtn.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });

                saveBtn.addEventListener('click', function() {
                    registroForm.submit();
                });

                document.querySelectorAll('.btn-edit').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        const description = this.getAttribute('data-description');

                        document.getElementById('cat_name_modal').value = name;
                        document.getElementById('cat_description_modal').value = description;

                        registroForm.action = `/vistas/roles/${id}`;
                        registroForm.method = 'POST';
                        modalTitle.textContent = 'Actualizar Registro';

                        let methodInput = registroForm.querySelector('input[name="_method"]');
                        if (!methodInput) {
                            methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'PUT';
                            registroForm.appendChild(methodInput);
                        }

                        modal.classList.remove('hidden');
                    });
                });

                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const enUso = this.getAttribute('data-active');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "Se cambiara el estado del Rol!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, actualizar!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/vistas/roles/${id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire(
                                                'Actualizado!',
                                                'Se cambio el estado del rol exitosamente.',
                                                'success'
                                            ).then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                data.message,
                                                'error'
                                            );
                                        }
                                    });
                            }
                        });
                    });
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const reportModal = document.getElementById('reportModal');
                const reportBtn = document.getElementById('reportBtn');
                const closeReportModalBtn = document.getElementById('closeReportModal');
                const excelBtn = document.getElementById('excelBtn');
                const pdfBtn = document.getElementById('pdfBtn');

                reportBtn.addEventListener('click', function() {
                    reportModal.classList.remove('hidden');
                });

                closeReportModalBtn.addEventListener('click', function() {
                    reportModal.classList.add('hidden');
                });

                excelBtn.addEventListener('click', function() {
                    // Aquí puedes redirigir a la ruta de generación de reporte Excel
                    window.location.href = "{{ route('report.excel') }}";
                });

                pdfBtn.addEventListener('click', function() {
                    // Aquí puedes redirigir a la ruta de generación de reporte PDF
                    window.location.href = "{{ route('report.pdf') }}";
                });

                const searchInput = document.getElementById('search');
                document.getElementById('search').addEventListener('input', function() {
                    let searchValue = this.value.toLowerCase();
                    let rows = document.querySelectorAll('#categoryTable tr');

                    rows.forEach(row => {
                        let name = row.querySelector('td[data-label="Nombre"]').innerText.toLowerCase();
                        let description = row.querySelector('td[data-label="Descripción"]').innerText
                            .toLowerCase();

                        if (name.includes(searchValue) || description.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        </script>
    @endsection
