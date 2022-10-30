@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Products
                    <a href="{{ url('admin/products/add_product') }}" class="btn btn-primary btn-sm text-white float-end">Add Product</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Rater</th>
                            <th>Changeable</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id}}</td>
                                <td>
                                    @if ($product->category)
                                        {{ $product->category->name}}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->selling_price}}</td>
                                <td>{{ $product->quantity}}</td>
                                <td>{{ $product->status == '1' ? 'Hidden':'visible'}}</td>
                                <td>{{ $product->qualification}}</td>
                                <td>{{ $product->changeable == '1' ? 'Yes':'No'}}</td>
                                <td>
                                    <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ url('/admin/products/'.$product->id.'/delete') }}" onclick="return confirm('Are you sure, you want delete this product?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No Products Available</td>
                            </tr>
                        @endforelse                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

