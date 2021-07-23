<p>
    <button onclick ="createCaseBinnacle();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear bitácora
    </button>
    <br/><br/>
    {{$binnacles->links()}}
</p>

@if(count($binnacles) > 0)
<!--
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
-->
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($binnacles as $binnacle)
            <tr>
                <td>{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
                <td>{{ $binnacle['description'] }}</td>
                <td>{{ formatDate($binnacle['created_at']) }}</td>

                <td><span class="fa fa-upload text-info" style="cursor: pointer;"></span></td>
                <td><span class="fa fa-eye text-primary" style="cursor: pointer;"></span></td>
                <td><span wire:click="edit({{ $binnacle->id }})" class="fa fa-edit text-warning" style="cursor: pointer;"></span></td>
                <td>
                @if(\Auth::user()->user_rol_id == 1)
                <span onclick="destroy({{ $binnacle->id }});" class="fa fa-trash text-danger" style="cursor: pointer;"></span>
                @endif
                </td>
            </tr>
            @endforeach
        </body>
</table> 
@else
<h3 class="text-center">No hay información para mostrar</h3>
@endif
<p>
    {{$binnacles->links('pagination-links')}}
</p>