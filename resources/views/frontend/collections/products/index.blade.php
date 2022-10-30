@extends('layouts.app')

@section('title')
{{ $category->meta_title }}
@endsection

@section('meta_keyword')
{{ $category->meta_keyword }}
@endsection

@section('meta_description')
{{ $category->meta_description }}
@endsection

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 marco">
                <div class="marco-text">
                    <h3>{{$category->name}}</h3>
                </div>
                <div class="marco-image">
                    <img src="{{asset($category->image)}}" width="250" height="250" alt="{{$category->name}}" class="img-banner-category">
                </div>
            </div>
        </div>
        <div class="row py-6">           
            <livewire:frontend.product.index :category="$category" />          
        </div>
    </div>
</div>

@endsection