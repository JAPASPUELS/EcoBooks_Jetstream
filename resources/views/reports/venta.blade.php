<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factura</title>
</head>
<body>
    <div class="row">
        <div class="col-xs-10">
            <h1>Factura</h1>
        </div>
        <div class="col-xs-2">
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-xs-10">
          
        </div>
        <div class="col-xs-2 text-center">
            <strong>Factura No.</strong>
            <br>
            {{ $venta->vent_numero }}
            <br>
            <strong>Forma de Pago</strong>
            <br>
            {{ $venta->pagos->first()->formaPago->fpa_nombre }}
            <br>
            <strong>Valor del Pago</strong>
            <br>
            {{ $venta->pagos->first()->pag_valor }}
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
                        <td>{{ $detalle->art_envase ? 'S' : 'N' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-right">
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
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 text-right">
            <p>Venta registrada por: <strong>{{ $venta->user->name }}</strong></p>
        </div>
    </div>
</body>
</html>
