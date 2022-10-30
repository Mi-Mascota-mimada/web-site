<!-- ADD BRAND MODAL-->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBrandModalLabel">Add Brands</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeBrand" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Select Category</label>
                    <select wire:model.defer="category_id" required class="form-select p-2">
                        <option value="">--Select Category--</option>
                        @foreach ($categories as $categoryItem)
                            <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger"> {{ $message }} </small> @enderror
                </div>
                <div class="mb-3">
                    <label>Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name') <small class="text-danger"> {{ $message }} </small> @enderror
                </div>
                <div class="mb-3">
                    <label>Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug') <small class="text-danger"> {{ $message }} </small> @enderror
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" wire:model.defer="image" class="form-control" />
                    @error('image') <small class="text-danger"> {{ $message }} </small> @enderror
                </div>
                <div class="mb-3">
                    <label>SVG</label>
                    <textarea wire:model.defer="svg" rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Status</label> <br>
                    <input type="checkbox" wire:model.defer="status" > Checked=Hidden, Un-Checked= Visible
                    @error('status') <small class="text-danger"> {{ $message }} </small> @enderror
                </div>
            </div>
        
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- ADD BRAND MODAL-->
<!-- EDIT BRAND MODAL-->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="updateBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateBrandModalLabel">Update Brands</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Loading...
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="updateBrand" enctype="multipart/form-data">
                <div class="mb-3 p-2">
                    <label>Select Category</label>
                    <select wire:model.defer="category_id" required class="form-select">
                        <option value="">--Select Category--</option>
                        @foreach ($categories as $categoryItem)
                            <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger"> {{ $message }} </small> @enderror
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Brand Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Brand Slug</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Image</label>                       
                        <input type="file" wire:model.defer="image" class="form-control" />
                        @if ($this->imgBack !== $this->image)
                            <img src="{{ $this->image->temporaryUrl() }}" alt="{{ $this->name }}" / class="img-fluid" style="width: 70px; height:70px;">
                        @else
                            <img src="{{ Storage::url($this->image) }}" alt="{{ $this->name }}" / class="img-fluid" style="width: 70px; height:70px;">
                        @endif
                        </td>
                        @error('image') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>SVG</label>
                        <textarea wire:model.defer="svg" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br>
                        <input type="checkbox" wire:model.defer="status" /> Checked=Hidden, Un-Checked= Visible
                        @error('status') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
</div>
<!-- EDIT BRAND MODAL-->
<!-- DELETE BRAND MODAL-->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBrandModalLabel">Delete Brand</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Loading...
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="destroyBrand">
                <div class="modal-body">
                    <h4>Are you sure? Do you want delete this brand</h4>                    
                </div>
            
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes. Delete</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
</div>
<!-- DELETE BRAND MODAL-->