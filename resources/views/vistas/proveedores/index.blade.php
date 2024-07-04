@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Proveedores -->
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div>
    <div>
        <div>
            <h3>Modificar Proveedor</h3>
        </div>
        <div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Teléfono 1</th>
                        <th>Teléfono 2</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td data-label="Apellido">{{ $proveedor->pro_apellido }}</td>
                            <td data-label="Nombre">{{ $proveedor->pro_nombre }}</td>
                            <td data-label="Dirección">{{ $proveedor->direccion_pro }}</td>
                            <td data-label="Email">{{ $proveedor->pro_email }}</td>
                            <td data-label="Teléfono 1">{{ $proveedor->pro_telefono1 }}</td>
                            <td data-label="Teléfono 2">{{ $proveedor->pro_telefono2 }}</td>
                            <td data-label="Acciones">
                                <button class="btn btn-edit" data-id="{{ $proveedor->pro_id }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-delete" data-id="{{ $proveedor->pro_id }}">
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

@include('vistas.proveedores.modal')

<script src="{{ asset('js/proveedores.js') }}"></script>
@endsection
