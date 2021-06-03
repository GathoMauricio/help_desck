<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>
                <button onclick ="createUser();" class="btn btn-primary float-right">Crear usuario</button>
                {{$usuarios->links('pagination-links')}}
            </p>
            @include('user.tabla')
        </div>
    </div>
    @include('user.modal_create')
    @include('user.modal_edit')
</div>