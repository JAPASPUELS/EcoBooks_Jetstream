document.addEventListener('DOMContentLoaded', function() {
    // Manejar el clic en el botón de editar
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            // Realizar una solicitud AJAX para obtener los datos del cliente
            fetch(`/clientes/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Llenar el formulario con los datos del cliente
                    document.getElementById('edit_cli_id').value = data.cli_codigo;
                    document.getElementById('edit_cli_codigo').value = data.cli_codigo;
                    document.getElementById('edit_cli_nombre').value = data.cli_nombre;
                    document.getElementById('edit_cli_apellido').value = data.cli_apellido;
                    document.getElementById('edit_cli_correo').value = data.cli_correo;
                    document.getElementById('edit_cli_direccion').value = data.cli_direccion;
                    document.getElementById('edit_cli_identificacion').value = data.cli_identificacion;
                    // Mostrar el modal y evitar el scroll del cuerpo
                    document.getElementById('editClienteModal').showModal();
                    document.body.classList.add('modal-open');
                });
        });
    });

    // Manejar la actualización del cliente
    document.getElementById('editClienteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit_cli_id').value;
        const formData = new FormData(this);
        fetch(`/clientes/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'PUT' // Override method to PUT
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('editClienteModal').close();
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
                    fetch(`/clientes/${id}`, {
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
    document.getElementById('editClienteModal').addEventListener('close', function() {
        document.body.classList.remove('modal-open');
    });
});
