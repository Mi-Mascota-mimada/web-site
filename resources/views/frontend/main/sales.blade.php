@extends('layouts.app')

@section('title', 'Ofertas')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 marco text-center">            
            <div class="marco-text" style="width:100%;">
                <h3>Ofertas</h3>
            </div>            
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="dark:bg-gray-900 section-product">
                <div class="container px-6 py-8 mx-auto">            
                    <div class="lg:flex lg:-mx-2">
                        <div class="mt-6 lg:mt-0 lg:px-2 lg:w-5/5 ">
                            <div class="grid grid-cols-2 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                                @forelse ($salesProducts as $productItem)
                                @php
                                    if($productItem->original_price > 0){
                                        $discount = $productItem->original_price - $productItem->selling_price;
                                        $discount = ($discount / $productItem->original_price) * 100;
                                    }
                                @endphp
                                    <div>
                                        <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto shadow-lg">
                                            <label class="stock bg-danger">-{{round($discount)}}%</label>
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
                                            <p class="text-dark-500">${{ number_format(intval($productItem->selling_price)) }} <del>${{ number_format(intval($productItem->original_price)) }}</del></p>                                             
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
    </div>
</div>
@endsection