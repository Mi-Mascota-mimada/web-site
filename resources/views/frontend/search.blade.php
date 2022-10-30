@extends('layouts.app')

@section('title', 'Resultado de la busqueda')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <b>Resultado de la busqueda</b>
        </div>
        <ul class="list-group list-group-flush">
            @forelse ($products as $product)
                <li class="list-group-item"><a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}"><img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}"   style="width: 100px; height:90px; margin-right:15px;" class="img-thumbnail d-inline-block"> <b>{{ $product->name }}</b></a></li>
            @empty
                <h5 class="text-center">No se encontro ningún producto, Por favor intente de nuevo</h5>
            @endforelse
            
        </ul>
        
    </div>
</div>
@endsection