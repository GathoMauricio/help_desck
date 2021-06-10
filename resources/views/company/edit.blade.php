<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_edit_company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Editar compañía</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">

        <div class="row">
          <div class="col-md-6">
              <label class="font-weight-bold">Nombre</label>
              <input wire:model ="name" type="text" class="form-control" placeholder="Nombre..."/>
              @error('name') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-6">
              <label class="font-weight-bold">Imagen</label>
              <input wire:model ="image" type="file" class="form-control" placeholder="Imagen..." accept="image/png">
              @error('image') <span class="error-message">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
              <label class="font-weight-bold">Descripción</label>
              <textarea wire:model ="description" class="form-control" placeholder="Descripción..."></textarea>
              @error('description') <span class="error-message">{{ $message }}</span> @enderror
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click = "update" type="button" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<style>
.error-message {
    color: red;
}
</style>