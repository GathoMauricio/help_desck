<p>
    <button onclick ="createUser();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear usuario
    </button>
    {{$usuarios->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Foto</th>
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
                <td>
                    @if($usuario->image == 'perfil.png')
                    <img src="{{ asset('img/'.$usuario->image) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @else
                    <img src="{{ asset('storage/user_images/'.$usuario->image) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @endif
                </td>
                <td>{{ $usuario->rol['name'] }}</td>
                <td>{{ $usuario->status }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->middle_name }}</td>
                <td>{{ $usuario->last_name }}</td>
                <td>{{ $usuario->branch->company['name'] }}</td>
                <td>{{ $usuario->branch['name'] }}</td>
                <td>
                <button wire:click="edit({{ $usuario->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                    
                </button>
                </td>
                <td>
                <button onclick="deleteUser({{ $usuario->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                    
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$usuarios->links('pagination-links')}}
</p>