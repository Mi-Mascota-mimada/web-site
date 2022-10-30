<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border gallery">
                        @if (isset($product->productImages[0]))
                            <a href="{{ asset($product->productImages[0]->image) }}"><img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="{{ $product->name }}"></a>
                            @if ($product->productImages->count() > 1)
                            <div class="d-flex flex-row">
                                @foreach ($product->productImages as $key => $imagesItem)                                    
                                        @if ($key > 0)                                        
                                            <a href="{{ asset($imagesItem->image) }}"><img src="{{ asset($imagesItem->image) }}" alt="{{ $product->name }}" class="images-secondary img-thumbnail"></a>
                                        @endif
                                @endforeach
                            </div>
                            @endif                          
                        @else
                            <img src="{{ asset("assets/img/imagen_no_encontrada.jpg") }}" alt="{{ $product->name }}">
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}  
                            @if ($product->quantity > 0)
                                <label class="label-stock btn-sm py-1 mt-2 text-white bg-success">Disponibles ({{ $product->quantity }})</label>
                            @else
                                <label class="label-stock btn-sm py-1 mt-2 text-white bg-danger">Agotado</label>
                            @endif                                                   
                        </h4>
                        <hr>
                        <p class="product-path">
                            <a href="{{ url('/') }}">Inicio</a>/ <a href="{{ url("collections/".$product->category->slug) }}">{{ $product->category->name }}</a> / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price"><i class="fa fa-dollar-sign"></i>{{ number_format($product->selling_price) }}</span>
                            <span class="original-price">
                                @if ($product->original_price > 0)
                                    <i class="fa fa-dollar-sign"></i>
                                    {{ number_format($product->original_price) }}
                                @endif
                            </span>                                                     
                        </div>
                        
                            @if ($product->changeable == 1)
                            <div class="coin">
                                <div class="mimado-coins-div">
                                    <span class="mimado-coins"><i class="fa fa-money-bill-wave"></i> {{round($product->selling_price / 1000)}}<br> Mimado coins</span>   
                                </div>
                            </div>
                            @else
                                <p class="text-danger">Este producto no es canjeable</p>
                            @endif
                        
                        
                        <div>
                            @if ($product->productColors->count() > 0)                            
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)                                    
                                        @if($colorItem->quantity > 0)
                                            <label class="colorSelectionLabel" style="background: {{$colorItem->color->code}}" wire:click="colorSelected({{$colorItem->id}})">
                                                {{$colorItem->color->name}}
                                            </label>
                                        @else
                                            <label class="btn-sm py-1 mt-2 text-white" style="background: {{$colorItem->color->code}}">{{$colorItem->color->name}} Agotado</label>
                                        @endif
                                    @endforeach
                                @endif
                                @if ($this->prodColorSelectedQuantity == "Agotado")
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger">Agotado</label>
                                @elseif($this->prodColorSelectedQuantity > 0)
                                    <label class="btn-sm py-1 mt-2 text-white bg-success">Disponible</label>
                                @endif
                            @endif     
                            
                        </div>
                        <div class="mt-2">
                            @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $product->qualification)
                                            <small><i class="fa fa-star" aria-hidden="true" style="color: gold"></i></small>  
                                        @else
                                            <small><i class="fa-regular fa-star"></i></small>
                                        @endif                                    
                            @endfor   
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="num"  wire:model="quantityCount" value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1" {{$product->quantity > 0 ? '':'disabled'}}>
                                <i class="fa fa-shopping-cart"></i> Añadir al carrito
                            </button>
                            <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1" title="Añadir a la lista de deseos">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i>
                                </span>
                                <span wire:loading wire:target="addToWishList">
                                    Añadiendo...
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">NOTA:</h5>
                            <p class="text-danger">
                                * Por la compra de este producto recibe <b>{{round($product->selling_price / 15000, 2)}} <u>Mimado coins</u></b>
                            </p>
                            @if ($product->quantity < 1)
                                <p class="text-danger">* Este producto esta actualmente Agotado puedes comunicarte con nosotros para reservarlo o para saber cuando estara disponible, gracias</p>
                            @endif
                            
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Descripcion corta</h5>
                            <p>
                                {{ $product->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Descripcion</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $product->description }}                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user())
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4>Califica este producto</h4>
                            </div>
                            <div class="card-body mx-auto text-center">
                                <form id="form-rate" wire:submit.prevent="rateProduct({{$product->id}})">
                                    <p class="clasificacion">
                                        <input id="radio1" type="radio" wire:model.defer="myRate" value="5"><!--
                                        --><label class="label-rate" for="radio1"><i class="fa-regular fa-star"></i></label><!--
                                        --><input id="radio2" type="radio" wire:model.defer="myRate" value="4"><!--
                                        --><label class="label-rate" for="radio2"><i class="fa-regular fa-star"></i></label><!--
                                        --><input id="radio3" type="radio" wire:model.defer="myRate" value="3"><!--
                                        --><label class="label-rate" for="radio3"><i class="fa-regular fa-star"></i></label><!--
                                        --><input id="radio4" type="radio" wire:model.defer="myRate" value="2"><!--
                                        --><label class="label-rate" for="radio4"><i class="fa-regular fa-star"></i></label><!--
                                        --><input id="radio5" type="radio" wire:model.defer="myRate" value="1"><!--
                                        --><label class="label-rate" for="radio5"><i class="fa-regular fa-star"></i></label>
                                    </p>          
                                    <button class="px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80" style="background: #52938F;">
                                        Calificar
                                    </button>                          
                                </form>
                            </div>
                        </div>
                    </div>                
                </div>
            @endif
            <div class="row">       
                <div class="col-md-12 mt-3">
                    <div class="card">         
                        @include('livewire.frontend.product.relationsProducts')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
