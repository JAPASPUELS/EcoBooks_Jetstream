document.addEventListener("DOMContentLoaded", function () {
    const body = document.querySelector("body"),
        sidebar = body.querySelector("nav"),
        toggle = body.querySelector(".toggle"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");

    // Verifica el estado de 'dark mode' en localStorage
    if (localStorage.getItem("dark-mode") === "enabled") {
        body.classList.add("dark");
        modeText.innerText = "Modo claro";
    }

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Modo claro";
            localStorage.setItem("dark-mode", "enabled");
        } else {
            modeText.innerText = "Modo oscuro";
            localStorage.setItem("dark-mode", "disabled");
        }
    });
});
