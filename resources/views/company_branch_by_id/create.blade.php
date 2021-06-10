<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_create_company_branch_by_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        @if($company->image == 'company.png')
            <img src="{{ asset('img/'.$company->image) }}" class="img-circle elevation-2" alt="Company Image" width="60" height="60"/>
            @else
            <img src="{{ asset('storage/company_images/'.$company->image) }}" class="img-circle elevation-2" alt="Company Image" width="60" height="60"/>
        @endif
        <h3 class="modal-title" id="exampleModalLabel" style="padding-top:20px;padding-left:20px;">Crear sucursal para {{ $company->name }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        <input type="hidden" wire:model="company_id">
        @error('company_id') <span class="error-message">{{ $message }}</span> @enderror
        <div class="row">
          <div class="col-md-4">
              <label class="font-weight-bold">Nombre</label>
              <input wire:model ="name" type="text" class="form-control" placeholder="Nombre..."/>
              @error('name') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Teléfono</label>
              <input wire:model ="phone" type="text" class="form-control" placeholder="Teléfono..."/>
              @error('phone') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Email</label>
              <input wire:model ="email" type="text" class="form-control" placeholder="Email..."/>
              @error('email') <span class="error-message">{{ $message }}</span> @enderror
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
              <label class="font-weight-bold">Dirección</label>
              <textarea wire:model ="address" class="form-control" placeholder="Dirección..."></textarea>
              @error('address') <span class="error-message">{{ $message }}</span> @enderror
          </div>
        </div>

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