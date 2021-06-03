<input type="text" wire:model = "search_text"  class="form-control" placeholder="Buscar..."/>
<table class="table">
        <thead>
            <tr>
                <th>Rol</th>
                <th>Estado</th>
                <th>Nombre</th>
                <th>A. Paterno</th>
                <th>A. Materno</th>
                <th>Empresa</th>
                <th>Sucursal</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->rol['name'] }}</td>
                <td>{{ $usuario->status }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->middle_name }}</td>
                <td>{{ $usuario->last_name }}</td>
                <td>{{ $usuario->branch->company['name'] }}</td>
                <td>{{ $usuario->branch['name'] }}</td>
                <td><button wire:click="edit({{ $usuario->id }})" class="btn btn-warning">Editar</button></td>
                <td><button onclick="deleteUser({{ $usuario->id }})" class="btn btn-danger">Eliminar</button></td>
            </tr>
            @endforeach
        </body>
</table> 
<div wire:ignore.self>
{{$usuarios->links('pagination-links')}}
</div>