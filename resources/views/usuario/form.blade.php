<div class="form-group">
    <label>Nombre</label>
    <input wire:model = "name"  type="text" class="form-control" />
    @error('name') <span>{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>A. Paterno</label>
    <input wire:model = "middle_name"  type="text" class="form-control" />
    @error('middle_name') <span>{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>A. Materno</label>
    <input wire:model = "last_name"  type="text" class="form-control" />
    @error('last_name') <span>{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>Email</label>
    <input wire:model = "email"  type="text" class="form-control" />
    @error('email') <span>{{ $message }}</span> @enderror
</div>