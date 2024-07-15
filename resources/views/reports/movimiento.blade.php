<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Movimientos </title>
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
    <h1>Reporte de Movimientos</h1>
    <table>
        <thead>
            <tr>  
                <th>Id</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Stock Previo</th>
                <th>Stock Actual</th>
                <th>Registrado Por</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $reg)
                <tr>
                    <td>{{ $reg->mov_id}}</td>
                    <td>{{ $reg->mov_fecha}}</td>
                    <td>{{ $reg->mov_tipo}}</td>
                    <td>{{ $reg->mov_cantidad}}</td>
                    <td>{{ $reg->product->art_nombre}}</td>
                    <td>{{ $reg->stock_previo}}</td>
                    <td>{{ $reg->stock_actual}}</td>
                    <td>{{ $reg->user->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
