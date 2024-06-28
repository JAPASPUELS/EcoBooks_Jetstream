<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('favicons/favicon.ico') }}" alt="Logo">
            </span>

            <div class="text logo-text">
                <span class="name">EcoBooks</span>
                <span class="profession">Web Developer</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="separator"></div>
    
    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="{{ route('dashboard') }}">
                        <i class='fas fa-home icon' style="color: #4CAF50;"></i>
                        <span class="text nav-text">Inicio</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fas fa-shopping-cart icon' style="color: #00BCD4;"></i>
                        <span class="text nav-text">Ventas</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fas fa-boxes icon' style="color: #FF9800;"></i>
                        <span class="text nav-text">Inventario</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fas fa-users icon' style="color: #03A9F4;"></i>
                        <span class="text nav-text">Clientes</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fas fa-truck icon' style="color: #9C27B0;"></i>
                        <span class="text nav-text">Proveedores</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="#">
                        <i class='fas fa-clipboard-check icon' style="color: #FF5722;"></i>
                        <span class="text nav-text">Auditoría</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{ route('profile.show') }}">
                        <i class='fas fa-user icon' style="color: #E91E63;"></i>
                        <span class="text nav-text">Perfil</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='fas fa-sign-out-alt icon' style="color: #F44336;"></i>
                    <span class="text nav-text">Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Modo oscuro</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>