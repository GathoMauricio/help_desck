<p>
    <button onclick ="createCompany();" class="btn btn-primary float-right">
        <span class="fa fa-plus">&nbsp;&nbsp;</span>
        Crear empresa
    </button>
    <br/><br/>
    {{$companies->links()}}
</p>
<input type="text" wire:model="search_text" class="form-control"  autocomplete="off"  placeholder="Buscar..."/>
<table id="example2" class="table table-bordered table-hover dataTable dtr-inline collapsed" role="grid" aria-describedby="example2_info">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th colspan="2">&nbsp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>
                    @if($company->image == 'company.png')
                    <img src="{{ asset('img/'.$company->image) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @else
                    <img src="{{ asset('storage/company_images/'.$company->image) }}" class="img-circle elevation-2" alt="User Image" width="60" height="60"/>
                    @endif
                </td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->description }}</td>
                <!--
                <td>
                <button wire:click="show({{ $company->id }})" class="btn btn-primary" title="Ver...">
                <span class="fa fa-eye"></span>
                </button>
                </td>
                -->
                <td>
                <button wire:click="edit({{ $company->id }})" class="btn btn-warning" title="Editar...">
                <span class="fa fa-edit"></span>
                </button>
                </td>
                <td>
                <button onclick="deleteCompany({{ $company->id }})" class="btn btn-danger" title="Eliminar...">
                <span class="fa fa-trash"></span>
                </button>
                </td>
            </tr>
            @endforeach
        </body>
</table> 
<p>
    {{$companies->links('pagination-links')}}
</p>