@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create User
                    <a href="{{url('admin/users')}}" class="btn btn-sm btn-danger text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">                    
                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">                        
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />                        
                            </div>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ url('admin/users') }}">
                    @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required autofocus />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required autocomplete="new-password"/>
                        </div>
                        <div class="form-group">
                            <label>Password confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" required autocomplete="password_confirmation"/>
                        </div>
                        <div class="form-group">
                            <label>Rol</label>
                            <select name="rol" id="rol" class="form-control">
                                <option value="0">Customer</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection