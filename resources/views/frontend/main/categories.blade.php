<section class="dark:bg-gray-900 section-product">
    <div class="container px-6 py-8 mx-auto">
        <div class="container-title-products">
            <h3 class="mt-2 text-lg font-medium text-dark-700 dark:text-dark-200 text-center title-main-products"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Categorias destacadas</h3>
        </div>
        <div class="lg:flex lg:-mx-2">
            <div class="mt-6 lg:mt-0 lg:px-2 lg:w-5/5 ">
                <div class="grid grid-cols-2 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                    @forelse ($categories as $key => $categoryItem)
                        @if ($key > 3)
                            @break  
                        @endif
                        <div class="max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                            <a href="{{ url('/collections/'.$categoryItem->slug) }}"><img class="object-cover w-full h-56 images-categories" src="{{ asset($categoryItem->image) }}" alt="{{ $categoryItem->name }}"></a>
                            
                            <div class="py-5 text-center">
                                <a href="{{ url('/collections/'.$categoryItem->slug) }}" class="block text-2xl font-bold text-dark-800 dark:text-dark">{{ $categoryItem->name }}</a>
                                <span class="text-sm text-dark-700 dark:text-dark-200 text-justify px-2">{{ $categoryItem->description }}</span>
                            </div>
                        </div>                       
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>