@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Proveedores -->
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div>
    <div class=" p-16">
        <div>
            <h3 class="text-purple-600">Registros Auditoria</h3>
        </div>
        <div>
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                        <th>Descripción </th>
                        <th>Tabla</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auditoria as $aud)
                    <tr>
                        <td data-label="usu_id">{{ $aud->id_aud }}</td>
                        <td data-label="aud_fecha">{{ $aud->aud_fecha }}</td>
                        <td data-label="aud_accion">{{ $aud->aud_accion }}</td>
                        <td data-label="aud_descripcion ">{{ $aud->aud_descripcion }}</td>
                        <td data-label="aud_table ">{{ $aud->aud_table }}</td>
                        <!-- <td data-label="Acciones">
                                <button class="btn btn-edit" data-id="{{ $aud->id_aud }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                <button class="btn btn-delete" data-id="{{ $aud->id_aud }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- @include('vistas.proveedores.modal') -->

<!-- <script src="{{ asset('js/proveedores.js') }}"></script> -->
@endsection