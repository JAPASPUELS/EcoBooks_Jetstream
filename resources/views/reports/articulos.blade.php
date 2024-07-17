<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Articulos</title>
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
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte de Articulos</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $articulo)
            <tr>
                <td>{{ $articulo->art_id }}</td>
                <td>{{ $articulo->art_nombre }}</td>
                <td>{{ $articulo->art_precio }}</td>
                <td>{{ $articulo->art_cantidad }}</td>
                <td>{{ $articulo->categoria->cat_name ?? 'Sin categoría' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>