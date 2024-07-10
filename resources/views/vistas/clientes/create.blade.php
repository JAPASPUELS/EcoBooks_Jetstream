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
        // Resetear el contenido del error
        cliCodigoError.textContent = '';
        const allErrorMessages = document.querySelectorAll('.text-danger');
        allErrorMessages.forEach(error => error.textContent = '');

        let isValid = true;

        if (cliIdentificacion.value === 'CI' && !validarCedula(cliCodigo.value)) {
            isValid = false;
            cliCodigoError.textContent = 'Cédula ecuatoriana inválida.';
        } else if (cliIdentificacion.value === 'RUC' && !validarRUC(cliCodigo.value)) {
            isValid = false;
            cliCodigoError.textContent = 'RUC ecuatoriano inválido.';
        }

        if (!isValid) {
            event.preventDefault();
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

        const numeroProvincia = parseInt(ruc.substring(0, 2));
        if (numeroProvincia < 1 || numeroProvincia > 24) return false;

        const tipo = parseInt(ruc.charAt(2));
        if (![6, 9].includes(tipo) && tipo > 5) return false;

        const coeficientesPub = [3, 2, 7, 6, 5, 4, 3, 2];
        const coeficientesPri = [4, 3, 2, 7, 6, 5, 4, 3, 2];
        const coeficientesNat = [2, 1, 2, 1, 2, 1, 2, 1, 2];

        let suma = 0;
        let digitoVerificador = parseInt(ruc.charAt(9));

        if (tipo === 6) { // Público
            for (let i = 0; i < 8; i++) {
                suma += parseInt(ruc.charAt(i)) * coeficientesPub[i];
            }
            let residuo = suma % 11;
            residuo = residuo === 0 ? 0 : 11 - residuo;
            return residuo === digitoVerificador;
        } else if (tipo === 9) { // Privado
            for (let i = 0; i < 9; i++) {
                suma += parseInt(ruc.charAt(i)) * coeficientesPri[i];
            }
            let residuo = suma % 11;
            residuo = residuo === 0 ? 0 : 11 - residuo;
            return residuo === digitoVerificador;
        } else { // Natural
            for (let i = 0; i < 9; i++) {
                let valor = parseInt(ruc.charAt(i)) * coeficientesNat[i];
                suma += valor >= 10 ? valor - 9 : valor;
            }
            let residuo = suma % 10;
            residuo = residuo === 0 ? 0 : 10 - residuo;
            return residuo === digitoVerificador;
        }
    }
});
</script>
@endsection
