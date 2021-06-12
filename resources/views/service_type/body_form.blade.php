<div class="modal-body container">
    <div class="row">
    <div class="col-md-6">
            <label class="font-weight-bold">Area</label>
            <select wire:model ="service_area_id" class="form-control">
                <option value>::Seleccionar opción::</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
            @error('service_area_id') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6">
            <label class="font-weight-bold">Nombre</label>
            <input wire:model ="name" type="text" class="form-control" placeholder="Nombre..."/>
            @error('name') <span class="error-message">{{ $message }}</span> @enderror
        </div>
    </div>
</div>