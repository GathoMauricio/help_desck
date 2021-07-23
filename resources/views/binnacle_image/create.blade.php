<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_create_binnacle_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">
                    Añadir imagen
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
            <div class="row">
                    <div class="col-md-12">
                        <label class="font-weight-bold">Descripción de la bitácora</label>
                        <input wire:model ="binnacle_image" type="file" class="form-control" placeholder="Imagen..." accept="image/*">
                        @error('binnacle_image') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="font-weight-bold">Descripción de la bitácora</label>
                        <textarea wire:model ="binnacle_image_description" type="text" class="form-control" placeholder="Descripción..."></textarea>
                        @error('binnacle_image_description') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button wire:click = "storeBinnacleImage" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>