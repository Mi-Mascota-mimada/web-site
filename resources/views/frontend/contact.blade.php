@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
@if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
    <div class="hidden bg-cover lg:block lg:w-1/2">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2242093566256!2d-75.56454038585085!3d6.234148328190459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428458c73eb09%3A0x7b0af6199100769c!2sCra.%2034f%20%2335-11%2C%20Medell%C3%ADn%2C%20Buenos%20Aires%2C%20Medell%C3%ADn%2C%20Antioquia!5e0!3m2!1ses!2sco!4v1661612242102!5m2!1ses!2sco" width="460" height="630" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
        <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">
            <img src="{{ asset("assets/img/mi_Mascota.png") }}" alt="Mi mascota mimada" class="mx-auto img-fluid img-logo" style="margin:-80px;"/>
        </h2>

        <p class="text-xl text-center text-dark-600 dark:text-dark-200">
            ¡Dejanos un mensaje!
        </p>

        

        <div class="flex items-center justify-between mt-4">
            <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/4"></span>

            <p>Te responderemos.</p>

            <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/4"></span>
        </div>
        <form action="{{url('/contact')}}" method="POST">
            @csrf
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-dark-600 dark:text-dark-200" for="Name">Tu nombre</label>
                <input name="name" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-dark-800 dark:text-dark-300 dark:border-dark-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300" type="text" @if (Auth::user())value="{{Auth::user()->name}}"@endif/>
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-dark-600 dark:text-dark-200" for="EmailAddress">Correo electronico</label>
                <input name="email" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-dark-800 dark:text-dark-300 dark:border-dark-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300" type="email" @if (Auth::user())value="{{Auth::user()->email}}"@endif/>
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-dark-600 dark:text-dark-200" for="cel">Celular</label>
                <input name="cel" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-dark-800 dark:text-dark-300 dark:border-dark-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300" type="text" />
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-dark-600 dark:text-dark-200" for="message">Mensaje</label>
                <textarea name="message" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-dark-800 dark:text-dark-300 dark:border-dark-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"></textarea>
            </div>
            <div class="mt-8">
                <button class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600" type="submit">
                    Enviar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection