<div class="card-header bg-white">
    <h4>Productos relacionados</h4>
</div>
<div class="card-body mx-auto text-center">
    <section class="dark:bg-gray-900 section-product">
        <div class="container px-6 py-8 mx-auto">            
            <div class="lg:flex lg:-mx-2">
                <div class="mt-6 lg:mt-0 lg:px-2 lg:w-5/5 ">
                    <div class="grid grid-cols-2 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                        @forelse ($relationsProducts as $productItem)
                            <div>
                                <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto shadow-lg">
                                    @if ($productItem->quantity > 0)
                                        <label class="stock bg-success">Disponibles({{ $productItem->quantity }})</label>
                                    @else
                                        <label class="stock bg-danger">Agotado</label>
                                    @endif
                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}"><img class="object-cover w-full rounded-md h-72 xl:h-80" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}"/></a>
                                    <h4 class="mt-2 text-lg font-medium text-dark-700 dark:text-dark-200"><a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                        {{ $productItem->name }}
                                    </a></h4>
                                    <p class="text-dark-500">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $productItem->qualification)
                                            <small><i class="fa fa-star" aria-hidden="true" style="color: gold"></i></small>  
                                        @else
                                            <small><i class="fa-regular fa-star"></i></small>
                                        @endif                                    
                                    @endfor  
                                    </p>
                                    <p class="text-dark-500">${{ number_format(intval($productItem->selling_price)) }}</p>                            
                                </div>
                            </div>
                            
                        @empty
                            <p>No se encontraron productos</p>
                        @endforelse      
                                      
                    </div>
                </div>            
            </div>
        </div>
    </section>
</div>