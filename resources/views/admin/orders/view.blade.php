@extends('layouts.admin')

@section('content')

<div >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success mb-3">{{ session('message') }}</div>
                @endif
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">
                        <i class="fa fa-shopping-cart text-dark"></i> Order details
                        <a href="{{url('admin/orders')}}" class="btn btn-light btn-sm float-end">Back</a>
                        <a href="{{url('admin/invoice/'.$order->id.'/generate')}}" class="btn btn-light btn-sm float-end text-white" title="download">
                            <i class="mdi mdi-download text-dark"></i>
                        </a>
                        <a href="{{url('admin/invoice/'.$order->id)}}" target="_blank" class="btn btn-light btn-sm float-end" title="View">
                            <i class="mdi mdi-file-pdf text-danger"></i>
                        </a>
                        <a href="{{url('admin/invoice/'.$order->id.'/mail')}}" class="btn btn-light btn-sm float-end" title="Send invoice via Mail">
                            <i class="mdi mdi-email-outline text-danger"></i>
                        </a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order</h5>
                            <hr>
                            <h6><b>Id: </b> {{$order->id}}</h6>
                            <h6><b>Reference: </b> {{$order->tracking_no}}</h6>
                            <h6><b>Date: </b> {{$order->created_at->format('F l jS Y h:i A')}}</h6>
                            <h6><b>Payment Method: </b> {{$order->payment_mode}}</h6>
                            <h6 class="border p-2">
                               <b>Status: </b> <span class="text-danger">{{$order->status_message}}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User</h5>
                            <hr>
                            <h6><b>Name: </b> {{$order->fullname}}</h6>
                            <h6><b>Email: </b> {{$order->email}}</h6>
                            <h6><b>Phone: </b> {{$order->phone}}</h6>
                            <h6><b>Address: </b> {{$order->address}}</h6>
                            <h6><b>Pin code: </b> {{$order->pincode}}</h6>
                        </div>
                    </div>
                    <br>
                    <h5>Products</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                    $totalQuantity = 0;
                                @endphp
                                @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <td>
                                            @if ($orderItem->product->productImages)
                                                <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px; float:left;" alt="{{ $orderItem->product->name }}" />
                                            @else
                                                <img src="{{ asset('assets/img/imagen_no_encontrada.jpg') }}" alt="Imagen no encontrada" class="img-fluid">
                                            @endif                                          
                                            
                                        </td>
                                        <td>
                                            {{ $orderItem->product->name }}
                                            @if ($orderItem->productColor)                                
                                                <br>
                                                @if ($orderItem->productColor->color)                     
                                                    <span>Color: {{ $orderItem->productColor->color->name }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>${{ number_format($orderItem->price) }}</td>
                                        <td>{{ $orderItem->quantity }}</td>
                                        <td class="fw-bold">${{ number_format($orderItem->quantity * $orderItem->price) }}</td>
                                    </tr>
                                    @php
                                        $totalPrice += $orderItem->quantity * $orderItem->price;
                                        $totalQuantity += $orderItem->quantity;
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="fw-bold">Totals</td>
                                    <td class="fw-bold">{{$totalQuantity}}</td>
                                    <td class="fw-bold">{{number_format($totalPrice)}}</td>
                                </tr>
                                @if ($user)
                                    <tr>
                                        <td colspan="4"><b>Mimado Coins ganados:</b></td>
                                        <td><b>{{number_format(floatval($totalPrice)/15000, 2)}}</b></td>
                                    </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card border mt-3">
                    <div class="card-header">
                        <h4>Order Process (Order Status Updates)</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-5">
                            <form action="{{ url('admin/orders/'.$order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label>Update your order status</label>
                                <div class="input-group">
                                    <select name="order_status" class="form-select">
                                        <option value="">Select status</option>
                                        <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : ''}}>In Progess</option>
                                        <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                                        <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="out-for-delivery" {{ Request::get('status') == 'out-for-deliver' ? 'selected' : ''}}>Out for delivery</option>
                                    </select>
                                    <input type="hidden" name="total" value="{{$totalPrice}}">
                                    <input type="hidden" name="user_id" value="{{$order->user_id}}">
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7">
                            <br>
                            <h4 class="mt-3">Order Status: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection