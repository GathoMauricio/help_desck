<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_create_company_branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel" style="padding-top:20px;padding-left:20px;">Crear sucursal</h3>
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
              <label class="font-weight-bold">Teléfono</label>
              <input wire:model ="phone" type="text" class="form-control" placeholder="Teléfono..."/>
              @error('phone') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          

        </div>
        <div class="row">
            <div class="col-md-6">
              <label class="font-weight-bold">Email</label>
              <input wire:model ="email" type="text" class="form-control" placeholder="Email..."/>
              @error('email') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
              <label class="font-weight-bold">Empresa</label>
              <select wire:model ="company_id_aux" class="form-control" required>
                <option value>::Selecione una opción::</option>
                {{ !! $companies = \App\Models\Company::orderBy('name')->get() }}!!}}
                @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
              </select>
              @error('company_id_aux') <span class="error-message">{{ $message }}</span> @enderror
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