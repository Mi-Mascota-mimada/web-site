<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Formulario de pago</h4>
            <hr>
            @if ($this->totalProductAmount > 0)
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Total a Pagar :
                                <span class="float-end">${{number_format($this->totalProductAmount)}}</span>
                            </h4>
                            <hr>
                            <small class="text-danger">* Los productos seran entregados a partir de 3 horas despues del pago.</small>
                            <br/>
                            <small class="text-danger">* Si desea hacer algun cambio por favor comuniquese con nosotros</small>
                            <br/>
                            <small class="text-danger">* Los precios estan sujetos a iva e impuestos</small>
                            <br/>
                            <small class="text-danger">* El canjeo de <b><u>Mimado coins</u></b> se efectuara automaticamente cuando el pago sea completado</small>
                            <br>
                            <small class="text-danger">* El domicilio gratis es apartir de compras mayores a $100.000</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Información de entrega
                            </h4>
                            <hr>

                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nombre completo</label>
                                    <input type="text" wire:model.defer="fullname" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                    @error('fullname')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Celular</label>
                                    <input type="text" wire:model.defer="phone" id="phone" class="form-control" placeholder="Telefono" />
                                    @error('phone')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Correo</label>
                                    <input type="email" wire:model.defer="email" id="email" class="form-control" placeholder="Correo electronico" />
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Cupon de descuento</label>
                                    <small><a href="/discount_info" target="_blank">¿Como conseguir mi descuento?</a></small>
                                    <input type="number" wire:model.defer="pincode" id="pincode" class="form-control" />
                                    @error('pincode')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Direccion de entrega</label>
                                    <textarea wire:model.defer="address" id="address" class="form-control" rows="2"></textarea>
                                    @error('address')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>Seleeccione un medio de pago: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr='disabled'  class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Pago contraentrega</button>
                                            <button wire:loading.attr='disabled' class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false"><i class="fa-brands fa-paypal"></i> Pagar con Paypal </button>
                                            @if ($this->changeable)
                                                <button wire:loading.attr='disabled' class="nav-link fw-bold" id="mimadoPayment-tab" data-bs-toggle="pill" data-bs-target="#mimadoPayment" type="button" role="tab" aria-controls="mimadoPayment" aria-selected="false">Pago con mimado coins </button>
                                            @endif
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <p>Recibe <b class="text-danger">{{round($this->totalProductAmount / 15000)}} <u>mimado coins</u></b></p>
                                                <hr/>
                                                <button type="button" wire:loading.attr='disabled' wire:click="codOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target='codOrder'>
                                                        Pagar
                                                    </span>
                                                    <span wire:loading wire:target='codOrder'>
                                                        Pagando
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <p>Recibe <b class="text-danger">{{round($this->totalProductAmount / 15000)}} <u>mimado coins</u></b></p>                                                
                                                <hr/>
                                                <div>
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                            @if ($this->changeable)
                                                <div class="tab-pane fade" id="mimadoPayment" role="tabpanel" aria-labelledby="mimadoPayment-tab" tabindex="0">
                                                    <div class="coin">
                                                        <div class="mimado-coins-div">
                                                            <span class="mimado-coins"><i class="fa fa-money-bill-wave"></i> {{round($this->totalProductAmount / 1000)}}<br> Mimado coins</span>   
                                                        </div>
                                                    </div>  
                                                    <hr/>
                                                    @if ($this->totalProductAmount >= 100000)
                                                        @if (Auth::user()->coins >= $this->totalProductAmount/1000)
                                                            <button type="button" wire:loading.attr='disabled' wire:click="coinsOrder" class="btn btn-warning">
                                                                <span wire:loading.remove wire:target='coinsOrder'>
                                                                    Pagar Con Mimado Coins
                                                                </span>
                                                                <span wire:loading wire:target='coinsOrder'>
                                                                    Pagando
                                                                </span>
                                                            </button>
                                                        @else
                                                            <button type="button" disabled class="btn btn-danger">No te alcanzas tus mimado coins</button>
                                                        @endif
                                                        
                                                    @else
                                                    <button type="button" disabled class="btn btn-danger">Debe ser compras mayores a $100.000</button>
                                                    @endif
                                                    
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            

                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>No tienes productos por pagar</h4>
                    <a href="{{ url('collections') }}" class="btn btn-danger text-white">Compra ahora</a>
                </div>
            @endif
            
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AQgK8LxspD54hal3Rj6s3FO3d2L8jE_8otieMJxRDddLTOZ6p2dmy2hhizUZDbDmJezN0a6n4BsauocD&currency=USD"></script>
    <script>
        paypal.Buttons({
            onClick: function()  {
                // Show a validation error if the checkbox is not checked
                if (!document.getElementById('fullname').value || !document.getElementById('phone').value || !document.getElementById('email').value || !document.getElementById('pincode').value || !document.getElementById('address').value) {
                    Livewire.emit('validationForAll');
                    return false;
                }else{
                    @this.set('fullname', document.getElementById('fullname').value );
                    @this.set('phone', document.getElementById('phone').value );
                    @this.set('email', document.getElementById('email').value );
                    @this.set('pincode', document.getElementById('pincode').value );
                    @this.set('address', document.getElementById('address').value );
                }
            },
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                amount: {
                    value: Number("{{ $this->totalProductAmount/4920 }}").toFixed(2) // Can also reference a variable or function
                }
                }]
            });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                if(transaction.status == "COMPLETED"){
                    Livewire.emit('transactionEmit', transaction.id);                    
                }
                //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                
            });
            }
        }).render('#paypal-button-container');
    </script>
@endpush
