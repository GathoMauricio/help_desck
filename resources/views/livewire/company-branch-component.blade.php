<div class="container">
    @if(isset($company))
    <div class="row">
        <div class="col-md-12">
            <span class="float-right">
            @if($company->image == 'company.png')
            <img src="{{ asset('img/'.$company->image) }}" class="img-circle elevation-2" alt="User Image" width="80" height="80"/>
            @else
            <img src="{{ asset('storage/company_images/'.$company->image) }}" class="img-circle elevation-2" alt="Company Image" width="80" height="80"/>
            @endif
            </span>
            <h4>{{ $company->name }}</h4>
            <h5>{{ $company->description }}</h5>
        </div>
    </div>
    <br/>
    @endif
    <div class="row">
        <div class="col-md-12">
            @include('company_branch_by_id.table')
        </div>
    </div>
    @if(isset($company))
        @include('company_branch_by_id.create')
    @else
        @include("$self_component.create")
    @endif
        @include("$self_component.edit")
</div>