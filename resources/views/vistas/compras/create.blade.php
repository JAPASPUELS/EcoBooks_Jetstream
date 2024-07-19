@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Compras -->
<link rel="stylesheet" href="{{ asset('css/compras.css') }}">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Compra</h3>
        </div>
        <div class="card-body">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('compras.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="art_id">
                        <i class="fas fa-box icon-celeste"></i> Artículo
                    </label>
                    <select id="art_id" name="art_id" class="form-control" required>
                        <option value="">Seleccione un artículo</option>
                        @foreach($articulos as $articulo)
                        <option value="{{ $articulo->art_id }}">{{ $articulo->art_nombre }}</option>
                        @endforeach
                    </select>
                    @error('art_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pro_id">
                        <i class="fas fa-truck icon-celeste"></i> Proveedor
                    </label>
                    <select id="pro_id" name="pro_id" class="form-control" required>
                        <option value="">Seleccione un proveedor</option>
                        @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->pro_id }}">{{ $proveedor->pro_nombre }}</option>
                        @endforeach
                    </select>
                    @error('pro_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="comp_numfac">
                        <i class="fas fa-file-invoice icon-celeste"></i> Número de Factura
                    </label>
                    <input type="text" class="form-control" id="comp_numfac" name="comp_numfac" value="{{ old('comp_numfac') }}" required>
                    @error('comp_numfac')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="comp_cantidad">
                        <i class="fas fa-sort-numeric-up icon-celeste"></i> Cantidad
                    </label>
                    <input type="number" class="form-control" id="comp_cantidad" name="comp_cantidad" value="{{ old('comp_cantidad') }}" required>
                    @error('comp_cantidad')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="com_detalles">
                        <i class="fas fa-info-circle icon-celeste"></i> Detalles
                    </label>
                    <textarea class="form-control" id="com_detalles" name="com_detalles">{{ old('com_detalles') }}</textarea>
                    @error('com_detalles')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Registrar
                </button>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endif
@endsection