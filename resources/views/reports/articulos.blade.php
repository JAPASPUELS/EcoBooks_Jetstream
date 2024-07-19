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
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .header img {
            float: right;
            max-height: 150px;
            max-width: 212.39px;
            margin-top: -40px;
        }

        .details {
            display: flex;
            flex-direction: column;
        }

        .details h1 {
            margin: 0;
            font-size: 24px;
        }

        .details p {
            margin: 0;
            color: gray;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo_EcoBooks.jpg') }}" alt="Logo">
        <div class="details">
            <h1 class="text-2xl font-bold">Reporte de Articulos</h1>
            <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
            @if (auth()->user())
            <p>Generado por: {{ auth()->user()->name }}</p>
            <p>Email: {{ auth()->user()->email }}</p>
            @endif
        </div>
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