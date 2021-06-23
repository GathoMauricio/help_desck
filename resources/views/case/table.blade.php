<p>
    <button onclick ="createCase();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear caso
    </button>
    <br/><br/>
    {{$cases->links()}}
</p>
<!--
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
-->
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Núm. de Caso</th>
                <th>Contacto</th>
                <th>Empresa</th>
                <th>Sucursal</th>
                <th>Área</th>
                <th>Servicio</th>
                <th>Categoría</th>
                <th>Sintoma</th>
                <th>Prioridad</th>
                <th>Estatus</th>
                <th colspan="3">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>
                    <b>{{ $case->num_case }}</b>
                    <br/>
                    <small>
                    @if($case->support['name'])
                    Asignado a <span class="text-info">{{ $case->support['name'] }} {{ $case->support['middle_name'] }}</span>
                    @else
                    <span class="text-warning">No asignado aún</span>
                    @endif
                    </small>
                </td>
                <td class="text-center">
                    
                    @if($case->contact['image'] == 'perfil.png')
                    <img src="{{ asset('img/'.$case->contact['image']) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @else
                    <img src="{{ asset('storage/user_images/'.$case->contact['image']) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @endif
                    <br/>
                    {{ $case->contact['name'].' '.$case->contact['middle_name'] }}
                </td>
                <td class="text-center">
                    
                    @if($case->contact->branch->company['image'] == 'company.png')
                    <img src="{{ asset('img/'.$case->contact->branch->company['image']) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @else
                    <img src="{{ asset('storage/company_images/'.$case->contact->branch->company['image']) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @endif
                    <br/>
                    {{ $case->contact->branch->company['name'] }}
                </td>
                <td>{{ $case->contact->branch['name'] }}</td>
                <td>{{ $case->symptomp->category->type->area['name'] }}</td>
                <td>{{ $case->symptomp->category->type['name'] }}</td>
                <td>{{ $case->symptomp->category['name'] }}</td>
                <td>{{ $case->symptomp['name'] }}</td>
                <td>
                    @if($case->priority_case_id == 1)
                    <p class="bg-info text-center">{{ $case->priority['name'] }}</p>
                    @endif
                    @if($case->priority_case_id == 2)
                    <p class="bg-primary text-center">{{ $case->priority['name'] }}</p>
                    @endif
                    @if($case->priority_case_id == 3)
                    <p class="bg-warning text-center">{{ $case->priority['name'] }}</p>
                    @endif
                    @if($case->priority_case_id == 4)
                    <p class="bg-danger text-center">{{ $case->priority['name'] }}</p>
                    @endif
                </td>
                <td>
                @if($case->status_id == 1)
                    <p class="bg-info text-center">{{ $case->status['name'] }}</p>
                @endif
                @if($case->status_id == 2)
                    <p class="bg-primary text-center">{{ $case->status['name'] }}</p>
                @endif
                @if($case->status_id == 3)
                    <p class="bg-success text-center">{{ $case->status['name'] }}</p>
                @endif
                </td>
                <td><span wire:click = "show({{ $case->id }})" class="fa fa-eye text-info" style="cursor: pointer;"></span></td>
                <td><span onclick="caseFollow({{ $case->id }})" class="fa fa-comments text-primary" style="cursor: pointer;"></span></td>
                <td>
                @if(\Auth::user()->user_rol_id == 1)
                <span onclick="destroy({{ $case->id }});" class="fa fa-trash text-danger" style="cursor: pointer;"></span>
                @endif
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$cases->links('pagination-links')}}
</p>