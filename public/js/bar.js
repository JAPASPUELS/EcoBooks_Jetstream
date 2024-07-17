document.addEventListener("DOMContentLoaded", function() {
    const loadingScreen = document.getElementById('loading-screen');

    // Mostrar la pantalla de carga al cargar la página
    loadingScreen.classList.add('show');

    // Ocultar la pantalla de carga después de que todo el contenido se haya cargado
    window.addEventListener('load', function() {
        loadingScreen.classList.remove('show');
    });

    // Mostrar la pantalla de carga antes de redireccionar
    const showLoadingScreen = (url) => {
        loadingScreen.classList.add('show');
        setTimeout(() => {
            window.location.href = url;
        }, 500); // Ajusta el tiempo según la duración de tu transición
    };

    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            e.stopPropagation(); // Evitar que el clic en la flecha afecte otros elementos
            let arrowParent = e.target.closest('li'); // selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");

            // Guardar o eliminar el módulo desplegado en localStorage
            if (arrowParent.classList.contains("showMenu")) {
                localStorage.setItem('activeModule', arrowParent.id);
                arrowParent.classList.add('active');
            } else {
                localStorage.removeItem('activeModule');
                arrowParent.classList.remove('active');
            }
        });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");

    // Recuperar el estado de la barra lateral de localStorage
    if (localStorage.getItem('sidebarState') === 'close') {
        sidebar.classList.add('close');
    } else {
        sidebar.classList.remove('close');
    }

    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");

        // Guardar el estado de la barra lateral en localStorage
        if (sidebar.classList.contains('close')) {
            localStorage.setItem('sidebarState', 'close');
        } else {
            localStorage.setItem('sidebarState', 'open');
        }
    });

    // Añadir evento de clic a los módulos y submódulos de la barra lateral
    let menuItems = document.querySelectorAll('.nav-links li');
    menuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            let clickedItem = e.target.closest('li');
            if (clickedItem) {
                // Quitar clase active de otros elementos
                document.querySelector('.nav-links li.active')?.classList.remove('active');
                document.querySelector('.nav-links li .sub-menu li.active')?.classList.remove('active');

                // Añadir clase active al módulo clicado
                if (clickedItem.querySelector('.sub-menu')) {
                    clickedItem.classList.add('active');
                    clickedItem.classList.toggle('showMenu');

                    // Guardar el módulo activo en localStorage
                    if (clickedItem.classList.contains('showMenu')) {
                        localStorage.setItem('activeModule', clickedItem.id);
                    } else {
                        localStorage.removeItem('activeModule');
                        clickedItem.classList.remove('active');
                    }
                } else {
                    clickedItem.classList.add('active');

                    // Guardar el submódulo activo en localStorage
                    let parentModule = clickedItem.closest('li.showMenu');
                    if (parentModule) {
                        localStorage.setItem('activeModule', parentModule.id);
                    }

                    // Mostrar la pantalla de carga antes de redireccionar
                    if (e.target.tagName === 'A' && !clickedItem.querySelector('.sub-menu')) {
                        e.preventDefault();
                        showLoadingScreen(e.target.href);
                    }
                }
            }
        });
    });

    // Recuperar el módulo activo de localStorage
    let activeModule = localStorage.getItem('activeModule');
    if (activeModule) {
        let activeElement = document.getElementById(activeModule);
        if (activeElement) {
            activeElement.classList.add('active');
            activeElement.classList.add('showMenu');
        }
    }
});