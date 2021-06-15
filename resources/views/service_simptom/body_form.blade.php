<div class="modal-body container">
    <div class="row">
    <div class="col-md-3">
            <label class="font-weight-bold">Area de servicio</label>
            <select wire:model ="currentArea" class="form-control" wire:change = "changeArea">
                <option value>::Seleccionar opción::</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
            @error('currentArea') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="font-weight-bold">Tipo de servicio</label>
            <select wire:model ="currentType" class="form-control" wire:change = "changeType">
                <option value>::Seleccionar opción::</option>
                @if(!is_null($this->types))
                    @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('currentType') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="font-weight-bold">Categoria de servicio</label>
            <select wire:model ="service_type_category_id" class="form-control">
                <option value>::Seleccionar opción::</option>
                @if(!is_null($this->categories))
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('service_type_category_id') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="font-weight-bold">Nombre</label>
            <input wire:model ="name" type="text" class="form-control" placeholder="Nombre..."/>
            @error('name') <span class="error-message">{{ $message }}</span> @enderror
        </div>
    </div>
</div>