@extends('layouts.app')

@section('title', 'Iniciar sesion')

@section('content')

<div class="flex max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl m-3 p-4">
    <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image:url('{{asset("assets/img/portada.png")}}')"></div>
    
    <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
        <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white"><img src="{{ asset("assets/img/mi_Mascota.png") }}" alt="Mi mascota mimada" class="mx-auto img-fluid img-logo" style="margin:-80px;"/></h2>
       <div class="p-4 text-center">
            <a href="{{url('/login-google')}}" class="btn btn-outline-light btn-google"><span class="span-google"></span><b class="text-secondary">Iniciar sesion con Google</b></a>
       </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

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
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Correo')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <!-- Password -->
            <div class="mt-4">                
                <x-label for="password" :value="__('Contraseña')" />
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-dark-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-dark-600 text-dark">{{ __('Recordarme') }}</span>
                </label>
            </div>            
            <div class="mt-8">
                <x-button class="px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                    {{ __('Iniciar sesion') }}
                </x-button>
            </div>
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('¿Olvido la contraseña?') }}
                    </a>
                @endif                
            </div>
        </form>
        <div class="flex items-center justify-between mt-4">
            <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>

            <a href="{{ route('register') }}" class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline">Registrate</a>
            
            <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
        </div>
    </div>
</div>
@endsection

