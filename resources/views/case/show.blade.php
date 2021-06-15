<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_show_case" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Información del caso</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        @if(!is_null($currentCase))

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Núm. de Caso</label>
                {{ $currentCase->num_case }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Fecha de creación</label>
                {{ $currentCase->created_at }}
            </div>
            <div class="col-md-6">
                <label class="font-weight-bold">Fecha de modificación</label>
                {{ $currentCase->updated_at }}
            </div>
        </div>
        <hr/>

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Área: </label>
                {{ $currentCase->symptomp->category->type->area['name'] }}
            </div>
            <div class="col-md-6">
                <label class="font-weight-bold">Estatus: </label>
                @if($currentCase->status_id == 1)
                    <span class="text-info">{{ $currentCase->status['name'] }}</span>
                @endif
                @if($currentCase->status_id == 2)
                    <span class="text-primary">{{ $currentCase->status['name'] }}</span>
                @endif
                @if($currentCase->status_id == 3)
                    <span class="text-success">{{ $currentCase->status['name'] }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Servicio: </label>
                {{ $currentCase->symptomp->category->type['name'] }}
            </div>
            <div class="col-md-6">
                <label class="font-weight-bold">Prioridad: </label>
                    @if($currentCase->priority_case_id == 1)
                    <span class="text-info">{{ $currentCase->priority['name'] }}</span>
                    @endif
                    @if($currentCase->priority_case_id == 2)
                    <span class="text-primary">{{ $currentCase->priority['name'] }}</span>
                    @endif
                    @if($currentCase->priority_case_id == 3)
                    <span class="text-warning">{{ $currentCase->priority['name'] }}</span>
                    @endif
                    @if($currentCase->priority_case_id == 4)
                    <span class="text-danger">{{ $currentCase->priority['name'] }}</span>
                    @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Categoría: </label>
                {{ $currentCase->symptomp->category['name'] }}
            </div>
            <div class="col-md-6">
                <label class="font-weight-bold">Síntoma: </label>
                {{ $currentCase->symptomp['name'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="font-weight-bold">Descripción: </label>
                {{ $currentCase->description }}
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Contacto: </label>
                {{ $currentCase->contact['name'] }} {{ $currentCase->contact['middle_name'] }} {{ $currentCase->contact['last_name'] }}
            </div>
            <div class="col-md-6">
                <label class="font-weight-bold">Asignado a: </label>
                @if(Auth::user()->user_rol_id == 1)
                <select wire:model = "currentCaseSupport" class="form-control">
                <option value>::Seleccione una opción::</option>
                {{!! $supprts = \App\Models\User::where('user_rol_id',2)->orderBy('name')->get() !!}}
                @foreach( $supprts as $supprt)
                <option value="{{ $supprt->id }}">{{ $supprt->name }} {{ $supprt->middle_name }} {{ $supprt->last_name }}</option>
                @endforeach
                </select>
                @else
                    @if($currentCase->support['name'])
                    {{ $currentCase->support['name'] }} {{ $currentCase->support['middle_name'] }} {{ $currentCase->support['last_name'] }}
                    @else
                    No definido aún...
                    @endif
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="font-weight-bold">Empresa: </label>
                {{ $currentCase->contact->branch->company['name'] }}
            </div>
            <div class="col-md-6">
                <label class="font-weight-bold">Sucursal: </label>
                {{ $currentCase->contact->branch['name'] }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="font-weight-bold">Retroalimentación: </label>
                @if(Auth::user()->user_rol_id == 1 || Auth::user()->user_rol_id == 2)
                <textarea wire:model ="currentCaseFeedback" class="form-control" placeholder="Ingrese la solución..."></textarea>
                @else
                    @if($currentCase->feedback)
                    {{ $currentCase->feedback }}
                    @else
                    No se ha definido la solución aún...
                    @endif
                @endif
            </div>
        </div>

        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        @if(Auth::user()->user_rol_id == 1 || Auth::user()->user_rol_id == 2)
        <button wire:click = "update" type="button" class="btn btn-primary">Actualizar información</button>
        @endif
      </div>
    </div>
  </div>
</div>
<style>
.error-message {
    color: red;
}
</style>