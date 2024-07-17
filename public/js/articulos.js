document.addEventListener("DOMContentLoaded", function () {
    // Manejar el clic en el botón de editar
    document.querySelectorAll(".btn-edit").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            // Realizar una solicitud AJAX para obtener los datos del artículo
            fetch(`/articulos/${id}/edit`)
                .then((response) => response.json())
                .then((data) => {
                    // Llenar el formulario con los datos del artículo
                    document.getElementById("edit_art_id").value =
                        data.articulo.art_id;
                    document.getElementById("edit_art_nombre").value =
                        data.articulo.art_nombre;
                    document.getElementById("edit_art_precio").value =
                        data.articulo.art_precio;
                    document.getElementById("edit_art_cantidad").value =
                        data.articulo.art_cantidad;
                    document.getElementById("edit_art_unidades").value =
                        data.articulo.art_unidades;

                    // Llenar el select de categorías
                    const catSelect = document.getElementById("edit_cat_id");
                    catSelect.innerHTML = ""; // Limpiar opciones anteriores
                    data.categorias.forEach((categoria) => {
                        const option = document.createElement("option");
                        option.value = categoria.cat_id;
                        option.text = categoria.cat_name;
                        if (categoria.cat_id === data.articulo.cat_id) {
                            option.selected = true;
                        }
                        catSelect.appendChild(option);
                    });

                    // Mostrar el modal y evitar el scroll del cuerpo
                    document.getElementById("editArticuloModal").showModal();
                    document.body.classList.add("modal-open");
                });
        });
    });

    // Manejar la actualización del artículo
    document
        .getElementById("editArticuloForm")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            const id = document.getElementById("edit_art_id").value;
            const formData = new FormData(this);
            fetch(`/articulos/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "X-HTTP-Method-Override": "PUT", // Override method to PUT
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById("editArticuloModal").close();
                    document.body.classList.remove("modal-open");
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "¡Actualizado!",
                            text: data.message,
                            confirmButtonText: "Aceptar",
                        }).then(() => {
                            location.reload(); // Recargar la página para reflejar los cambios
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.message,
                            confirmButtonText: "Aceptar",
                        });
                    }
                });
        });

    // Manejar el clic en el botón de eliminar
    document.querySelectorAll(".btn-delete").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            Swal.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esto",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminarlo",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/articulos/${id}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "X-HTTP-Method-Override": "DELETE", // Override method to DELETE
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "¡Eliminado!",
                                    text: data.message,
                                    confirmButtonText: "Aceptar",
                                }).then(() => {
                                    location.reload(); // Recargar la página para reflejar los cambios
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: data.message,
                                    confirmButtonText: "Aceptar",
                                });
                            }
                        });
                }
            });
        });
    });

    // Manejar el clic en el botón de cambiar estado
    document.querySelectorAll(".btn-status").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const estado = this.getAttribute("data-estado");
            Swal.fire({
                title: "¿Estás seguro?",
                text: `¿Deseas cambiar el estado a ${
                    estado == 1 ? "inactivo" : "activo"
                }?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sí, cambiarlo",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/articulos/${id}/toggle-status`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                            "X-HTTP-Method-Override": "PATCH", // Override method to PATCH
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "¡Estado cambiado!",
                                    text: data.message,
                                    confirmButtonText: "Aceptar",
                                }).then(() => {
                                    location.reload(); // Recargar la página para reflejar los cambios
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: data.message,
                                    confirmButtonText: "Aceptar",
                                });
                            }
                        });
                }
            });
        });
    });

    // Cerrar el modal y permitir el scroll del cuerpo cuando se cierre
    document
        .getElementById("editArticuloModal")
        .addEventListener("close", function () {
            document.body.classList.remove("modal-open");
        });

    // Reportes
    const reportModal = document.getElementById("reportModal");
    const reportBtn = document.getElementById("reportArticulosBtn");
    const closeReportModalBtn = document.getElementById("closeReportModal");
    const excelBtn = document.getElementById("excelBtn");
    const pdfBtn = document.getElementById("pdfBtn");

    reportBtn.addEventListener("click", function () {
        reportModal.classList.remove("hidden");
    });

    closeReportModalBtn.addEventListener("click", function () {
        reportModal.classList.add("hidden");
    });

    excelBtn.addEventListener("click", function () {
        // Aquí puedes redirigir a la ruta de generación de reporte Excel
        window.location.href = "/reportart/excel";
    });

    pdfBtn.addEventListener("click", function () {
        // Aquí puedes redirigir a la ruta de generación de reporte PDF
        window.location.href = "/reportart/pdf";
    });
});
