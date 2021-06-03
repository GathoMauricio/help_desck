<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_create_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Crear usuario</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">

        <div class="row">
          <div class="col-md-4">
              <label class="font-weight-bold">Rol de usuario</label>
              <select wire:model ="user_rol_id" class="form-control">
              <option value>==Seleccionar==</option>
              @foreach($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
              @endforeach
              </select>
              @error('user_rol_id') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Empresa</label>
              <select  wire:model ="company_id"  class="form-control">
              @if($company_id==0)
              <option value>==Seleccionar==</option>
              @endif
              @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
              </select>
              @error('company_id') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          @if(!is_null($this->branches))
          <div class="col-md-4">
              <label class="font-weight-bold">Sucursal</label>
              <select wire:model ="company_branch_id"   class="form-control">
                <option value>==Seleccionar==</option>
                
                @foreach($branches as $branch)
                  <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
                
              </select>
              @error('branch_company_id') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          @endif
        </div>

        <div class="row">
          <div class="col-md-4">
              <label class="font-weight-bold">Nombre</label>
              <input wire:model ="name" type="text" class="form-control" placeholder="Nombre..."/>
              @error('name') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">A. Paterno</label>
              <input wire:model ="middle_name" type="text" class="form-control" placeholder="A. Paterno..."/>
              @error('middle_name') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">A. Materno</label>
              <input wire:model ="last_name" type="text" class="form-control" placeholder="A. Materno..."/>
              @error('last_name') <span class="error-message">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
              <label class="font-weight-bold">Teléfono</label>
              <input wire:model ="phone" type="text" class="form-control" placeholder="Teléfono..."/>
              @error('phone') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Tel. Emergencia</label>
              <input wire:model ="emergency_phone" type="text" class="form-control" placeholder="Tel. Emergencia..."/>
              @error('emergency_phone') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Email</label>
              <input wire:model ="email" type="email" class="form-control" placeholder="Email..."/>
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

        <div class="row">
          <div class="col-md-4">
              <label class="font-weight-bold">Imagen</label>
              <input wire:model ="image" type="file" class="form-control" placeholder="Imagen..."/>
              @error('image') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Contraseña</label>
              <input wire:model ="password" type="password" class="form-control" placeholder="Contraseña..."/>
              @error('password') <span class="error-message">{{ $message }}</span> @enderror
          </div>
          <div class="col-md-4">
              <label class="font-weight-bold">Confirmar contraseña</label>
              <input wire:model ="password_confirmation" type="password" class="form-control" placeholder="Confirmar contraseña..."/>
              @error('password_confirmation') <span class="error-message">{{ $message }}</span> @enderror
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