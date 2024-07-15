document.addEventListener("DOMContentLoaded", function () {
    // Cargar artículos y proveedores al abrir el modal de edición
    document.querySelectorAll(".btn-edit").forEach((button) => {
        button.addEventListener("click", function () {
            const compraId = this.getAttribute("data-id");
            fetch(`/compras/${compraId}/edit`)
                .then((response) => response.json())
                .then((data) => {
                    const compra = data.compra;
                    const articulos = data.articulos;
                    const proveedores = data.proveedores;

                    document.getElementById("edit_comp_id").value =
                        compra.comp_id;
                    document.getElementById("edit_comp_numfac").value =
                        compra.comp_numfac;
                    document.getElementById("edit_comp_cantidad").value =
                        compra.comp_cantidad;
                    document.getElementById("edit_com_detalles").value =
                        compra.com_detalles;

                    const artSelect = document.getElementById("edit_art_id");
                    artSelect.innerHTML = "";
                    articulos.forEach((articulo) => {
                        const option = document.createElement("option");
                        option.value = articulo.art_id;
                        option.text = articulo.art_nombre;
                        option.selected = articulo.art_id === compra.art_id;
                        artSelect.appendChild(option);
                    });

                    const proSelect = document.getElementById("edit_pro_id");
                    proSelect.innerHTML = "";
                    proveedores.forEach((proveedor) => {
                        const option = document.createElement("option");
                        option.value = proveedor.pro_id;
                        option.text = proveedor.pro_nombre;
                        option.selected = proveedor.pro_id === compra.pro_id;
                        proSelect.appendChild(option);
                    });

                    document.getElementById("editCompraModal").showModal();
                });
        });
    });

    // Manejar el envío del formulario de edición
    document
        .getElementById("editCompraForm")
        .addEventListener("submit", function (event) {
            event.preventDefault();
            const compraId = document.getElementById("edit_comp_id").value;
            const formData = new FormData(this);

            fetch(`/compras/${compraId}`, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "X-HTTP-Method-Override": "PUT",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        location.reload(); // Recargar la página para reflejar los cambios
                    } else {
                        // Manejar errores
                        console.error(data.message);
                    }
                })
                .catch((error) => console.error("Error:", error));
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
                    fetch(`/compras/${id}`, {
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

    // Manejar el modal de reportes
    const reportModal = document.getElementById("reportModal");
    const reportBtn = document.getElementById("reportComprasBtn");
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
        window.location.href = "/reportcompras/excel";
    });

    pdfBtn.addEventListener("click", function () {
        window.location.href = "/reportcompras/pdf";
    });
});
