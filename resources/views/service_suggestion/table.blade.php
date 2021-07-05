<p>
    <button onclick ="createSuggestion();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear sugerencia
    </button>
    <br/><br/>
    {{$suggestions->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Area</th>
                <th>Tipo</th>
                <th>Categoría</th>
                <th>Síntoma</th>
                <th>Sugerencia</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suggestions as $suggestion)
            <tr>
                <td>{{ $suggestion->symptom->category->type->area['name'] }}</td>
                <td>{{ $suggestion->symptom->category->type['name'] }}</td>
                <td>{{ $suggestion->symptom->category['name'] }}</td>
                <td>{{ $suggestion->symptom['name'] }}</td>
                <td>{{ $suggestion->body }}</td>
                <td>{{ $suggestion->created_at }}</td>
                <td>{{ $suggestion->updated_at }}</td>
                <td>
                <button wire:click="edit({{ $suggestion->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                </button>
                </td>
                <td>
                <button onclick="destroy({{ $suggestion->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$suggestions->links('pagination-links')}}
</p>