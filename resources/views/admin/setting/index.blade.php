@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ url('/admin/settings') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">WebSite Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Website Name</label>
                            <input type="text" name="website_name" value="{{ $setting->website_name ?? '' }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website URL</label>
                            <input type="text" name="website_url" value="{{ $setting->website_url ?? '' }}" class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Page Title</label>
                            <input type="text" name="page_title" value="{{ $setting->page_title ?? '' }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control"/>                            
                        </div>
                        <div class="col-md-6 mb-3">
                            @if ($setting->logo != "")
                                <img src="{{ asset($setting->logo) }}" alt="{{$setting->website_name}}"  class="profile-picture img-thumbnail" width="100"/>
                            @else
                                <img class="profile-picture img-thumbnail" src="{{asset('assets/img/imagen_no_encontrada.jpg')}}" alt="{{$setting->website_name}}" width="100">
                            @endif 
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Main Logo</label>
                            <input type="file" name="main_logo" class="form-control"/>                            
                        </div>
                        <div class="col-md-6 mb-3">
                            @if ($setting->main_logo != "")
                                <img src="{{ asset($setting->main_logo) }}" alt="{{$setting->website_name}}"  class="profile-picture img-thumbnail" width="100"/>
                            @else
                                <img class="profile-picture img-thumbnail" src="{{asset('assets/img/imagen_no_encontrada.jpg')}}" alt="{{$setting->website_name}}" width="100">
                            @endif 
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Keywords</label>
                            <textarea name="meta_keyword" class="form-control" rows="3">{{ $setting->meta_keyword ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ $setting->meta_description ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">WebSite Footer</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $setting->address ?? '' }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone 1</label>
                            <input type="text" name="phone1" class="form-control" value="{{ $setting->phone1 ?? '' }}"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone 2</label>
                            <input type="text" name="phone2" class="form-control" value="{{ $setting->phone2 ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email 1</label>
                            <input type="email" name="email1" class="form-control" value="{{ $setting->email1 ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email 2</label>
                            <input type="email" name="email2" class="form-control" value="{{ $setting->email2 ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">WebSite Social-media</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook ?? '' }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Twitter</label>
                            <input type="text" name="twitter" class="form-control" value="{{ $setting->twitter ?? '' }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Youtube</label>
                            <input type="text" name="youtube" class="form-control" value="{{ $setting->youtube ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">Save Setting</button>
            </div>
        </form>
    </div>
</div>

@endsection