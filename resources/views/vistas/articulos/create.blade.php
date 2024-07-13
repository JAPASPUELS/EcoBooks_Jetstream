@extends('dashboard')

@section('content')
<!-- Incluir el archivo CSS de Articulos -->
<link rel="stylesheet" href="{{ asset('css/articulos.css') }}">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Artículo</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('articulos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="art_nombre">
                        <i class="fas fa-box icon-celeste"></i> Nombre del Artículo
                    </label>
                    <input type="text" class="form-control" id="art_nombre" name="art_nombre" value="{{ old('art_nombre') }}" required>
                    @error('art_nombre')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="art_precio">
                        <i class="fas fa-dollar-sign icon-celeste"></i> Precio del Artículo
                    </label>
                    <input type="number" step="0.01" class="form-control" id="art_precio" name="art_precio" value="{{ old('art_precio') }}" required>
                    @error('art_precio')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="art_cantidad">
                        <i class="fas fa-sort-numeric-up icon-celeste"></i> Cantidad del Artículo
                    </label>
                    <input type="number" class="form-control" id="art_cantidad" name="art_cantidad" value="{{ old('art_cantidad') }}" required>
                    @error('art_cantidad')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="art_unidades">
                        <i class="fas fa-cube icon-celeste"></i> Unidad de Medida
                    </label>
                    <input type="text" class="form-control" id="art_unidades" name="art_unidades" value="{{ old('art_unidades') }}" required>
                    @error('art_unidades')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cat_id">
                        <i class="fas fa-tags icon-celeste"></i> Categoría del Artículo
                    </label>
                    <select class="form-control" id="cat_id" name="cat_id" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->cat_id }}">{{ $categoria->cat_name }}</option>
                        @endforeach
                    </select>
                    @error('cat_id')
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