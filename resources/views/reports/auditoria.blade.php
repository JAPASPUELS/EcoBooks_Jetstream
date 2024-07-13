<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Categorías</title>
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
    <h1>Reporte Auditoria</h1>
    <table>
        <thead>
            <tr>  
                <th>Id</th>
                <th>Tabla</th>
                <th>Fecha</th>
                <th>Acción</th>
                <th>Descripción</th>
                <th>Realizado Por</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $reg)
                <tr>
                    <td>{{ $reg->id_aud }}</td>
                    <td>{{ $reg->aud_table }}</td>
                    <td>{{ $reg->aud_fecha }}</td>
                    <td>{{ $reg->aud_accion }}</td>
                    <td>{{ $reg->aud_descripcion }}</td>
                    <td>{{ $reg->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
