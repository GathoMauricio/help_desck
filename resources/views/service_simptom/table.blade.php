<p>
    <button onclick ="createSymptom();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear síntoma
    </button>
    <br/><br/>
    {{$simptomps->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Area</th>
                <th>Tipo</th>
                <th>Categoría</th>
                <th>Nombre</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($simptomps as $simptomp)
            <tr>
                <td>{{ $simptomp->category->type->area['name'] }}</td>
                <td>{{ $simptomp->category->type['name'] }}</td>
                <td>{{ $simptomp->category['name'] }}</td>
                <td>{{ $simptomp->name }}</td>
                <td>{{ $simptomp->created_at }}</td>
                <td>{{ $simptomp->updated_at }}</td>
                <td>
                <button wire:click="edit({{ $simptomp->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                </button>
                </td>
                <td>
                <button onclick="destroy({{ $simptomp->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$simptomps->links('pagination-links')}}
</p>