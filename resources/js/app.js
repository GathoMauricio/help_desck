require('./bootstrap');
//Cliente => servidor

//Muestra el modal para crear un nuevo registro
window.createUser = () => $("#modal_create_usuario").modal();
//Muestra un mensaje de confirmación para eliminar un registro
window.deleteUser = user_id => {
    if (confirm("Eliminar usuario")) {
        //Invoca la funcion destroy del componente cuando el usuario confirma la eliminación
        Livewire.emit('destroy', user_id);
    }
};
//-------------------------------------------------------------------------------------------------------------------------------------------
//Servidor => cliente

//Muestar modal de editar usuario despues de haber almacenado el id en el componente
Livewire.on('editUser', $("#modal_edit_usuario").modal());

//Oculta el modal de crear usuario una vez que el componente creao el registro
Livewire.on('dismissCreateUserModal', () => $("#modal_create_usuario").modal('hide'));



//Muestar un mensaje en la ventana del navegador con la respuesta del servidor
Livewire.on('msg', msg => alert(msg));