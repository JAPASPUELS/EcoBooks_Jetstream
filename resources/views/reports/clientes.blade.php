<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Clientes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Clientes</h1>
    <table>
        <thead>
            <tr>  
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cat)
                <tr>
                    <td>{{ $cat->cli_codigo }}</td>
                    <td>{{ $cat->cli_nombre }}</td>
                    <td>{{ $cat->cli_apellido }}</td>
                    <td>{{ $cat->cli_correo }}</td>
                    <td>{{ $cat->cli_direccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
