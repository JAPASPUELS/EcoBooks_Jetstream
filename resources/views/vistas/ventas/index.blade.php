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
                            <button class="btn btn-show" id="pdfBtn" data-venta-id="{{ $vnt->vent_numero }}" onclick="test('{{ $vnt->vent_numero }}')">
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
<script>
    function test(first) {
        console.log(first);
        window.location.href = `/reportvent/pdf/${first}`;
    }
    // document.addEventListener('DOMContentLoaded', function() {
    //     const pdfBtn = document.getElementById('pdfBtn');
    //     const ventaId = pdfBtn.getAttribute('data-venta-id');
       
    //     pdfBtn.addEventListener('click', function() {
    //         console.log(ventaId);
    //         // window.location.href = `/reportvent/pdf/${ventaId}`;
    //     });
    // });
</script>
@endsection