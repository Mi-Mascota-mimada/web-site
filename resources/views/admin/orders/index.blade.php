@extends('layouts.admin')

@section('content')

<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">My Orders</h4>
                    <hr>
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Filter by Date</label>
                                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label>Filter by Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select status</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : ''}}>In Progess</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="out-for-delivery" {{ Request::get('status') == 'out-for-deliver' ? 'selected' : ''}}>Out for delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">

                        <table class="table table-stripped table-bordered table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Reference</th>
                                    <th>User</th>
                                    <th>Payment Method</th>
                                    <th>Date</th>
                                    <th>Estatus</th>
                                    <th>Actions</th>
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
                                            <a href="{{ url('admin/orders/'.$orderItem->id) }}" class="btn btn-light btn-sm">Details</a>
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