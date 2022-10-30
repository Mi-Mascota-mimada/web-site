@extends('layouts.app')

@section('title', 'Mis pedidos')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">Mis pedidos</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Referencia</th>
                                    <th>Usuario</th>
                                    <th>Metodo de pago</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $orderItem)
                                    <tr>
                                        <td>{{$orderItem->id}}</td>
                                        <td>{{$orderItem->tracking_no}}</td>
                                        <td>{{$orderItem->fullname}}</td>
                                        <td>{{$orderItem->payment_mode}}</td>
                                        <td>{{$orderItem->created_at->format('d-m-Y')}}</td>
                                        <td>{{$orderItem->status_message}}</td>
                                        <td>
                                            <a href="{{ url('orders/'.$orderItem->id) }}" class="btn btn-light btn-sm">Detalles</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No ha realizado ningu pedido</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection