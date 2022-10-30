@extends('layouts.app')

@section('title', 'Detalles del pedido')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">
                        <i class="fa fa-shopping-cart text-dark"></i> Detalles del pedido
                        <a href="{{url('orders')}}" class="btn btn-danger btn-sm float-end">Volver</a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Pedido</h5>
                            <hr>
                            <h6><b>Id: </b> {{$order->id}}</h6>
                            <h6><b>Referencia: </b> {{$order->tracking_no}}</h6>
                            <h6><b>Fecha: </b> {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                            <h6><b>Metodo de pago: </b> {{$order->payment_mode}}</h6>
                            <h6 class="border p-2">
                               <b>Estado: </b> <span class="text-danger">{{$order->status_message}}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>Usuario</h5>
                            <hr>
                            <h6><b>Nombre: </b> {{$order->fullname}}</h6>
                            <h6><b>Correo: </b> {{$order->email}}</h6>
                            <h6><b>Telefono: </b> {{$order->phone}}</h6>
                            <h6><b>Direccion: </b> {{$order->address}}</h6>
                            <h6><b>Codigo Zip: </b> {{$order->pincode}}</h6>
                        </div>
                    </div>
                    <br>
                    <h5>Productos</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
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
                                            @if ($orderItem->product->productImages)
                                                <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px; float:left;" alt="{{ $orderItem->product->name }}" />
                                            @else
                                                <img src="{{ asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Imagen no encontrada" class="img-fluid">
                                            @endif                                          
                                            
                                        </td>
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
                                    <td colspan="3" class="fw-bold">Totales</td>
                                    <td class="fw-bold">{{$totalQuantity}}</td>
                                    <td class="fw-bold">{{number_format($totalPrice)}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection