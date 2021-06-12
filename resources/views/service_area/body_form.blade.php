<div class="modal-body container">
    <div class="row">
        <div class="col-md-12">
            <label class="font-weight-bold">Nombre</label>
            <input wire:model ="name" type="text" class="form-control" placeholder="Nombre..."/>
            @error('name') <span class="error-message">{{ $message }}</span> @enderror
        </div>
    </div>
</div>