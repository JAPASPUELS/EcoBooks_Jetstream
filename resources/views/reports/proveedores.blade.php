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
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Proveedores</h1>
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
            @foreach($proveedores as $proveedor)
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
