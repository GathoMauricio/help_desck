<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include("$self_component.table")
        </div>
    </div>
    @include("$self_component.create")
    @include("$self_component.show")
    @include("$self_component.follow")
    @include("case_binnacle.show")
    @include("case_binnacle.create")
    @include("case_binnacle.edit")
    @include("binnacle_image.create")


    <input type="hidden" id="txt_view_binnacle_images_route" value="{{ route('binnacle_images_index') }}" />
</div>