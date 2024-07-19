@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Usuarios -->
<link rel="stylesheet" href="{{ asset('css/users.css') }}">

<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
    <div>
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900">Gestionar Usuarios</h3>
        </div>
        <div class="px-6 py-4 flex items-center space-x-4">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="openModalBtn">
                Nuevo Usuario
            </button>
            <form method="GET" action="{{ route('users.index') }}" class="flex items-center space-x-2">
                <input type="text" id="searchInput" name="search" class="custom-input" placeholder="Buscar..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>
</div>

<h2 class="title-custom">Lista de Usuarios</h2>
<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
    <table id="usersTable" class="min-w-full divide-y divide-gray-200 table">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo Electrónico</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody id="usersTable" class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
            <tr data-id="{{ $user->id }}">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->role->rol_nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <button class="btn-edit-role" data-id="{{ $user->id }}">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn-delete" data-id="{{ $user->id }}">
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-links flex justify-between px-6 py-4">
        {{ $users->links() }}
    </div>
</div>

@include('vistas.users.modal')
@include('vistas.users.modal-edit-role')

<script src="{{ asset('js/users.js') }}"></script>
@endsection
