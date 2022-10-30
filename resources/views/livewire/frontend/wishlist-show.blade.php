<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        <h5>Lista de deseos</h5>
                        <hr>
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Producto</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Precio</h4>
                                </div>
                                <div class="col-md-4 text-end">
                                    <h4>Eliminar</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($wishlist as $wishlistItem)
                            @if ($wishlistItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('/collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug) }}">
                                                <label class="product-name">
                                                    <img src="{{ asset($wishlistItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px; float:left;" alt="{{ $wishlistItem->product->name }}">
                                                    {{ $wishlistItem->product->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ number_format($wishlistItem->product->selling_price) }} </label>
                                        </div>
                                        
                                        <div class="col-md-4 col-12 my-auto text-end">
                                            <div class="remove">
                                                <button type="button" wire:click="removeWishlistItem({{ $wishlistItem->id }})" class="btn btn-outline-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </span>
                                                    <span wire:loading wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                        Eliminando...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('/collections/'.$wishlistItem->attributes->category_slug.'/'.$wishlistItem->attributes->slug) }}">
                                                <label class="product-name">
                                                    <img src="{{ asset($wishlistItem->attributes->image) }}" style="width: 50px; height: 50px; float:left;" alt="{{ $wishlistItem->name }}">
                                                    {{ $wishlistItem->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ number_format($wishlistItem->price) }} </label>
                                        </div>
                                        
                                        <div class="col-md-4 col-12 my-auto text-end">
                                            <div class="remove">
                                                <button type="button" wire:click="removeWishlistItem({{ $wishlistItem->id }})" class="btn btn-outline-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </span>
                                                    <span wire:loading wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                        Eliminando...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h4>No has añadido productos a la lista de deseos</h4>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
