@extends('layouts.app')

@section('title', 'Tienda de mascotas Medellín')

@section('content')
{{--  Slider --}}
<div>
    @include('frontend.main.sliders')
</div>
{{--  /Slider --}}
{{-- Brands --}}
<div class="brands">
    @include('frontend.main.brands')
</div>
{{-- /Brands --}}
{{--Main title--}}
<div class="p-4 container-title">
    <h1 class="main-title">Tienda de mascotas</h1>
    <span class="main-subtitle">en Medellín</span>
    
</div>
<div class="container main-container">
    <p class="text-center">
        Somos una tienda de mascotas ubicada en Medellín.<br>
        Manejamos todo lo relacionado a tu peludo, Juguetes, Alimetanción, Accesorios, Productos de higiene,
        Productos de belleza, consejos, curiosidades y mucho mas...<br>
        Encontraras todo lo que buscas para tu cachorro.<br>
        Realizamos domicilio gratis a Medellín, Itagüí, Bello, Sabaneta, Envigado y mas... <br>
        ¡Llama Ya!
    </p>
</div>
{{--Main title--}}
{{--Main products--}}
<div class="main-products">
    @include('frontend.main.products')
</div>
{{--/Main products--}}
{{--Main Categories --}}
<div class="main-categories">
    @include('frontend.main.categories')
</div>
{{--/Main Categories --}}
{{--Main accesories --}}
<div class="main-info">
    @include('frontend.main.accesories')
</div>
{{--/Main accesories --}}
{{-- Main Newsletter --}}
<div class="main-newsletter">
    @include('frontend.main.newsletter')
</div>
{{-- /Main Newsletter --}}

{{--Main info --}}
<div class="main-info">
    @include('frontend.main.info')
</div>
{{--/Main info --}}
{{-- Sale Modal --}}
<div class="modal-sale-main">
    @include('frontend.main.modal-sale')
</div>

@endsection
