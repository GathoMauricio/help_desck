<div class="modal fade" id="case_follow_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Seguimiento del caso
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body comment-box-modal" id="CaseFollowBox">
            </div>
            <div class="modal-footer">
                <input type="hidden" id="txt_index_case_follow" value="{{ route('index_case_follow') }}">
                <input type="hidden" id="txt_store_case_follow" value="{{ route('store_case_follow') }}">
                <form action="" id="form_store_case_follow" style='width: 100%' class="form"  method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden"  name="case_id" id="txt_case_id_follow"/>
                                <input type="text" id="txt_body_case_follow" name="body" class="form-control"
                                    placeholder="Escriba aqui su comentario..." />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">

.comment-box-modal::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px #37a9c5;
    border-radius: 10px;
    background-color: #F5F5F5;
}

.comment-box-modal::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
}

.comment-box-modal::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
    background-color: #37a9c5;
    ;
}
.comment-item {
    width: 100%;
    background-color: white;
    border-radius: 5px;
    padding: 10px;
}
.comment-box-modal{
    background:url({{ asset('img/restaurant_wallpaper.jpg')}});
    width: 100%;
    height: 400px;
    overflow: hidden;
    overflow-y:scroll;
}
</style>