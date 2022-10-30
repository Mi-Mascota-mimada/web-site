@extends('layouts.app')

@section('title', 'Información de descuentos')

@section('content')
    
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-6 bg-white">
                        <div class="card-header bg-white">
                            <img src="{{ asset("assets/img/descuento cliente mimado.jpg") }}" alt="Descuento" />
                        </div>
                        <div class="card-body">
                            <h4>CONVIERTETE EN UN CLIENTE MIMADO</h4>
                            
                            
                                @if (!isset(Auth::user()->name))
                                <p>Para obtener beneficios y descuentos con nosotros debes estar registrado en nuestro sitio web.</p>
                                <a href="{{url('/register')}}">Registrate Aqui</a>
                                @else
                                <p>Hola <b>{{auth()->user()->name}}</b> disfruta los beneficios de ser un <b><u>CLIENTE MIMADO</u></b></p>
                                    <p>Tienes un total de <b><u>{{$shopping}}</b></u> compras con nosotros.</p>
                                <ul class="list-disc    ">
                                    <h5><b>MIMADO COINS</b></h5>
                                    <li>Es nuestra moneda exclusiva para poder ofrecerte beneficios de cliente VIP:</li>
                                    <li>Por cada $15.000 en compras acumula 1 <b><u>mimado coin</b></u></li>
                                    <li>Por cada donacion mayor a $30.000 a la fundación Lazo Animal obten 1 mimado coin</li>
                                    <li>Ejemplo: $150.000 en compras son 10 mimado coins</li>
                                </ul>
                                <ol class="list-decimal">                                    
                                    <h5><b>BENEFICIOS:</b></h5>
                                    <li>En tu 5ª compra obten un descuento del 15% del total de tu compra</li>
                                    <li>En tu 10ª compra obten un descuento del 20% del total de tu compra</li>
                                    <li>En tu 20ª compra obten un descuento del 30% del total de tu compra</li>
                                    <li>En tu 40ª compra obten un descuento del 50% del total de tu compra</li>
                                </ol>
                                
                                <ol class="list-decimal">
                                    <h5><b>Canjeo de puntos:</b></h5>
                                    <li>Puedes pagar hasta el 100% del producto con tus mimado coins</li>
                                    <li>50 mimado coins: 1 <a href="{{url('/collections/accesorios/placas-con-nombre')}}" target="_blank">Placa con nombre</a></li>
                                    <li>70 mimado coins: 1 <a href="{{url('http://127.0.0.1:8000/collections/accesorios/collar-reflectante')}}" target="_blank">Collar reflectante</a></li>
                                    <li>600 mimado coins: 1 <a href="{{url('http://127.0.0.1:8000/collections/accesorios/mochila')}}" target="_blank">Mochila</a></li>
                                </ol>
                                <ol class="list-decimal">
                                    <h5><b class="text-danger">Notas aclaratorias: </b></h5>
                                    <li>El canjeo de mimado coins no aplica domicilio gratis.</li>
                                    <li>Si efectua el canjeo de mimado coins se enviara el producto en su proxima compra.</li>
                                    <li>Si desea tener su producto canjeado el mismo día debe pagar el valor del domicilio (comuniquese con nosotros    )</li>
                                </ol>
                                @endif
                                
                              
                        </div>
                    </div>                 
                </div>
            </div>
        </div>
    </div>

@endsection