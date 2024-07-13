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
            <form action="{{ route('clientes.store') }}" method="POST" id="clienteForm">
                @csrf
                <div class="form-group">
                    <label for="cli_identificacion">
                        <i class="fas fa-id-card icon-celeste"></i> Tipo de Identificación
                    </label>
                    <select class="form-control" id="cli_identificacion" name="cli_identificacion" required>
                        <option value="">Seleccione...</option>
                        <option value="CI" {{ old('cli_identificacion') == 'CI' ? 'selected' : '' }}>Cédula (CI)</option>
                        <option value="RUC" {{ old('cli_identificacion') == 'RUC' ? 'selected' : '' }}>RUC</option>
                    </select>
                    @error('cli_identificacion')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cli_codigo">
                        <i class="fas fa-id-card icon-celeste"></i> Identificación del Cliente
                    </label>
                    <input type="text" class="form-control" id="cli_codigo" name="cli_codigo" value="{{ old('cli_codigo') }}" required>
                    <div class="text-danger" id="cli_codigo_error"></div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const clienteForm = document.getElementById('clienteForm');
    const cliIdentificacion = document.getElementById('cli_identificacion');
    const cliCodigo = document.getElementById('cli_codigo');
    const cliCodigoError = document.getElementById('cli_codigo_error');

    clienteForm.addEventListener('submit', function(event) {
        cliCodigoError.textContent = '';

        if (cliIdentificacion.value === 'CI' && !validarCedula(cliCodigo.value)) {
            event.preventDefault();
            cliCodigoError.textContent = 'Cédula ecuatoriana inválida.';
        } else if (cliIdentificacion.value === 'RUC' && !validarRUC(cliCodigo.value)) {
            event.preventDefault();
            cliCodigoError.textContent = 'RUC ecuatoriano inválido.';
        }
    });

    function validarCedula(cedula) {
        if (cedula.length !== 10) return false;

        var digito_region = cedula.substring(0, 2);
        if (digito_region < 1 || digito_region > 24) return false;

        var ultimo_digito = cedula.substring(9, 10);
        var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));
        var numero1 = cedula.substring(0, 1) * 2;
        if (numero1 > 9) { numero1 -= 9; }
        var numero3 = cedula.substring(2, 3) * 2;
        if (numero3 > 9) { numero3 -= 9; }
        var numero5 = cedula.substring(4, 5) * 2;
        if (numero5 > 9) { numero5 -= 9; }
        var numero7 = cedula.substring(6, 7) * 2;
        if (numero7 > 9) { numero7 -= 9; }
        var numero9 = cedula.substring(8, 9) * 2;
        if (numero9 > 9) { numero9 -= 9; }
        var impares = numero1 + numero3 + numero5 + numero7 + numero9;
        var suma_total = pares + impares;
        var primer_digito_suma = String(suma_total).substring(0, 1);
        var decena = (parseInt(primer_digito_suma) + 1) * 10;
        var digito_validador = decena - suma_total;
        if (digito_validador == 10) { digito_validador = 0; }

        return digito_validador == ultimo_digito;
    }

    function validarRUC(ruc) {
        if (ruc.length !== 13) return false;
        var numero_provincia = parseInt(ruc.substring(0, 2));
        if (numero_provincia < 1 || numero_provincia > 24) return false;

        var d = [];
        var suma = 0;
        var residuo = 0;
        var pri = false;
        var pub = false;
        var nat = false;
        var numero = ruc.substring(0, 9);
        var digito_verificador = parseInt(ruc.substring(9, 10));
        var digito_verificador_ruc = parseInt(ruc.substring(10, 11));

        for (var i = 0; i < numero.length; i++) {
            d[i] = parseInt(numero.charAt(i));
        }

        if (d[2] === 6) pub = true;
        else if (d[2] === 9) pri = true;
        else if (d[2] < 6) nat = true;

        if (nat) {
            for (i = 0; i < d.length - 1; i++) {
                if (i % 2 === 0) {
                    d[i] *= 2;
                    if (d[i] > 9) d[i] -= 9;
                }
                suma += d[i];
            }
            residuo = suma % 10;
            if (residuo !== 0) residuo = 10 - residuo;
            return residuo === digito_verificador;
        } else if (pub) {
            var coeficientes = [3, 2, 7, 6, 5, 4, 3, 2];
            for (i = 0; i < d.length - 1; i++) {
                suma += d[i] * coeficientes[i];
            }
            residuo = suma % 11;
            if (residuo !== 0) residuo = 11 - residuo;
            return residuo === digito_verificador;
        } else if (pri) {
            coeficientes = [4, 3, 2, 7, 6, 5, 4, 3, 2];
            for (i = 0; i < d.length - 1; i++) {
                suma += d[i] * coeficientes[i];
            }
            residuo = suma % 11;
            if (residuo !== 0) residuo = 11 - residuo;
            return residuo === digito_verificador;
        }

        return false;
    }
});
</script>
@endsection
