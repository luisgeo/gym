<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>
</head>

<body style="font-family: sans-serif;">
    <div class="bg-white flex flex-row flex-wrap p-3"
        style="padding-right: 4rem;  padding-left: 4rem; text-align: center;">
        <div class="mx-auto w-2/3"
            style="background-color: rgba(19, 170, 117, 0.734); border-top-left-radius: 2rem; border-top-right-radius: 2rem; color:rgb(253, 255, 254);padding-top: 2rem; padding-bottom: 2rem;">
            <div class="rounded-lg shadow-lg bg-green-600 w-full flex flex-row flex-wrap p-3">

                <div class="w-full px-3 flex flex-row flex-wrap">
                    <div class="w-full text-center text-gray-700 font-semibold relative pt-3 md:pt-0">
                        <div class="text-2xl text-white leading-tight"
                            style="font-size: 24px;padding-top: 10px; padding-bottom: 10px;">Reporte de ventas</div>
                        <div class="text-normal text-gray-300 hover:text-gray-400 cursor-pointer"
                            style="padding-bottom: 10px; font-size: 18px;"><span
                                class="pb-1">{{ date('Y-m-d') }}</span></div>
                        <div class="text-sm text-gray-300 hover:text-gray-400 cursor-pointer pt-3 md:pt-0 bottom-0 right-0"
                            style="padding-bottom: 10px;">
                            Generado: <b> ${{ count($compras) == 0 ? 0 : $vendido }}</b> pesos mexicanos.
                        </div>
                        @if (isset($apertura))
                            @if ($apertura != null)
                                <div class="text-sm text-gray-300 hover:text-gray-400 cursor-pointer pt-3 md:pt-0 bottom-0 right-0"
                                    style="padding-bottom: 10px;">
                                    Apertura: <b>{{ $fecha_apertura }}:</b> ${{ $apertura }} pesos mexicanos.
                                </div>
                                <div class="text-sm text-gray-300 hover:text-gray-400 cursor-pointer pt-3 md:pt-0 bottom-0 right-0"
                                    style="padding-bottom: 10px;">
                                    Cierre: <b>{{ $fecha_cierre }}:</b> ${{ $cierre }} pesos mexicanos.
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="mx-auto w-2/3 px-2" style="padding-right: 4rem;  padding-left: 4rem; ">
        <div class="bg-gray-100 flex items-center justify-center bg-gray-100 font-sans rounded-lg">
            <div class="w-full lg:w-5/6 rounded-lg" style="">
                <div class="bg-white shadow-md rounded">
                    <table class="min-w-max w-full table-auto" style="width:100%; ">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th colspan="3" class="py-3 px-6 text-center"
                                    style="background-color: rgba(72, 216, 197, 0.734); border-radius: 2rem; font-size: 20px; padding-top: 1rem; padding-bottom: 1rem;">
                                    Productos vendidos</th>
                            </tr>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
                                style="background-color: rgba(153, 255, 241, 0.734);">
                                <th class="py-3 px-6 text-left" style="padding-top: 1rem; padding-bottom: 1rem;">
                                    Producto</th>
                                <th class="py-3 px-6 text-left" style="padding-top: 1rem; padding-bottom: 1rem;">
                                    Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light" style="text-align: center">
                            @if (count($compras) == 0)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td colspan="3" class="py-3 px-6 text-left whitespace-nowrap"
                                        style="padding-top: 1rem; padding-bottom: 1rem; border-bottom-width: 2px; border-bottom-color: black solid;">
                                        <div class="flex items-center">

                                            <span class="font-medium"> No hay productos vendidos </span>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($compras as $compra)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap"
                                            style="padding-top: 1rem; padding-bottom: 1rem; border-bottom-width: 2px; border-bottom-color: black solid;">
                                            <div class="flex items-center">
                                                <span class="font-medium"> {{ $compra->nombre }}</span>
                                            </div>
                                        </td>

                                        <td class="py-3 px-6 text-left"
                                            style="padding-top: 1rem; padding-bottom: 1rem;">
                                            <span
                                                class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $compra->sumatoria }}
                                                pieza(s)</span>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
