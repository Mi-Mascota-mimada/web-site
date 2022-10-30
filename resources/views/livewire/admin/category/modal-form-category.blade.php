<!-- DELETE BRAND MODAL-->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Loading...
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="destroyCategory">
                <div class="modal-body">
                    <h4>Are you sure? Do you want delete this Category</h4>                    
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes. Delete</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
</div>
<!-- DELETE BRAND MODAL-->