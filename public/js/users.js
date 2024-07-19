document.addEventListener("DOMContentLoaded", function () {
    // Abrir y cerrar modal de crear nuevo usuario
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtns = document.querySelectorAll(
        "#closeModal, #closeModalBtn"
    );
    const userModal = document.getElementById("userModal");

    openModalBtn.addEventListener("click", function () {
        userModal.classList.remove("hidden");
    });

    closeModalBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            userModal.classList.add("hidden");
        });
    });

    // Abrir modal de editar rol
    document.querySelectorAll(".btn-edit-role").forEach((button) => {
        button.addEventListener("click", function () {
            const userId = this.getAttribute("data-id");
            const userRow = document.querySelector(`tr[data-id="${userId}"]`);
            const userName = userRow
                .querySelector("td:nth-child(1)")
                .textContent.trim();
            const userEmail = userRow
                .querySelector("td:nth-child(2)")
                .textContent.trim();
            const userRole = userRow
                .querySelector("td:nth-child(3)")
                .textContent.trim();

            document.getElementById("edit_user_id").value = userId;
            document.getElementById("edit_user_name").value = userName;
            document.getElementById("edit_user_email").value = userEmail;
            document.getElementById("edit_role_id").value = userRole;

            document.getElementById("editRoleModal").classList.remove("hidden");
        });
    });

    // Cerrar modal de editar rol
    document
        .getElementById("closeEditRoleModalBtn")
        .addEventListener("click", function () {
            document.getElementById("editRoleModal").classList.add("hidden");
        });

    document
        .getElementById("closeEditRoleModal")
        .addEventListener("click", function () {
            document.getElementById("editRoleModal").classList.add("hidden");
        });
});
