<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>
                <button onclick ="createUser();" class="btn btn-primary">Crear usuario</button>
            </p>
            @include('user.tabla')
        </div>
    </div>
    @include('user.modal_create')
</div>