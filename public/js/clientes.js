document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/clientes/${id}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit_cli_codigo').value = data.cli_codigo;
                    document.getElementById('edit_cli_nombre').value = data.cli_nombre;
                    document.getElementById('edit_cli_apellido').value = data.cli_apellido;
                    document.getElementById('edit_cli_correo').value = data.cli_correo;
                    document.getElementById('edit_cli_direccion').value = data.cli_direccion;
                    document.getElementById('edit_cli_identificacion').value = data.cli_identificacion;
                    document.getElementById('editClienteModal').showModal();
                    document.body.classList.add('modal-open');
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudieron cargar los datos del cliente',
                        confirmButtonText: 'Aceptar'
                    });
                });
        });
    });

    document.getElementById('editClienteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit_cli_codigo').value;
        const formData = new FormData(this);
        fetch(`/clientes/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'PUT' // Override method to PUT
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('editClienteModal').close();
            document.body.classList.remove('modal-open');
            if (data.success) {
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
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo actualizar el cliente',
                confirmButtonText: 'Aceptar'
            });
        });
    });

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
                            'X-HTTP-Method-Override': 'DELETE'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: data.message,
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar el cliente',
                            confirmButtonText: 'Aceptar'
                        });
                    });
                }
            });
        });
    });

    document.getElementById('editClienteModal').addEventListener('close', function() {
        document.body.classList.remove('modal-open');
    });
});
