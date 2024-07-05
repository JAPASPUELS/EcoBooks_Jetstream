@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Proveedores -->
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div>
    <div class="mx-5">
        <div class="flex justify-between items-center">
            <h3 class="text-green-600 font-bold">Categorías</h3>
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-toggle="modal" data-target="#nuevoRegistroModal">
                Nuevo Registro
            </button>
        </div>
        <div class="mt-5">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>En Uso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td data-label="Id">{{ $cat->cat_id }}</td>
                        <td data-label="Nombre">{{ $cat->cat_name }}</td>
                        <td data-label="Descripción">{{ $cat->cat_description }}</td>
                        <td data-label="En Uso">{{ $cat->enUso }}</td>
                        <td data-label="Acciones">
                        <button class="btn btn-edit" data-id="{{ $cat->cat_id }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-delete" data-id="{{ $cat->cat_id }}" data-uso="{{ $cat->enUso }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="nuevoRegistroModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-plus text-green-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Nuevo Registro</h3>
                        <div class="mt-2">
                            <form id="nuevoRegistroForm" method="POST" action="{{ route('categorias.store') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="cat_name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="cat_name" id="cat_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="mb-4">
                                    <label for="cat_description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <textarea name="cat_description" id="cat_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('nuevoRegistroForm').submit();">
                    Guardar     
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" id="closeModal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/categoria.js') }}"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('nuevoRegistroModal');
        const openModalBtn = document.querySelector('[data-toggle="modal"]');
        const closeModalBtn = document.getElementById('closeModal');

        openModalBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    });
</script>
@endsection
