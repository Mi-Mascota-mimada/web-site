<footer class="bg-gray dark:bg-gray-800">
    <div class="container px-6 py-4 mx-auto footer-container">
        <div class="lg:flex">
            <div class="w-full -mx-6 lg:w-2/5">
                <div class="px-6">
                    <div>
                        <a href="#" class="text-xl font-bold text-gray-800 dark:text-white hover:text-gray-700 dark:hover:text-gray-300"><img src="{{asset($appSetting->logo) ?? asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Mi mascota mimada" class="img-fluid img-logo" /></a>
                    </div>
                    
                    <p class="max-w-md mt-2 text-gray-500 dark:text-gray-400">{{$appSetting->page_title ?? 'Tienda' }}</p>
                    
                    <div class="flex mt-4 -mx-2">
                        <a href="{{$appSetting->instagram ?? '#' }}" target="_blank" class="mx-2 text-gray-700 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="{{$appSetting->facebook ?? '#' }}" target="_blank" class="mx-2 text-gray-700 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6 lg:mt-0 lg:flex-1">
                <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
                    <div>
                        <h3 class="text-gray-700 uppercase dark:text-white">Nosotros</h3>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Comunidad</a>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Tienda</a>
                    </div>

                    <div>
                        <h3 class="text-gray-700 uppercase dark:text-white">Blog</h3>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Curiosidades</a>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Consejos</a>
                    </div>

                    <div>
                        <h3 class="text-gray-700 uppercase dark:text-white">Servicios</h3>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Entrega a domicilio</a>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Domicilio el mismo día</a>
                        <a href="#" class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">Cuidado a tu mascota</a>
                    </div>

                    <div>
                        <h3 class="text-gray-700 uppercase dark:text-white">Contacto</h3>
                        <span class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">{{$appSetting->phone1 ?? $appSetting->phone2 }}</span>
                        <span class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">{{$appSetting->email1 ?? $appSetting->email2 }}</span>
                        <span class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">{{$appSetting->address ?? 'Addres' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="h-px my-6 bg-gray-300 border-none dark:bg-gray-700">

        <div>
            <p class="text-center text-gray-800 dark:text-white">© Mi Mascota Mimada 2022 - All rights reserved</p>
        </div>
    </div>
</footer>