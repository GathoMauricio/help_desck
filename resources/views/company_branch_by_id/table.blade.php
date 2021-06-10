<p>
    @if(isset($company))
    <button onclick ="createCompanyBranchbyId();" class="btn btn-primary float-right">
    @else
    <button onclick ="createCompanyBranch();" class="btn btn-primary float-right">
    @endif
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear sucursal
    </button>
    <br/><br/>
    {{$branches->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Sucursal</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branches as $branch)
            <tr>
                <td>
                @if($branch->company['image'] == 'company.png')
                <img src="{{ asset('img/'.$branch->company['image']) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                 @else
                <img src="{{ asset('storage/company_images/'.$branch->company['image']) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                @endif
                <br/>
                {{ $branch->company['name'] }}
                </td>
                <td>{{ $branch->name }}</td>
                <td>{{ $branch->email }}</td>
                <td>{{ $branch->phone }}</td>
                <td>{{ $branch->address }}</td>
                <td>
                <button wire:click="edit({{ $branch->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                </button>
                </td>
                <td>
                <button onclick="deleteCompanyBranch({{ $branch->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$branches->links('pagination-links')}}
</p>