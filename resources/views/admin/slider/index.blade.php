@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Sliders
                    <a href="{{ url('admin/sliders/addSlider') }}" class="btn btn-primary btn-sm text-white float-end">Add Slider</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td title="{{$slider->title}}">
                                    {{ strlen($slider->title)  > 35 ? substr($slider->title,0, 34)."..." : $slider->title}}
                                </td>
                                <td title="{{ $slider->description }}">
                                    {{ strlen($slider->description)  > 35 ? substr($slider->description,0, 34)."..." : $slider->description}}
                                </td>
                                <td><img src="{{ asset($slider->image) }}" class="img-thumbnail" alt="mi_mascota_slider{{$slider->id}}" style="width:50px; height:50px;"></td>
                                <td>{{ $slider->status > 0 ? 'Hidden':'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/sliders/'.$slider->id.'/edit') }}" class="btn btn-sm btn-warning text-white"><i class="mdi mdi-lead-pencil"></i></a>
                                    <a href="{{ url('admin/sliders/'.$slider->id.'/delete') }}" onclick="return confirm('Are you sure? Do you want to delete this slider')" class="btn btn-sm btn-danger text-white"><i class="mdi mdi-delete-forever"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Sliders Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection