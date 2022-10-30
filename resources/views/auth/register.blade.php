@extends('layouts.app')

@section('title', 'Registrate')

@section('content')

<section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800 mt-2">
    <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white"><img src="{{ asset("assets/img/mi_Mascota.png") }}" alt="Mi mascota mimada" class="mx-auto img-fluid img-logo" style="margin:-60px;"/></h2>
    <div class="p-4 text-center">
        <a href="{{url('/login-google')}}" class="btn btn-outline-light btn-google"><span class="span-google"></span><b class="text-secondary">Registrarse con Google</b></a>
   </div>
    <!-- Validation Errors -->        
    @if (count($errors) > 0)
        <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-center w-12 bg-red-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
                </svg>
            </div>
            
            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">                        
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />                        
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div>
                <x-label for="email" :value="__('Correo')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
        </div>

        <div class="flex justify-start mt-6">
            <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Registrarse</button>
        </div>
            
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
            </a>
    </form>
</section>
@endsection