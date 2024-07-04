@extends('dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>+ Nueva Factura</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cedula" class="form-label">Cedula</label>
                            <input type="text" class="form-control" id="cedula" placeholder="9999999999">
                        </div>
                        <div class="form-group">
                            <label for="cliente" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="cliente" placeholder="Juan Perez">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="juanhernandezm2208@gmail.com">
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celular" placeholder="09981345688">
                        </div>
                        <div class="form-group">
                            <label for="pago" class="form-label">Pago</label>
                            <input type="text" class="form-control" id="pago" placeholder="Efectivo">
                        </div>
                        
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" value="2024-07-04">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="pagado">
                            <label class="form-check-label ms-2" for="pagado">
                                Pagado
                            </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-primary me-2">+ Nuevo producto</button>
                        <button type="button" class="btn btn-secondary me-2">+ Nuevo cliente</button>
                        <button type="button" class="btn btn-success me-2">Agregar productos</button>
                        <button type="button" class="btn btn-info">Guardar</button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10%;">CODIGO</th>
                            <th style="width: 10%;">CANT.</th>
                            <th style="width: 50%;">DESCRIPCION</th>
                            <th style="width: 10%;">PRECIO UNIT.</th>
                            <th style="width: 10%;">PRECIO TOTAL</th>
                            <th style="width: 10%;">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2604759</td>
                            <td>1</td>
                            <td>Mouse mini inalámbrico</td>
                            <td>25.00</td>
                            <td>25.00</td>
                            <td><button type="button" class="btn btn-danger btn-sm">Eliminar</button></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" class="text-end">SUBTOTAL $</td>
                            <td>25.00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">IVA (13%) $</td>
                            <td>3.25</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">TOTAL $</td>
                            <td>28.25</td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection

