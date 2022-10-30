<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row mt-1 p-0">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}">
            <img src="{{asset($appSetting->logo) ?? asset('assets/img/imagen_no_encontrada.jpg') }}" alt="logo" style="width:100px; height:100px;"/>
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}">
            
            <img src="{{ asset('assets/img/mi_Mascota.png') }}" alt="logo" style=""/>
          </a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input list="datalist-search" id="search-component" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search" autocomplete="off">
              <datalist id="datalist-search">
                <option>Dashboard</option>
                <option>Messages</option>
                <option>Category</option>
                <option>Products</option>
                <option>Sales</option>
                <option>Brands</option>
                <option>Colors</option>
                <option>Users</option>
                <option>Home slider</option>
                <option>Settings</option>              
              </datalist>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>              
              @if (count($messages) > 0)
                <span class="count"></span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages <a href="{{url('/admin/messages')}}"><i class="mdi mdi-open-in-new"></i></a></p>    
                @php
                    $i = 0;
                @endphp          
                  @forelse ($messages as $key => $message)     
                  @php
                      $i++
                  @endphp
                  <a class="dropdown-item drop-msg" href="{{url('/admin/messages?email='.$key)}}" title="{{$message[0]->message}}">                  
                    <div class="item-thumbnail">
                      <img class="profile-pic" src="{{asset('assets/img/imagen_no_encontrada.jpg')}}" alt="message">
                    </div>
                    <div class="item-content flex-grow">
                      <small class="float-end date-msg">{{$message[0]->created_at->format('F jS h:i A')}}</small>
                      <h6 class="ellipsis font-weight-normal">{{$message[0]->name}}</h6>
                      <p class="font-weight-light small-text text-muted mb-0">                      
                        {{ strlen($message[0]->message)  > 35 ? substr($message[0]->message,0, 34)."..." : $message[0]->message}}
                      </p>    
                                                              
                    </div>
                  </a>  
                  @php
                  if($i == 5)
                      break;
                  @endphp
                  @empty
                      <p>There's not messages</p>
                  @endforelse 
                <div class="text-center"><a href="{{url('/admin/messages')}}"> See all <i class="mdi mdi-open-in-new"></i></a></div>        
              
            </div>
          </li>
          <li class="nav-item dropdown me-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="" data-bs-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              @if (count($notifications) > 0)
                <span class="count"></span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              @forelse ($notifications as $notification)
                <a class="dropdown-item" href="{{url('/admin/orders/'.$notification->id)}}">
                  <div class="item-thumbnail">
                    <div class="item-icon bg-success">
                      <i class="mdi mdi-information mx-0"></i>
                    </div>
                  </div>
                  <div class="item-content">
                    <h6 class="font-weight-normal">You have a new order</h6>                  
                    <p class="font-weight-light small-text mb-0 text-muted">
                      {{$notification->created_at}}
                    </p>
                  </div>
                </a>
              @empty
                <h6 class="ellipsis font-weight-normal">There aren't Orders</h6>
              @endforelse
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{ Storage::url(Auth::user()->picture) }}" alt="profile"  class="profile-picture img-thumbnail"/>
              <span class="nav-profile-name">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="{{ url('/admin/settings')}}" class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout text-primary"></i> {{ __('Log Out') }}
              </a>
              <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>