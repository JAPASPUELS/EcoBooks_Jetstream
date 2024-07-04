document.addEventListener('DOMContentLoaded', function() {
    // Manejar el clic en el botón de editar
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            // Realizar una solicitud AJAX para obtener los datos del proveedor
            fetch(`/proveedores/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Llenar el formulario con los datos del proveedor
                    document.getElementById('edit_pro_id').value = data.pro_id;
                    document.getElementById('edit_pro_nombre').value = data.pro_nombre;
                    document.getElementById('edit_pro_apellido').value = data.pro_apellido;
                    document.getElementById('edit_direccion_pro').value = data.direccion_pro;
                    document.getElementById('edit_pro_email').value = data.pro_email;
                    document.getElementById('edit_pro_telefono1').value = data.pro_telefono1;
                    document.getElementById('edit_pro_telefono2').value = data.pro_telefono2;
                    // Mostrar el modal y evitar el scroll del cuerpo
                    document.getElementById('editProveedorModal').showModal();
                    document.body.classList.add('modal-open');
                });
        });
    });

    // Manejar la actualización del proveedor
    document.getElementById('editProveedorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit_pro_id').value;
        const formData = new FormData(this);
        fetch(`/proveedores/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'PUT' // Override method to PUT
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('editProveedorModal').close();
            document.body.classList.remove('modal-open');
            if(data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: data.message,
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    location.reload(); // Recargar la página para reflejar los cambios
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });

    // Manejar el clic en el botón de eliminar
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/proveedores/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-HTTP-Method-Override': 'DELETE' // Override method to DELETE
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: data.message,
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                location.reload(); // Recargar la página para reflejar los cambios
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    });
                }
            });
        });
    });

    // Cerrar el modal y permitir el scroll del cuerpo cuando se cierre
    document.getElementById('editProveedorModal').addEventListener('close', function() {
        document.body.classList.remove('modal-open');
    });
});
