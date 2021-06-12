require('./bootstrap');
//Cliente => servidor

window.createUser = () => $("#modal_create_user").modal();
window.createCompany = () => $("#modal_create_company").modal();
window.createCompanyBranchbyId = () => $("#modal_create_company_branch_by_id").modal();
window.createCompanyBranch = () => $("#modal_create_company_branch").modal();
window.createCase = () => $("#modal_create_case").modal();
window.createArea = () => $("#modal_create_area").modal();
window.createType = () => $("#modal_create_type").modal();
window.createCategory = () => $("#modal_create_category").modal();
window.createSimptom = () => $("#modal_create_simptom").modal();
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
Livewire.on('editUser', () => $("#modal_edit_user").modal());
Livewire.on('editCompany', () => $("#modal_edit_company").modal());
Livewire.on('editCompanyBranch', () => $("#modal_edit_company_branch").modal());
Livewire.on('editArea', () => $("#modal_edit_area").modal());
Livewire.on('editType', () => $("#modal_edit_type").modal());
Livewire.on('editCategory', () => $("#modal_edit_category").modal());
Livewire.on('editSimptomp', () => $("#modal_edit_simptomp").modal());

Livewire.on('dismissCreateUserModal', () => $("#modal_create_usuario").modal('hide'));
Livewire.on('dismissCreateCompanyModal', () => $("#modal_create_company").modal('hide'));
Livewire.on('dismissCreateCompanyBranchModal', () => {
    $("#modal_create_company_branch").modal('hide');
    $("#modal_create_company_branch_by_id").modal('hide');
});
Livewire.on('dismissCreateCaseModal', () => $("#modal_create_case").modal('hide'));
Livewire.on('dismissCreateAreaModal', () => $("#modal_create_area").modal('hide'));
Livewire.on('dismissCreateTypeModal', () => $("#modal_create_type").modal('hide'));
Livewire.on('dismissCreateCategoryModal', () => $("#modal_create_type").modal('hide'));
Livewire.on('dismissCreateSimptompModal', () => $("#modal_create_type").modal('hide'));

Livewire.on('dismissEditUserModal', () => $("#modal_edit_usuario").modal('hide'));
Livewire.on('dismissEditCompanyModal', () => $("#modal_edit_company").modal('hide'));
Livewire.on('dismissEditCompanyBranchModal', () => $("#modal_edit_company_branch").modal('hide'));
Livewire.on('dismissEditAreaModal', () => $("#modal_edit_area").modal('hide'));
Livewire.on('dismissEditTypeModal', () => $("#modal_edit_type").modal('hide'));
Livewire.on('dismissEditCategoryModal', () => $("#modal_edit_type").modal('hide'));
Livewire.on('dismissEditSimptompModal', () => $("#modal_edit_type").modal('hide'));



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