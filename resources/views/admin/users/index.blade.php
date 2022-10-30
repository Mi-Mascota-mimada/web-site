@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>
                    Users
                    <a href="{{ url('admin/users/add_user') }}" class="float-end text-white btn btn-sm btn-primary">Add user</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-stripped table-hover dataTable">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Coins</th>
                        <th>Rol</th>
                        <th>Photo</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $userItem)
                            <tr>
                                <td>{{$userItem->id}}</td>
                                <td>{{$userItem->name}}</td>
                                <td>{{$userItem->email}}</td>
                                <td class="text-danger">{{$userItem->coins}}</td>
                                <td>
                                    <form action="{{url('admin/users/'.$userItem->id)}}" method="post">
                                        @csrf
                                        <select name="role" class="form-control text-dark" onchange="this.form.submit()">
                                            @if ($userItem->role_as == '0')
                                                <option value="0" selected>Customer</option>
                                                <option value="1">Admin</option>
                                            @else
                                                <option value="0">Customer</option>
                                                <option value="1" selected>Admin</option>
                                            @endif
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if ($userItem->picture != "")
                                        @if ($userItem->external_auth === 'google')
                                            <img src="{{ url($userItem->picture) }}" alt="{{$userItem->name}}"  class="profile-picture img-thumbnail"/>
                                        @else                                
                                            <img src="{{ Storage::url($userItem->picture) }}" alt="{{$userItem->name}}"  class="profile-picture img-thumbnail"/>
                                        @endif
                                        
                                    @else
                                        <img class="profile-picture img-thumbnail" src="{{asset('assets/img/imagen_no_encontrada.jpg')}}" alt="{{$userItem->name}}">
                                    @endif     
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Users Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection