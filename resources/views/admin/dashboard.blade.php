@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if(session('message'))
            <h2>{{ session('message') }}</h2>
        @endif
        <div class="me-md-3 me-xl-5">
            <h2>Dashboard</h2>
            <p class="mb-md-0">Yur analytics dashboard template</p>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <h4><label><i class="mdi mdi-sale menu-icon"></i> Total Orders</label></h4>                    
                    <h2>{{$totalOrder}}</h2>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <h4><label><i class="mdi mdi-calendar-check"></i> Today Orders</label></h4>
                    <h2>{{$todayOrder}}</h2>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <h4><label><i class="mdi mdi-calendar-check"></i> This Month Orders</label></h4>
                    <h2>{{$thisMonthOrder}}</h2>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <h4><label><i class="mdi mdi-calendar-check"></i>This Year Orders</label></h4>
                    <h2>{{$thisYearOrder}}</h2>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <h4><label><i class="mdi mdi-apps menu-icon"></i> Total Products</label></h4>                    
                    <h2>{{$totalProducts}}</h2>
                    <a href="{{url('admin/products')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <h4><label><i class="mdi mdi-view-dashboard"></i> Total Categories</label></h4>
                    <h2>{{$totalCategories}}</h2>
                    <a href="{{url('admin/category')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <h4><label><i class="mdi mdi-tag menu-icon"></i> Total Brands</label></h4>
                    <h2>{{$totalBrands}}</h2>
                    <a href="{{url('admin/brands')}}" class="text-white">View</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <h4><label><i class="mdi mdi-account-multiple"></i> Total Users</label></h4>                    
                    <h2>{{$totalAllUsers}}</h2>
                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <h4><label><i class="mdi mdi-account-check"></i> Customers</label></h4>
                    <h2>{{$totalUser}}</h2>
                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <h4><label><i class="mdi mdi-shield"></i> Admins</label></h4>
                    <h2>{{$totalAdmin}}</h2>
                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection