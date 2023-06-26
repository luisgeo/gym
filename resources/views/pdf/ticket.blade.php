<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket de compra</title>
</head>
<style>
    @page {
        margin-top: 2mm;
        margin-right: 3mm;
        margin-left: 3mm;
        margin-bottom: 2mm;
        size: 57mm {{ 15 + $cantidad_productos }}cm;
        font-size: 10px;
        font-family: 'sans-serif';
    }
</style>

<body>
    <div>
        <p style="text-align: center;">
            <img src="{{ base_path() . '/public_html/logo.jpg' }}" height="140px" style="border-radius: 44.5px;">
        </p>
        <p style="text-align: center; font-size: 10px">
            {{ mb_strtoupper($caja->almacen->ubicacion) }}
        </p>
        <p style="text-align: center; font-size: 10px">
            <b>Fecha de compra: {{ mb_strtoupper($fecha) }}</b>
        </p>

        <table>
            <thead>
                <tr>
                    <th style="text-align: left"></th>
                    <th style="text-align: left;"></th>
                    <th style="text-align: left; padding-right:25px;"></th>
                    <th style="text-align: left"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compra as $pedido)
                    <tr style="text-align: left">
                        <td>
                            <span>{{ $pedido->producto->descripcion }}</span>
                            <span style="font-size: 8px;">{{ $pedido->producto->nombre }}</span>
                        </td>
                        <td>
                            ${{ number_format($pedido->precio_aplicado, 2) }}
                            @if ($pedido->descuento_aplicado != 0)
                                <br>-{{ $pedido->descuento_aplicado }}%
                            @endif
                        </td>
                        <td>
                            {{ $pedido->cantidad }} pz
                        </td>
                        <td>
                            ${{ number_format($pedido->cantidad * ($pedido->precio_aplicado - ($pedido->precio_aplicado * $pedido->descuento_aplicado) / 100), 2) }}
                        </td>
                    </tr>
                @endforeach
                <tr style="text-align: left">
                    <td colspan="3" style="padding-top: 2rem;">
                        <b>Total a pagar</b>
                    </td>
                    <td style="padding-top: 2rem;">
                        <b>${{ number_format($reporte->total, 2) }} </b>
                    </td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="3">
                        Pagado
                    </td>
                    <td>
                        ${{ number_format($recibido, 2) }}
                    </td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="3">
                        Cambio
                    </td>
                    <td>
                        ${{ number_format($cambio, 2) }}
                    </td>
                </tr>
                @if (mb_strtolower($reporte->cliente->nombre) != 'invitado')
                    <tr style="text-align: left;">
                        <td colspan="4" style="text-decoration: underline; font-size:9px;  padding-top: 2rem;">
                            Cliente: {{ $reporte->cliente->nombre }} | {{ $reporte->cliente->id_cliente }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <p style="text-align: justify">
            ¡Agradecemos tu preferencia y confianza! 
        </p>
        <p>
            <u>Compraste {{ $cantidad_productos }} producto{{ $cantidad_productos > 1 ? 's' : '' }}.</u>
        </p>

        <p style="font-style: italic">Este no es un comprobante fiscal.</p>
        <p>AC&Ce 2023.</p>
    </div>
</body>

</html>
