<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_create_case" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Crear caso</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">

        <div class="row">
            <div class="col-md-3">
                <label class="font-weight-bold">Área</label>
                <select wire:model ="currentArea"class="form-control" wire:change = "changeArea">
                <option value>::Seleccione una opción::</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{  $area->name }}</option>
                @endforeach
                </select>
                @error('currentArea') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
              <label class="font-weight-bold">Tipo de servicio</label>
                @if(!is_null($types))
                <select wire:model ="currentServiceType" class="form-control" wire:change = "changeType">
                    <option value>::Seleccione una opción::</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @else
                <br/>
                @endif
              @error('currentServiceType') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
              <label class="font-weight-bold">Categoría de servicio</label>
                @if(!is_null($categories))
                <select wire:model ="currentServiceTypeCategory" class="form-control" wire:change = "changeCategory">
                    <option value>::Seleccione una opción::</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @else
                <br/>
                @endif
              @error('currentServiceTypeCategory') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
              <label class="font-weight-bold">Síntoma de servicio</label>
                @if(!is_null($simptoms))
                <select wire:model ="symptomp_id" class="form-control" wire:change = "changeSymptom">
                    <option value>::Seleccione una opción::</option>
                    @foreach($simptoms as $simptom)
                    <option value="{{ $simptom->id }}">{{ $simptom->name }}</option>
                    @endforeach
                </select>
                @else
                <br/>
                @endif
              @error('symptomp_id') <span class="error-message">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
              <label class="font-weight-bold">Prioridad</label>
                <select wire:model ="priority_case_id" class="form-control">
                    <option value>::Seleccione una opción::</option>
                    @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
                @error('priority_case_id') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <label class="font-weight-bold">Descripción</label>
                <textarea wire:model ="description" class="form-control" placeholder="Descripción..."></textarea>
                @error('description') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        @if(!is_null($suggestions))
        <input wire:model="cb_suggest" type='checkbox' > {{ $cb_suggest }} He leido y comprobado que he llevado a cabo todas las sugerencias antes de continuar.
        @foreach($suggestions as $suggestion)
        <div class="row"> 
          <div class="col-md-12">
              <span class="text-info">* {{ $suggestion->body }}<span> <br/>
          </div>
        </div>
        @endforeach
          @error("cb_suggest") <br/><span class="error-message">{{ $message }}</span> @enderror
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click = "store" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<style>
.error-message {
    color: red;
}
</style>