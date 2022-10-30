<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h4>Carrito</h4>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Productos</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Canjeable</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Precio</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Cantidad</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2 text-end">
                                    <h4>Eliminar</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-5 my-auto">
                                            <a href="{{ url('/collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug) }}">
                                                <label class="product-name d-inline">
                                                    @if ($cartItem->product->productImages)
                                                        <img src="{{ asset($cartItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px; float:left;" alt="{{ $cartItem->product->name }}" />
                                                    @else
                                                        <img src="{{ asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Imagen no encontrada" class="img-fluid">
                                                    @endif                                                    
                                                    {{ $cartItem->product->name }}
                                                    @if ($cartItem->productColor)                                
                                                        <br>
                                                        @if ($cartItem->productColor->color)                     
                                                            <span>Color: {{ $cartItem->productColor->color->name }}</span>
                                                        @endif
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto text-center">
                                            <label class="price">{{$cartItem->product->changeable == '1' ? 'SI':'NO'}} </label>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{number_format($cartItem->product->selling_price)}} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled" wire:click="changeQuantity({{$cartItem->id}}, 'decrement', {{ $cartItem->quantity }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{ $cartItem->quantity }}" class="input-quantity" readonly/>
                                                    <button type="button" wire:loading.attr="disabled"  wire:click="changeQuantity({{$cartItem->id}}, 'increment', {{ $cartItem->quantity }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{number_format($cartItem->product->selling_price * $cartItem->quantity ) }} </label>
                                            @php $totalPrice += $cartItem->product->selling_price * $cartItem->quantity @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto text-end">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{ $cartItem->id }})" href="" class="btn btn-outline-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </span>
                                                    <span wire:loading wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa-solid fa-trash-can"></i> Eliminando
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-5 my-auto">
                                            <a href="{{ url('/collections/'.$cartItem->attributes->productCategory.'/'.$cartItem->attributes->slug) }}">
                                                <label class="product-name d-inline">
                                                    @if ($cartItem->attributes->image)
                                                        <img src="{{ asset($cartItem->attributes->image) }}" style="width: 50px; height: 50px; float:left;" alt="{{ $cartItem->name }}" />
                                                    @else
                                                        <img src="{{ asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Imagen no encontrada" class="img-fluid">
                                                    @endif                                                    
                                                    {{ $cartItem->name }}
                                                    @if ($cartItem->attributes->productColor)                              
                                                        <br>                    
                                                            <span>Color: {{ $cartItem->attributes->productColor }}</span>
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto text-center">
                                            <label class="price">{{$cartItem->changeable == '1' ? 'SI':'NO' }}</label>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{number_format($cartItem->price)}} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled" wire:click="changeQuantity({{$cartItem->id}}, 'decrement', {{ $cartItem->quantity }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{ $cartItem->quantity }}" class="input-quantity" readonly/>
                                                    <button type="button" wire:loading.attr="disabled"  wire:click="changeQuantity({{$cartItem->id}}, 'increment', {{ $cartItem->quantity }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{number_format(\Cart::get($cartItem->id)->getPriceSum() ) }} </label>
                                            @php $totalPrice += $cartItem->price * $cartItem->quantity @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto text-end">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{ $cartItem->id }})" href="" class="btn btn-outline-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </span>
                                                    <span wire:loading wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa-solid fa-trash-can"></i> Eliminando
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        @empty
                            <div>El carrito esta vacio</div>
                        @endforelse
                        
                                
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h5>
                        Obten los mejores descuentos y ofertas. <a href="{{ url('/collections') }}">¡Compra Ya!</a>
                    </h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total:
                            <span class="float-end">${{ number_format($totalPrice) }}</span>
                        </h4>
                        <hr>
                        @if ($totalPrice > 0)
                            <a href="{{ url('/checkout') }}" class="btn btn-primary w-100">Pagar</a>
                        @else
                            <button class="btn btn-primary w-100" style="cursor: no-drop;" title="Por favor agregue productos al carrito">Pagar</button>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
