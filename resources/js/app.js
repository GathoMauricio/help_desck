require('./bootstrap');
let current_case_id = 0;
$(() => {
    $("#form_store_case_follow").on('submit', e => {
        e.preventDefault();
        let body = $("#txt_body_case_follow").val();
        if (body.length > 0) {
            $.ajax({
                type: "GET",
                url: $("#txt_store_case_follow").val(),
                data: $("#form_store_case_follow").serialize(),
                success: data => {
                    $("#form_store_case_follow")[0].reset();
                    $("#CaseFollowBox").html('');
                    let counter = 0;
                    $.each(data, function(index, value) {
                        counter++;
                        $("#CaseFollowBox").append(
                            '<div class="comment-item">' +
                            '<label class="color-primary-sys font-weight-bold">' +
                            value.author +
                            "</label>" +
                            "<br/>" +
                            value.body +
                            "<br/>" +
                            '<span class="font-weight-bold float-right">' +
                            value.created_at +
                            "</span>" +
                            "<br/>" +
                            "</div><br/>"
                        );
                    });
                    setTimeout(() => {
                        $("#CaseFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                            500
                        );
                    }, 500);
                },
                error: err => console.error(err)
            });
        }
    });

});

//Cliente => servidor

window.createUser = () => $("#modal_create_user").modal();
window.createCompany = () => $("#modal_create_company").modal();
window.createCompanyBranchbyId = () => $("#modal_create_company_branch_by_id").modal();
window.createCompanyBranch = () => $("#modal_create_company_branch").modal();
window.createCase = () => $("#modal_create_case").modal();
window.createArea = () => $("#modal_create_area").modal();
window.createType = () => $("#modal_create_type").modal();
window.createCategory = () => $("#modal_create_category").modal();
window.createSymptom = () => $("#modal_create_symptom").modal();
window.createSuggestion = () => $("#modal_create_suggestion").modal();
window.createCaseBinnacle = () => $("#modal_create_case_binnacle").modal();
window.destroy = id => {
    alertify.confirm("",
            function() {
                Livewire.emit('destroy', id);
            },
            function() {
                //alertify.error('Cancel');
            })
        .set('labels', { ok: 'Si, eliminar!', cancel: 'Cancelar' })
        .set({ transition: 'flipx', title: 'Alerta', message: '¿Eliminar registro?' });
};

window.destroyBinnacle = id => {
    alertify.confirm("",
            function() {
                Livewire.emit('destroyBinnacle', id);
            },
            function() {
                //alertify.error('Cancel');
            })
        .set('labels', { ok: 'Si, eliminar!', cancel: 'Cancelar' })
        .set({ transition: 'flipx', title: 'Alerta', message: '¿Eliminar registro?' });
};

window.updateFollowBox = id => {
    $("#txt_case_id_follow").val(id);
    $.ajax({
        type: 'GET',
        url: $("#txt_index_case_follow").val() + '/' + id,
        data: {},
        success: data => {
            $("#CaseFollowBox").html('');
            let counter = 0;
            $.each(data, function(index, value) {
                counter++;
                $("#CaseFollowBox").append(
                    '<div class="comment-item">' +
                    '<label class="color-primary-sys font-weight-bold">' +
                    value.author +
                    "</label>" +
                    "<br/>" +
                    value.body +
                    "<br/>" +
                    '<span class="font-weight-bold float-right">' +
                    value.created_at +
                    "</span>" +
                    "<br/>" +
                    "</div><br/>"
                );
            });
            setTimeout(() => {
                $("#CaseFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    500
                );
            }, 500);
        },
        error: err => console.log(err)
    });
};



window.caseFollow = id => {
    current_case_id = id;
    $("#txt_case_id_follow").val(id);
    $.ajax({
        type: 'GET',
        url: $("#txt_index_case_follow").val() + '/' + id,
        data: {},
        success: data => {
            $("#CaseFollowBox").html('');
            let counter = 0;
            $.each(data, function(index, value) {
                counter++;
                $("#CaseFollowBox").append(
                    '<div class="comment-item">' +
                    '<label class="color-primary-sys font-weight-bold">' +
                    value.author +
                    "</label>" +
                    "<br/>" +
                    value.body +
                    "<br/>" +
                    '<span class="font-weight-bold float-right">' +
                    value.created_at +
                    "</span>" +
                    "<br/>" +
                    "</div><br/>"
                );
            });
            setTimeout(() => {
                $("#CaseFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                    500
                );
            }, 500);
            if (counter <= 0) {
                $("#CaseFollowBox").html(
                    '<center><span style="background-color:#F7DC6F;padding:5px;border-radius:3px;" class="text-center font-weight-bold">' +
                    "Aún no se han agregado seguimientos" +
                    "</span></center>"
                );
            }

        },
        error: err => console.log(err)
    });
    $("#case_follow_modal").modal();
};

window.recargarSeguimientos = pusher_id => {
    if(current_case_id > 0 && current_case_id == pusher_id) {
        document.getElementById('ws_open').play();
        $.ajax({
            type: 'GET',
            url: $("#txt_index_case_follow").val() + '/' + pusher_id,
            data: {},
            success: data => {
                $("#CaseFollowBox").html('');
                let counter = 0;
                $.each(data, function(index, value) {
                    counter++;
                    $("#CaseFollowBox").append(
                        '<div class="comment-item">' +
                        '<label class="color-primary-sys font-weight-bold">' +
                        value.author +
                        "</label>" +
                        "<br/>" +
                        value.body +
                        "<br/>" +
                        '<span class="font-weight-bold float-right">' +
                        value.created_at +
                        "</span>" +
                        "<br/>" +
                        "</div><br/>"
                    );
                });
                setTimeout(() => {
                    $("#CaseFollowBox").animate({ scrollTop: $(document).height() * 10000 },
                        500
                    );
                }, 500);
            },
            error: err => console.log(err)
        });
    }
};

window.takeCase = case_id => {
    alertify.confirm("",
            function() {
                Livewire.emit('takeCase', case_id);
            },
            function() {
                //alertify.error('Cancel');
            })
        .set('labels', { ok: 'Si, quiero tomar el caso!', cancel: 'Cancelar' })
        .set({ transition: 'flipx', title: 'Alerta', message: '¿Tomar este caso?' });
};

window.msg = text => {
    alertify
        .alert(text, function() {
            alertify.message('OK');
        });
};

window.successNotification = text => {
    alertify.success(text);
};
window.errorNotification = text => {
    alertify.error(text);
};
//-------------------------------------------------------------------------------------------------------------------------------------------
//Servidor => cliente
Livewire.on('showCaseBinnacles',() =>$("#modal_show_case_binnacles").modal());
Livewire.on('createBinnacleImageModal',() =>$("#modal_create_binnacle_image").modal())

Livewire.on('editUser', () => $("#modal_edit_user").modal());
Livewire.on('editCompany', () => $("#modal_edit_company").modal());
Livewire.on('editCompanyBranch', () => $("#modal_edit_company_branch").modal());
Livewire.on('editArea', () => $("#modal_edit_area").modal());
Livewire.on('editType', () => $("#modal_edit_type").modal());
Livewire.on('editCategory', () => $("#modal_edit_category").modal());
Livewire.on('editSymptomp', () => $("#modal_edit_symptom").modal());
Livewire.on('editSuggestion', () => $("#modal_edit_suggestion").modal());
Livewire.on('editCaseBinnacle', () => $("#modal_edit_case_binnacle").modal());

Livewire.on('showCaseModal', () => $("#modal_show_case").modal());

Livewire.on('dismissCreateUserModal', () => $("#modal_create_usuario").modal('hide'));
Livewire.on('dismissCreateCompanyModal', () => $("#modal_create_company").modal('hide'));
Livewire.on('dismissCreateCompanyBranchModal', () => {
    $("#modal_create_company_branch").modal('hide');
    $("#modal_create_company_branch_by_id").modal('hide');
});
Livewire.on('dismissCreateCaseModal', () => $("#modal_create_case").modal('hide'));
Livewire.on('dismissCreateAreaModal', () => $("#modal_create_area").modal('hide'));
Livewire.on('dismissCreateTypeModal', () => $("#modal_create_type").modal('hide'));
Livewire.on('dismissCreateCategoryModal', () => $("#modal_create_category").modal('hide'));
Livewire.on('dismissCreateSymtomModal', () => $("#modal_create_symptom").modal('hide'));
Livewire.on('dismissCreateSuggestionModal', () => $("#modal_create_suggestion").modal('hide'));

Livewire.on('dismissEditUserModal', () => $("#modal_edit_usuario").modal('hide'));
Livewire.on('dismissEditCompanyModal', () => $("#modal_edit_company").modal('hide'));
Livewire.on('dismissEditCompanyBranchModal', () => $("#modal_edit_company_branch").modal('hide'));
Livewire.on('dismissEditAreaModal', () => $("#modal_edit_area").modal('hide'));
Livewire.on('dismissEditTypeModal', () => $("#modal_edit_type").modal('hide'));
Livewire.on('dismissEditCategoryModal', () => $("#modal_edit_category").modal('hide'));
Livewire.on('dismissEditSymptomModal', () => $("#modal_edit_symptom").modal('hide'));
Livewire.on('dissmisCreateCaseBinnacle',() => $("#modal_create_case_binnacle").modal('hide'));
Livewire.on('dissmisEditCaseBinnacle',() => $("#modal_edit_case_binnacle").modal('hide'));

Livewire.on('dissmisCreateBinnacleImage',() => $("#modal_create_binnacle_image").modal('hide'))

Livewire.on('msg', (text) => {
    alertify
        .alert(text, function() {
            alertify.message('OK');
        });
});

Livewire.on('successNotification', (text) => {
    alertify.success(text);
});

Livewire.on('errorNotification', (text) => {
    alertify.error(text);
});

window.viewBinnacleImages = (binnacle_id, count) => {
    if (count > 0) {
        const route = $("#txt_view_binnacle_images_route").val();
        let viewer = new PhotoViewer();
        viewer.disableEmailLink();
        viewer.enableLoop();
        viewer.enableAutoPlay();
        viewer.setFontSize(16);
        const show_binnacle_image = $("#txt_show_binnacle_image_route").val();
        /*
        viewer.permalink = () => {
            window.open(show_binnacle_image + '/' + $("#PhotoViewerByline").text());
        };
        */
        $.ajax({
            type: 'GET',
            url: route + '/' + binnacle_id,
            data: {},
            success: data => {
                console.log(data);
                $.each(data, (index, item) => {
                    viewer.add(item.url, item.description, item.date, '' + item.id);
                });
                viewer.show(0);
            },
            error: error => console.log(error)
        });

    } else {
        errorNotification("No hay imagenes para mostrar");
    }

};