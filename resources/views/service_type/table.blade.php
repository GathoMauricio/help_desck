<p>
    <button onclick ="createType();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear tipo de servicio
    </button>
    <br/><br/>
    {{$types->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Area</th>
                <th>Nombre</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td>{{ $type->area['name'] }}</td>
                <td>{{ $type->name }}</td>
                <td>{{ $type->created_at }}</td>
                <td>{{ $type->updated_at }}</td>
                <td>
                <button wire:click="edit({{ $type->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                </button>
                </td>
                <td>
                <button onclick="destroy({{ $type->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$types->links('pagination-links')}}
</p>