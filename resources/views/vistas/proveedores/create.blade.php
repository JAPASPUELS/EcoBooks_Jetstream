@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Proveedores -->
<link rel="stylesheet" href="{{ asset('css/proveedores.css') }}">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Proveedor</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="pro_nombre">
                        <i class="fas fa-user icon-celeste"></i> Nombre del Proveedor
                    </label>
                    <input type="text" class="form-control" id="pro_nombre" name="pro_nombre" value="{{ old('pro_nombre') }}" required>
                    @error('pro_nombre')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pro_apellido">
                        <i class="fas fa-user icon-celeste"></i> Apellido del Proveedor
                    </label>
                    <input type="text" class="form-control" id="pro_apellido" name="pro_apellido" value="{{ old('pro_apellido') }}" required>
                    @error('pro_apellido')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="direccion_pro">
                        <i class="fas fa-map-marker-alt icon-celeste"></i> Dirección del Proveedor
                    </label>
                    <input type="text" class="form-control" id="direccion_pro" name="direccion_pro" value="{{ old('direccion_pro') }}" required>
                    @error('direccion_pro')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pro_email">
                        <i class="fas fa-envelope icon-celeste"></i> Email del Proveedor
                    </label>
                    <input type="email" class="form-control" id="pro_email" name="pro_email" value="{{ old('pro_email') }}" required>
                    @error('pro_email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pro_telefono1">
                        <i class="fas fa-phone icon-celeste"></i> Teléfono 1
                    </label>
                    <input type="text" class="form-control" id="pro_telefono1" name="pro_telefono1" value="{{ old('pro_telefono1') }}" required>
                    @error('pro_telefono1')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pro_telefono2">
                        <i class="fas fa-phone icon-celeste"></i> Teléfono 2 (Opcional)
                    </label>
                    <input type="text" class="form-control" id="pro_telefono2" name="pro_telefono2" value="{{ old('pro_telefono2') }}">
                    @error('pro_telefono2')
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