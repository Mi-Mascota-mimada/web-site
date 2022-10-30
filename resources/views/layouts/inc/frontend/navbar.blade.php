
<div class="d-flex flex-row justify-content-between navbar-top">
  <div class="p-2"><i class="fa fa-paw" aria-hidden="true"></i> {{$appSetting->email1 ?? $appSetting->email2}}</div>
  <div class="p-2">{{$appSetting->phone1 ?? $appSetting->phone2}} <i class="fa-solid fa-phone"></i></div>
  <div class="p-2">
    <a href="{{$appSetting->instagram ?? '#' }}" target="_blank" class="mx-2 text-dark-700 dark:text-dark-200 hover:text-dark-600 dark:hover:text-dark-400" aria-label="Instagram">
        <i class="fa-brands fa-instagram"></i>
    </a>
    <a href="{{$appSetting->facebook ?? '#' }}" target="_blank" class="mx-2 text-dark-700 dark:text-dark-200 hover:text-dark-600 dark:hover:text-dark-400" aria-label="Facebook">
        <i class="fa-brands fa-facebook-f"></i>
    </a>
  </div>
</div>
<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <a href="{{ url('/') }}">
                        <img src="{{asset($appSetting->main_logo) ?? asset('assets/img/imagen_no_encontrada.jpg') }}" alt="logo" width="150" height="60" />
                    </a>
                </div>
                <div class="col-md-5 my-auto">
                    <form role="search" action="{{ url('search') }}" method="GET">
                        <div class="input-group">
                            <input type="search" placeholder="Buscar un producto" name="name" class="form-control"/>
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">                            
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-shopping-cart"></i> (<livewire:frontend.cart.cart-count/>)                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right cart-dropdown" aria-labelledby="navbarDropdown2">
                                <ul class="list-group">
                                    <livewire:frontend.cart.cart-drop/>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('wishlist') }}">
                                <i class="fa fa-heart" title="Lista de deseos"></i> (<livewire:frontend.wishlist-count />)
                            </a>
                        </li>
                        
                        @auth                           
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> @if (isset(Auth::user()->name)){{ Auth::user()->name }}@endif
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role_as == '1')
                                <li><a class="dropdown-item" href="{{ url('/admin/dashboard') }}"><i class="fa fa-home"></i> Panel</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{'/profile'}}"><i class="fa fa-user"></i> Perfil</a></li>
                                <li><a class="dropdown-item" href="{{ url('/orders') }}"><i class="fa fa-list"></i> Mis Pedidos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/wishlist') }}"><i class="fa fa-heart"></i> Lista de deseos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Carrito</a></li>
                                <li>
                                    <!-- Authentication -->
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {{ __('Cerrar Sesion') }}
                                    </a>
                                    <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                                </ul>
                            </li>
                            <li class="nav-item" title="Mimado Coins">
                                <a href="{{ url('discount_info')}}">
                                <!-- MIMADO COINS -->                               
                                   <div class="p-2">
                                   <div class="cardcoins-content p-0 flex">
                                       <div class="spinningasset coin2 is-sm">
                                       <div>
                                           <div></div>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <i></i>
                                           <em></em>
                                           <em></em>
                                           <div></div>
                                       </div>
                                       </div>
                                       <div class="ml-2">
                                        {{ Auth::user()->coins }}
                                       </div>
                                   </div>
                                   </div>
                               <!-- MIMADO COINS -->
                                </a>
                           </li>
                        @else
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fa fa-user-plus"></i> Registrate
                                </a>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Acceder
                                </a>
                            </li>
                        @endauth

                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{--Navbar--}}
<div class="inner-width">
    <a class="logo-responsive d-block d-sm-block d-md-none d-lg-none" href="#">
        <img src="{{ asset('assets/img/mi Mascota mimada logo.png') }}" alt="logo" width="150" height="60" />
    </a>
    <i class="menu-toggle-btn fa fa-bars"></i>
    <nav class="navigation-menu">
        <a href="{{ url('/') }}">Inicio</a>
        <li class="nav-item dropdown myli">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categorias
            </a>
            <ul class="dropdown-menu myul">
                @forelse ($categories as $categoryItem)
                    <li><a class="dropdown-item" href="{{ url('/collections/'.$categoryItem->slug) }}"><img src="{{ asset($categoryItem->image) }}" alt="{{ $categoryItem->name }}"   style="border-radius: 50%; width: 50px; height:40px; " class="img-thumbnail d-inline-block"> <b>{{ $categoryItem->name }}</b></a></li>
                @empty
                    <li>No se encontraron categorias</li>
                @endforelse                           
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ url('/collections') }}">Todas</a></li>
            </ul>
        </li>
        <a href="{{url('/new-products')}}">Mas vendidos</a>
        <a href="{{url('/sales')}}">Ofertas</a>
        <a href="{{url('/collections/accesorios')}}">Accesorios</a>
        <a href="{{url('/contact')}}">Contactanos</a>
    </nav>
</div>
{{--/Navbar--}}
   
</div>