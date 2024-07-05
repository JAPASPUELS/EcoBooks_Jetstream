@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Inventario -->
<link rel="stylesheet" href="{{ asset('css/inventario.css') }}">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Inventario</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('inventario.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="art_id">
                        <i class="fas fa-barcode icon-celeste"></i> ID del Artículo
                    </label>
                    <input type="text" class="form-control" id="art_id" name="art_id" value="{{ old('art_id') }}" required>
                    @error('art_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inv_fecha">
                        <i class="fas fa-calendar-alt icon-celeste"></i> Fecha de Inventario
                    </label>
                    <input type="datetime-local" class="form-control" id="inv_fecha" name="inv_fecha" value="{{ old('inv_fecha') }}" required>
                    @error('inv_fecha')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inv_cantidad">
                        <i class="fas fa-cubes icon-celeste"></i> Cantidad de Inventario
                    </label>
                    <input type="number" step="0.01" class="form-control" id="inv_cantidad" name="inv_cantidad" value="{{ old('inv_cantidad') }}" required>
                    @error('inv_cantidad')
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
