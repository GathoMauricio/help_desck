require('./bootstrap');
//Cliente => servidor

window.createUser = () => $("#modal_create_usuario").modal();
window.createCompany = () => $("#modal_create_company").modal();
window.createCompanyBranchbyId = () => $("#modal_create_company_branch_by_id").modal();
window.createCompanyBranch = () => $("#modal_create_company_branch").modal();
window.createCase = () => $("#modal_create_case").modal();

window.deleteUser = id => {
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
window.deleteCompany = id => {
    console.log("Eliminar")
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

window.deleteCompanyBranch = id => {
    console.log("Eliminar")
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
Livewire.on('editUser', () => $("#modal_edit_usuario").modal());
Livewire.on('editCompany', () => $("#modal_edit_company").modal());
Livewire.on('editCompanyBranch', () => $("#modal_edit_company_branch").modal());

Livewire.on('dismissCreateUserModal', () => $("#modal_create_usuario").modal('hide'));
Livewire.on('dismissCreateCompanyModal', () => $("#modal_create_company").modal('hide'));
Livewire.on('dismissCreateCompanyBranchModal', () => {
    $("#modal_create_company_branch").modal('hide');
    $("#modal_create_company_branch_by_id").modal('hide');
});
Livewire.on('dismissCreateCaseModal', () => $("#modal_create_case").modal('hide'));

Livewire.on('dismissEditUserModal', () => $("#modal_edit_usuario").modal('hide'));
Livewire.on('dismissEditCompanyModal', () => $("#modal_edit_company").modal('hide'));
Livewire.on('dismissEditCompanyBranchModal', () => $("#modal_edit_company_branch").modal('hide'));



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