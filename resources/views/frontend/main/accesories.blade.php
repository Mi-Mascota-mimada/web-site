<div class="container-title-products mb-4 container">
    <h3 class="mt-2 text-lg font-medium text-dark-700 dark:text-dark-200 text-center title-main-products"><i class="fa-solid fa-cat"></i> Accesorios y juguetes<i class="fa-solid fa-dog"></i></h3>
</div>
<div class="container">
<ul id="autoWidth" class="cs-hidden">
    
        <!-- Box slider-->
    
            @forelse ($accesoriesToys as $key => $accesory)
            <li class="item-{{$key}}">
                <div>
                    <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto shadow-lg">
                        <a href="{{ url('/collections/'.$accesory->category->slug.'/'.$accesory->slug) }}"><img class="object-cover w-full rounded-md h-72 xl:h-80" src="{{ asset($accesory->productImages[0]->image) }}" alt="{{ $accesory->name }}"/></a>
                        <h4 class="mt-2 text-lg font-medium text-dark-700 dark:text-dark-200"><a href="{{ url('/collections/'.$accesory->category->slug.'/'.$accesory->slug) }}">
                            {{ $accesory->name }}
                        </a></h4>
                        <p class="text-dark-500">
                        @for ($i = 1; $i < 6; $i++)
                            @if ($i <= $accesory->qualification)
                                <small><i class="fa fa-star" aria-hidden="true" style="color: gold"></i></small>  
                            @else
                                <small><i class="fa-regular fa-star"></i></small>
                            @endif                                    
                        @endfor  
                        </p>
                        <p class="text-dark-500">${{ number_format(intval($accesory->selling_price)) }}</p>                            
                    </div>
                </div>
            </li>
            @empty
                <p>No hay imagenes</p>
            @endforelse
    
</ul>    
</div>

