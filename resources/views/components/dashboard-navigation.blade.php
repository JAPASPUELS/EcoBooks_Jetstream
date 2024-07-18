<div class="sidebar close">
    <div class="logo-details">
        <img src="/favicons/favicon.ico" alt="EcoBooks Logo">
        <span class="logo_name">EcoBooks</span>
    </div>

    <ul class="nav-links">
        <li id="dashboard">
            <a href="{{ route('dashboard') }}">
                <i class='fas fa-home icon' style="color: #03A9F4;"></i>
                <span class="link_name">Inicio</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Inicio</a></li>
            </ul>
        </li>
        <a class="delimiter pl-10 border-t-2 mt-1" style="background-color: #B9E3C5; border-top-color: #B9E3C5;">
            {{-- <i class='fas fa-shopping-cart icon ml-5' style="color: #03A9F4;"></i> --}}
            <span class="link_name" style="font-weight: bold; text-align: left; display: block;">Gestión Comercial</span>
        </a>
        @if (auth()->user()->permisos->contains('name_permission', 'Ventas'))
        <li id="ventas">
            <div class="icon-link">
                <a>
                    <i class='fas fa-shopping-cart icon' style="color: #03A9F4;"></i>
                    <span class="link_name">Ventas</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Ventas</a></li>
                <li><a id="ventas-create" href="{{ route('ventas.create') }}">Registrar Venta</a></li>
                <li><a id="ventas-index" href="{{ route('ventas.index') }}">Historial de Ventas</a></li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Articulos'))
        <li id="inventario">
            <div class="icon-link">
                <a>
                    <i class='fas fa-boxes icon' style="color: #03A9F4;"></i>
                    <span class="link_name">Articulos</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Articulos</a></li>
                <li><a id="inventario-create" href="{{ route('articulos.create') }}">Registrar Articulo</a></li>
                <li><a id="inventario-update" href="{{ route('articulos.index') }}">Modificar Articulo</a></li>

            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Categorias'))
        <li id="categoria">
            <a href="{{ route('categorias.index') }}">
                <i class='fas fa-tag icon' style="color: #03A9F4;"></i>
                <span class="link_name">Categorías</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('categorias.index') }}">Categorías</a></li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Formas de Pago'))
        <li id="formapago">
            <a href="{{ route('formaPago.index') }}">
                <i class='fas fa-credit-card icon' style="color: #03A9F4;"></i>
                <span class="link_name">Formas de Pago</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('formaPago.index') }}">Formas de Pago</a></li>
            </ul>
        </li>
        @endif

        @if (auth()->user()->permisos->contains('name_permission', 'Compras'))
        <a class="delimiter pl-10 border-t-2 mt-1" style="background-color: #B9E3C5; border-top-color: #B9E3C5;">
            {{-- <i class='fas fa-shopping-cart icon ml-5' style="color: #03A9F4;"></i> --}}
            <span class="link_name" style="font-weight: bold; text-align: left; display: block;">Gestión Financiera</span>
        </a>
        <li id="compras">
            <div class="icon-link">
                <a>
                    <i class='fas fa-shopping-bag icon' style="color: #03A9F4;"></i>
                    <span class="link_name">Compras</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Compras</a></li>
                <li><a id="compra-create" href="{{ route('compras.create') }}">Registrar Compra</a></li>
                <li><a id="compra-update" href="{{ route('compras.index') }}">Modificar Compras</a></li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Gastos'))
        <li id="gastos">
            <a href="{{ route('gastos.index') }}">
                <i class='fas fa-money-bill-wave icon' style="color: #03A9F4;"></i>
                <span class="link_name">Gastos</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('gastos.index') }}">Gastos</a></li>
            </ul>
        </li>
        @endif
        <a class="delimiter pl-10 border-t-2 mt-1" style="background-color: #B9E3C5; border-top-color: #B9E3C5;">
            {{-- <i class='fas fa-shopping-cart icon ml-5' style="color: #03A9F4;"></i> --}}
            <span class="link_name" style="font-weight: bold; text-align: left; display: block;">Gestión Inventario</span>
        </a>
        @if (auth()->user()->permisos->contains('name_permission', 'Inventario'))
        <li id="invprincipal">
            <a href="{{ route('inventario.index') }}">
                <i class='fas fa-box icon' style="color: #03A9F4;"></i>
                <span class="link_name">Inventario</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('inventario.index') }}">Inventario</a></li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Movimientos'))
        <li id="movimientos">
            <a href="{{ route('movimientos.index') }}">
                <i class='fas fa-exchange-alt icon' style="color: #03A9F4;"></i>
                <span class="link_name">Movimientos</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('movimientos.index') }}">Movimientos</a></li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Auditoria'))
        <li id="auditoria">
            <a href="{{ route('auditoria.index') }}">
                <i class='fas fa-clipboard-check icon' style="color: #03A9F4;"></i>
                <span class="link_name">Auditoría</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('auditoria.index') }}">Auditoría</a></li>
            </ul>
        </li>
        @endif
        <a class="delimiter pl-10 border-t-2 mt-1" style="background-color: #B9E3C5; border-top-color: #B9E3C5;">
            {{-- <i class='fas fa-shopping-cart icon ml-5' style="color: #03A9F4;"></i> --}}
            <span class="link_name" style="font-weight: bold; text-align: left; display: block;">Gestión Relaciones</span>
        </a>
        @if (auth()->user()->permisos->contains('name_permission', 'Clientes'))
        <li id="clientes">
            <div class="icon-link">
                <a>
                    <i class='fas fa-users icon' style="color: #03A9F4;"></i>
                    <span class="link_name">Clientes</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Clientes</a></li>
                <li><a id="clientes-create" href="{{ route('clientes.create') }}">Registrar Cliente</a></li>
                <li><a id="clientes-update" href="{{ route('clientes.index') }}">Modificar Cliente</a></li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->permisos->contains('name_permission', 'Proveedores'))
        <li id="proveedores">
            <div class="icon-link">
                <a>
                    <i class='fas fa-truck icon' style="color: #03A9F4;"></i>
                    <span class="link_name">Proveedores</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name">Proveedores</a></li>
                <li><a id="proveedores-create" href="{{ route('proveedores.create') }}">Registrar Proveedor</a>
                </li>
                <li><a id="proveedores-update" href="{{ route('proveedores.index') }}">Modificar Proveedor</a>
                </li>
            </ul>
        </li>
        @endif
        <a class="delimiter pl-10 border-t-2 mt-1" style="background-color: #B9E3C5; border-top-color: #B9E3C5;">
            {{-- <i class='fas fa-shopping-cart icon ml-5' style="color: #03A9F4;"></i> --}}
            <span class="link_name" style="font-weight: bold; text-align: left; display: block;">Gestión de Usuarios Roles</span>
        </a>
        @if (auth()->user()->permisos->contains('name_permission', 'Gestion Roles Usuarios'))
        <li id="roles">
            <div class="icon-link">
                <a>
                    <i class='bi bi-person-rolodex' style="color: #03A9F4;"></i>
                    <span class="link_name">Gestion Roles Usuarios</span>
                </a>
            </div>
            <ul class="sub-menu space-y-2">
                <li><a class="link_name">Gestión Roles Usuarios</a></li>
                <li class="flex items-center space-x-2">
                    <a href="{{ route('roles.index') }}">Gestión Roles</a>
                </li>
                <li class="flex items-center space-x-2">
                    {{-- <a href="{{ route('users.index') }}" >Gestión Usuarios Principales</a> --}}
                    <a href="#">Gestión Usuarios Principales</a>
                </li>
            </ul>

        </li>
        @endif



        <li id="perfil">
            <a href="{{ url('user/profile') }}">
                <i class='fas fa-user icon' style="color: #03A9F4;"></i>
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