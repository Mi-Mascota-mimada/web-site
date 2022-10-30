<div>
    <!-- Modal -->
    @include('livewire.frontend.profile.modal-form')
    <!-- Modal -->
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Foto de perfil</h5>
                    </div>
                    <div class="card-body mx-auto">
                        @if ($user['picture'] != "")
                            <img src="{{ Storage::url($user['picture']) }}" alt="{{$user['name']}}"  class="profile-picture img-thumbnail"/>
                        @else
                            <img class="profile-picture img-thumbnail" src="{{asset('assets/img/imagen_no_encontrada.jpg')}}" alt="{{$user['name']}}">
                        @endif                        
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Información personal</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6><b>Nombre: </b>{{$user['name']}}</h6>
                        </div>
                        <div class="mb-4">
                            <h6><b>Correo: </b>{{$user['email']}}</h6>
                        </div>
                        <div class="mb-4">
                            <h6><b>Mimado Coins: </b><span class="text-danger">{{$user['coins']}}</span></h6>
                        </div>
                        <div>
                            <a href="#" wire:click="editProfile({{ $user['id'] }})" data-bs-toggle="modal" data-bs-target="#updateProfile" class="btn btn-sm btn-primary">Editar Información</a>
                            <a href="{{url('change-password')}}" class="btn btn-sm btn-danger">Cambiar contraseña</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
           <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Productos que puedes Canjear</h5>
                    </div>
                    <div class="card-body mx-auto text-center">
                        <section class="dark:bg-gray-900 section-product">
                            <div class="container px-6 py-8 mx-auto">            
                                <div class="lg:flex lg:-mx-2">
                                    <div class="mt-6 lg:mt-0 lg:px-2 lg:w-5/5 ">
                                        <div class="grid grid-cols-2 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                                            @forelse ($mimadoProducts as $productItem)
                                                <div>
                                                    <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto shadow-lg">
                                                        @if ($productItem->quantity > 0)
                                                            <label class="stock bg-success">Disponibles({{ $productItem->quantity }})</label>
                                                        @else
                                                            <label class="stock bg-danger">Agotado</label>
                                                        @endif
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
                                                        <p class="text-dark-500">${{ number_format(intval($productItem->selling_price)) }}</p>                            
                                                    </div>
                                                </div>
                                                
                                            @empty
                                                <div>
                                                    <h5>Aun no tienes 100 mimado coins.</h5>
                                                    <h5>No puedes canjear productos</h5>
                                                </div>
                                            @endforelse      
                                                          
                                        </div>
                                    </div>            
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
