<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Gastos</title>
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
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
            height: 100px;
            margin-right: 20px;
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
        {{-- <img src="{{ public_path('images/logo_EcoBooks.jpg') }}" alt="Logo"> --}}
        <div class="details">
            <h1 class="text-2xl font-bold">Reporte de Gastos</h1>
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
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Valor</th>
                <th>Creado Por</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gastos as $gast)
                <tr class="border-t">
                    <td>{{ $gast->gast_id }}</td>
                    <td>{{ $gast->gast_fecha }}</td>
                    <td>{{ $gast->gast_descripcion }}</td>
                    <td>$ {{ $gast->gast_valor }}</td>
                    <td>{{ $gast->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
