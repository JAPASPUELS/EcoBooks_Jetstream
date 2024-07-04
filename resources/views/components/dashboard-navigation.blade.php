<div class="sidebar close">
    <div class="logo-details">
        <img src="/favicons/favicon.ico" alt="EcoBooks Logo">
        <span class="logo_name">EcoBooks</span>
    </div>
    <ul class="nav-links">
        <li id="dashboard">
            <a href="{{ route('dashboard') }}">
                <i class='fas fa-home icon' style="color: #4CAF50;"></i>
                <span class="link_name">Inicio</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Inicio</a></li>
            </ul>
        </li>
        <li id="ventas">
            <div class="icon-link">
                <a>
                    <i class='fas fa-shopping-cart icon' style="color: #00BCD4;"></i>
                    <span class="link_name">Ventas</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Category</a></li>
                <li><a id="ventas-create" href="{{ route('ventas.create') }}">Registrar Venta</a></li>
                <li><a id="ventas-index" href="{{ route('ventas.index') }}">Historial de Ventas</a></li>
            </ul>
        </li>
        <li id="inventario">
            <div class="icon-link">
                <a href="#">
                    <i class='fas fa-boxes icon' style="color: #FF9800;"></i>
                    <span class="link_name">Inventario</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Category</a></li>
                <li><a id="inventario-create" href="#">Registrar Producto</a></li>
                <li><a id="inventario-update" href="#">Modificar Producto</a></li>
                <li><a id="inventario-report" href="#">Reporte Productos</a></li>
            </ul>
        </li>
        <li id="clientes">
            <div class="icon-link">
                <a href="#">
                    <i class='fas fa-users icon' style="color: #03A9F4;"></i>
                    <span class="link_name">Clientes</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Category</a></li>
                <li><a id="clientes-create" href="#">Registrar Cliente</a></li>
                <li><a id="clientes-update" href="#">Modificar Cliente</a></li>
                <li><a id="clientes-report" href="#">Reporte Clientes</a></li>
            </ul>
        </li>
        <li id="proveedores">
            <div class="icon-link">
                <a>
                    <i class='fas fa-truck icon' style="color: #9C27B0;"></i>
                    <span class="link_name">Proveedores</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Category</a></li>
                <li><a id="proveedores-create" href="{{ route('proveedores.create') }}">Registrar Proveedor</a></li>
                <li><a id="proveedores-update" href="{{ route('proveedores.index') }}">Modificar Proveedor</a></li>
                <li><a id="proveedores-report" href="#">Reporte Proveedores</a></li>
            </ul>
        </li>

        <li id="auditoria">
            <a href="{{ route('auditoria.index') }}">
                <i class='fas fa-clipboard-check icon' style="color: #FF5722;"></i>
                <span class="link_name">Auditoría</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('auditoria.index') }}">Auditoría</a></li>
            </ul>
        </li>
        <li id="perfil">
            <a href="{{ url('user/profile') }}">
                <i class='fas fa-user icon' style="color: #E91E63;"></i>
                <span class="link_name">Perfil</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Perfil</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='fas fa-sign-out-alt' style="color: #F44336;"></i>
                    <span class="link_name">Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

        </li>
    </ul>
</div>