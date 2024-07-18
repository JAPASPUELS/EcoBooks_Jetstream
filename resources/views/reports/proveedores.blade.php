<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Proveedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .header img {
            float: right;
            max-height: 150px;
            max-width: 212.39px;
            margin-top: -10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header">
        <img src="{{ public_path('images/logo_EcoBooks.jpg') }}" alt="Logo">
            <div class="details">
                <h1 class="text-2xl font-bold">Reporte de Proveedores</h1>
                <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
                @if (auth()->user())
                    <p>Generado por: {{ auth()->user()->name }}</p>
                    <p>Email: {{ auth()->user()->email }}</p>
                @endif
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono 1</th>
                <th>Teléfono 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->pro_id }}</td>
                    <td>{{ $proveedor->pro_nombre }}</td>
                    <td>{{ $proveedor->pro_email }}</td>
                    <td>{{ $proveedor->direccion_pro }}</td>
                    <td>{{ $proveedor->pro_telefono1 }}</td>
                    <td>{{ $proveedor->pro_telefono2 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
