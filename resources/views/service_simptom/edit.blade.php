<!-- Modal -->
<div  wire:ignore.self class="modal" id="modal_edit_symptom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Editar síntoma de servicio</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @include('service_simptom.body_form')
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