<div class="container mt-4 brand-main ">
    <div class="row">
        <div class="max-w-screen-xl mx-auto mt-20">
            <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-4">
                @forelse ($brands as $brandItem)
                <div class="flex items-center justify-center col-span-1 md:col-span-2 lg:col-span-1">            
                    <a href="{{url("/collections/{$brandItem->category->slug}?brand[0]={$brandItem->id}")}}"><img src="{{ Storage::url("$brandItem->image") }}" alt="{{ $brandItem->name }}" class="img-fluid brand-img" /></a>
                </div>
                @empty
                <div class="flex items-center justify-center col-span-1 md:col-span-2 lg:col-span-1">  
                    <h5>No hay marcas por mostrar</h5>                       
                </div>
                @endforelse
            </div>
        </div>        
        
    </div>
</div>
