@extends('.dashboard')

@section('content')
<!-- Incluir el archivo CSS de Clientes -->
<link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Cliente</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cli_codigo">
                        <i class="fas fa-id-card icon-celeste"></i> Código del Cliente
                    </label>
                    <input type="text" class="form-control" id="cli_codigo" name="cli_codigo" value="{{ old('cli_codigo') }}" required>
                    @error('cli_codigo')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cli_nombre">
                        <i class="fas fa-user icon-celeste"></i> Nombre del Cliente
                    </label>
                    <input type="text" class="form-control" id="cli_nombre" name="cli_nombre" value="{{ old('cli_nombre') }}" required>
                    @error('cli_nombre')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cli_apellido">
                        <i class="fas fa-user icon-celeste"></i> Apellido del Cliente
                    </label>
                    <input type="text" class="form-control" id="cli_apellido" name="cli_apellido" value="{{ old('cli_apellido') }}" required>
                    @error('cli_apellido')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cli_correo">
                        <i class="fas fa-envelope icon-celeste"></i> Email del Cliente
                    </label>
                    <input type="email" class="form-control" id="cli_correo" name="cli_correo" value="{{ old('cli_correo') }}" required>
                    @error('cli_correo')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cli_direccion">
                        <i class="fas fa-map-marker-alt icon-celeste"></i> Dirección del Cliente
                    </label>
                    <input type="text" class="form-control" id="cli_direccion" name="cli_direccion" value="{{ old('cli_direccion') }}" required>
                    @error('cli_direccion')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cli_identificacion">
                        <i class="fas fa-id-card icon-celeste"></i> Identificación del Cliente
                    </label>
                    <select class="form-control" id="cli_identificacion" name="cli_identificacion" required>
                        <option value="">Seleccione...</option>
                        <option value="CI" {{ old('cli_identificacion') == 'CI' ? 'selected' : '' }}>Cédula (CI)</option>
                        <option value="PP" {{ old('cli_identificacion') == 'PP' ? 'selected' : '' }}>Pasaporte (PP)</option>
                        <option value="RUC" {{ old('cli_identificacion') == 'RUC' ? 'selected' : '' }}>RUC</option>
                    </select>
                    @error('cli_identificacion')
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
