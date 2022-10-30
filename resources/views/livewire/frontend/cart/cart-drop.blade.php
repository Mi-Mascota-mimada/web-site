<div>
    @php
        $total = 0;
    @endphp
@forelse ($cart as $cartItem)
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-3">
                @if (Auth::check())
                    @if ($cartItem->product->productImages[0]->image)                    
                            <img src="{{ asset($cartItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px;" alt="{{ $cartItem->name }}" />
                    @else
                        <img src="{{ asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Imagen no encontrada" class="img-fluid">
                    @endif  
                @else
                    @if ($cartItem->attributes->image)                    
                            <img src="{{ asset($cartItem->attributes->image) }}" style="width: 50px; height: 50px;" alt="{{ $cartItem->name }}" />
                    @else
                        <img src="{{ asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Imagen no encontrada" class="img-fluid">
                    @endif  
                @endif
                
            </div>
            <div class="col-lg-6">
                @if (Auth::check())
                   <b>{{$cartItem->product->name}}</b>
                @else
                    <b>{{$cartItem->name}}</b>
                @endif                
                <br><small>Cantidad: {{$cartItem->quantity}}</small>
            </div>
            <div class="col-lg-3">
                @if (Auth::check())
                    <p>${{ number_format($cartItem->product->selling_price * $cartItem->quantity) }}</p>
                    @php
                        $total += $cartItem->product->selling_price * $cartItem->quantity;
                    @endphp
                @else                    
                    <p>${{ number_format(\Cart::get($cartItem->id)->getPriceSum()) }}</p>
                @endif
            </div>
        </div>
    </li>
@empty
    <li class="list-group-item">Tu Carrito esta vacío</li>
@endforelse
@if (\Cart::getTotal())
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total: </b>${{number_format(\Cart::getTotal())}}
            </div>
        </div>
    </li> 
@else
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total: </b>${{number_format($total)}}
            </div>
        </div>
    </li> 
@endif
<li class="list-group-item">
    <div class="row">
        <a class="btn btn-dark btn-sm" href="{{ url('cart') }}">VER CARRITO <i class="fa fa-arrow-right"></i></a>
    </div>
    <div class="row">
        <a class="btn btn-secondary btn-sm" href="{{ url('checkout') }}">PAGAR<i class="fa fa-arrow-right"></i></a>
    </div>
</li>
</div>