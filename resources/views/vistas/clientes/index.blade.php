@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Clientes -->
<link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

<div>
    <div>
        <div>
            <h3>Modificar Cliente</h3>
        </div>
        <div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Identificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td data-label="Código">{{ $cliente->cli_codigo }}</td>
                            <td data-label="Nombre">{{ $cliente->cli_nombre }}</td>
                            <td data-label="Apellido">{{ $cliente->cli_apellido }}</td>
                            <td data-label="Correo">{{ $cliente->cli_correo }}</td>
                            <td data-label="Dirección">{{ $cliente->cli_direccion }}</td>
                            <td data-label="Identificación">{{ $cliente->cli_identificacion }}</td>
                            <td data-label="Acciones">
                                <button class="btn btn-edit" data-id="{{ $cliente->cli_codigo }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-delete" data-id="{{ $cliente->cli_codigo }}">
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

@include('vistas.clientes.modal')

<script src="{{ asset('js/clientes.js') }}"></script>
@endsection
