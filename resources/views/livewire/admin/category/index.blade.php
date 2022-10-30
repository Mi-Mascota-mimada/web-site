<div>
    @include('livewire.admin.category.modal-form-category')
    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Very well!</strong> {{ session('message') }}.           
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end">Add Category</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status == '1' ? 'Hidden':'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-warning">Edit</a>
                                    <button wire:click="deleteCategory({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</button>                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Categories Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>           
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    
<script>    
    window.addEventListener('close-modal', event => {
        $('#deleteModal').modal('hide');
    })
    
</script>

@endpush