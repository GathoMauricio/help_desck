<p>
    <button onclick ="createArea();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear área
    </button>
    <br/><br/>
    {{$areas->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $area)
            <tr>
                <td>{{ $area->name }}</td>
                <td>{{ $area->created_at }}</td>
                <td>{{ $area->updated_at }}</td>
                <td>
                <button wire:click="edit({{ $area->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                </button>
                </td>
                <td>
                <button onclick="destroy({{ $area->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$areas->links('pagination-links')}}
</p>