<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Compras</title>
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
        <h1>Reporte de Compras</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Artículo</th>
                <th>Proveedor</th>
                <th>Número de Factura</th>
                <th>Cantidad</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->comp_id }}</td>
                <td>{{ $compra->articulo->art_nombre }}</td>
                <td>{{ $compra->proveedor->pro_nombre }}</td>
                <td>{{ $compra->comp_numfac }}</td>
                <td>{{ $compra->comp_cantidad }}</td>
                <td>{{ $compra->com_detalles }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>