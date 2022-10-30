<!-- EDIT Profile MODAL-->
<div wire:ignore.self class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="updateProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateProfileLabel">Editar Mi Perfil</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div> Cargando...
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="updateMyProfile" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Correo</label>
                        <input type="text" wire:model.defer="email" class="form-control">
                        @error('email') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Foto de perfil</label>                       
                        <input type="file" wire:model.defer="picture" class="form-control" />
                        @if ($this->pictureBack !== $this->picture)
                            <img src="{{ $this->picture->temporaryUrl() }}" alt="{{ $this->name }}" class="img-fluid" style="width: 70px; height:70px;">
                        @else                            
                            @if (str_contains($this->picture, 'google'))
                            <img src="{{ url($this->picture) }}" alt="{{ $this->name }}" class="img-fluid" style="width: 70px; height:70px;">
                            @else
                                <img src="{{ Storage::url($this->picture) }}" alt="{{ $this->name }}" class="img-fluid" style="width: 70px; height:70px;">   
                            @endif
                        @endif
                        </td>
                        @error('picture') <small class="text-danger"> {{ $message }} </small> @enderror
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
</div>
<!-- EDIT Profile MODAL-->