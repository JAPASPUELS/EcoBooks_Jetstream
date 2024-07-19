<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header,
        .footer {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
        }

        .row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .col-xs-10,
        .col-xs-2,
        .col-xs-6,
        .col-xs-12 {
            padding: 10px;
        }

        .col-xs-10 {
            width: 80%;
        }

        .col-xs-2,
        .col-xs-6 {
            width: 20%;
        }

        .col-xs-12 {
            width: 100%;
        }

        h1,
        h2,
        h4 {
            margin: 0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f4f4f4;
        }

        .totals {
            text-align: left;
            margin-top: 20px;
            margin-bottom: 20px;
            padding-left: 80%;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Factura</h1>
            <img src="logo.png" alt="Logotipo">
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-10">
                <h2>Cliente: {{ $user->cli_nombre }} {{ $user->cli_apellido }}</h2>
                <table>
                <tr>
                    <td><strong>Cedula Cliente:</strong></td>
                    <td>{{ $user->cli_codigo }}</td>
                </tr>
                <tr>
                    <td><strong>Correo:</strong></td>
                    <td>{{ $user->cli_correo }}</td>
                </tr>
                <tr>
                    <td><strong>Dirección:</strong></td>
                    <td>{{ $user->cli_direccion }}</td>
                </tr>
                <tr>
                    <td><strong>Factura No.:</strong></td>
                    <td>{{ $venta->vent_numero }}</td>
                </tr>
                <tr>
                    <td><strong>Forma de Pago:</strong></td>
                    <td>{{ $venta->pagos->first()->formaPago->fpa_nombre }}</td>
                </tr>
            </table>
            </div>
            
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Envase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venta->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->articulo->art_nombre }}</td>
                            <td>{{ $detalle->det_unidades }}</td>
                            <td>{{ number_format($detalle->articulo->art_precio, 2) }}</td>
                            <td>{{ number_format($detalle->det_unidades * $detalle->articulo->art_precio, 2) }}</td>
                            <td>{{ $detalle->art_envase ? 'S $-0,15' : 'N $0' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="totals">
            <strong>SUBTOTAL $</strong>
            <br>
            {{ number_format($venta->vent_subtotal, 2) }}
            <br>
            <strong>DESCUENTO $</strong>
            <br>
            @php
            $subtotalSinIVA = $venta->vent_total / 1.15;
            $discount = $venta->vent_subtotal - $subtotalSinIVA;
            @endphp
            {{ number_format($discount, 2) }}
            <br>
            <strong>IVA (15%) $</strong>
            <br>
            {{ number_format($subtotalSinIVA * 0.15, 2) }}
            <br>
            <strong>TOTAL $</strong>
            <br>
            {{ number_format($venta->vent_total, 2) }}
        </div>
        <hr>
        <div class="footer">
            <p>Venta registrada por: <strong>{{ $venta->user->name }}</strong></p>
            <p>Gracias por su compra</p>
        </div>
    </div>
</body>

</html>