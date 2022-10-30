<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Factura N° {{$order->id}}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Mi mascota mimada</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Venta N°: {{$order->id}}</span> <br>
                    <span>Fecha: {{$order->created_at->format('d-m-Y h:i A')}}</span> <br>
                    <span>Pin Code : {{$order->pincode}}</span> <br>
                    <span>Direccion: {{$order->address}}</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Detalles del pedido</th>
                <th width="50%" colspan="2">Cliente</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pedido:</td>
                <td>{{$order->id}}</td>

                <td>Nombre:</td>
                <td>{{$order->fullname}}</td>
            </tr>
            <tr>
                <td>Referencia:</td>
                <td>{{$order->tracking_no}}</td>

                <td>Correo:</td>
                <td>{{$order->email}}</td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td>{{$order->created_at->format('d-m-Y h:i A')}}</td>

                <td>Telefono:</td>
                <td>{{$order->phone}}</td>
            </tr>
            <tr>
                <td>Metodo de pago:</td>
                <td>{{$order->payment_mode}}</td>

                <td>Direccion:</td>
                <td>{{$order->address}}</td>
            </tr>
            <tr>
                <td>Estado de la compra:</td>
                <td>{{$order->status_message}}</td>

                <td>Pin code:</td>
                <td>{{$order->pincode}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Productos
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
                $totalQuantity = 0;
            @endphp
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td>
                        {{ $orderItem->product->name }}
                        @if ($orderItem->productColor)                                
                            <br>
                            @if ($orderItem->productColor->color)                     
                                <span>Color: {{ $orderItem->productColor->color->name }}</span>
                            @endif
                        @endif
                    </td>
                    <td>${{ number_format($orderItem->price) }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td class="fw-bold">${{ number_format($orderItem->quantity * $orderItem->price) }}</td>
                </tr>
                @php
                    $totalPrice += $orderItem->quantity * $orderItem->price;
                    $totalQuantity += $orderItem->quantity;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><b>Totales</b></td>
                <td><b>{{$totalQuantity}}</b></td>
                <td><b>{{number_format($totalPrice)}}</b></td>
            </tr>
            @if ($user && $user != 0)
                <tr>
                    <td colspan="3"><b>Mimado Coins ganados:</b></td>
                    <td><b>{{number_format(floatval($totalPrice)/15000, 2)}}</b></td>
                </tr>
            @endif
        </tfoot>
    </table>

    <br>
    <p class="text-center">
        ¡¡¡Gracias por comprar con nosotros!!!
    </p>
    <small>
       <b> Nota</b>: Por favor conserve esta factura para futuros reclamos e inconvenientes.
    </small>

</body>
</html>