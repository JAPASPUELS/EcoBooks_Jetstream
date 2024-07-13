@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Proveedores -->
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div>
    <div class=" p-16">
        <div>
            <!-- <h3 class="text-purple-600">Registros Ventas</h3> -->
        </div>
        <div>
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $vnt)
                    <tr>
                        <td data-label="vent_numero">{{ $vnt->vent_numero }}</td>
                        <td data-label="cli_codigo">{{ $vnt-> cli_codigo }}</td>
                        <td data-label="vent_fecha">{{ $vnt-> vent_fecha }}</td>
                        <td data-label="vent_total">{{ $vnt-> vent_total }}</td>
                        <td data-label="Acciones">
                            <button class="btn btn-edit" data-id="{{ $vnt->vent_numero }}">
                                <i class='bx bx-edit'></i>
                            </button>
                            <button class="btn btn-delete" data-id="{{ $vnt->vent_numero }}">
                                <i class='bx bx-trash'></i>
                            </button>
                            <button class="btn btn-edit" data-id="{{ $vnt->vent_numero }}">
                                <i class='bx bx-show'></i>
                            </button>
 
                        </td>
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