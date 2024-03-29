<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php 
                    if ($_SESSION["foto"] != "") {
                        echo '<img src="'.$_SESSION["foto"].'" class="img-circle elevation-2" alt="User Image">';
                    } else {
                        echo '<img src="public/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">';
                    }
                ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["nombre"]; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <?php
                    if ($_SESSION["perfil"] == "Administrador") {
                        echo '
                            <li class="nav-item">
                                <a href="inicio" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Inicio
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="usuarios" class="nav-link">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>
                                        Usuarios
                                    </p>
                                </a>
                            </li>
                        ';
                    }
                
                    if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {
                        echo '
                            <li class="nav-item">
                                <a href="categorias" class="nav-link">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Categorías
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="productos" class="nav-link">
                                    <i class="nav-icon fas fa-boxes"></i>
                                    <p>
                                        Productos
                                    </p>
                                </a>
                            </li>
                        ';
                    }

                    if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
                        echo '
                            <li class="nav-item">
                                <a href="clientes" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Clientes
                                    </p>
                                </a>
                            </li>
                        ';
                    }
                
                    if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
                        echo '
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Ventas
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="ventas" class="nav-link">
                                            <i class="fas fa-file-signature nav-icon"></i>
                                            <p>
                                                Administrar Ventas
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="crear-venta" class="nav-link">
                                            <i class="fas fa-cart-plus nav-icon"></i>
                                            <p>
                                                Crear Venta
                                            </p>
                                        </a>
                                    </li>';
                                    if ($_SESSION["perfil"] == "Administrador") {
                                        echo '
                                            <li class="nav-item">
                                                <a href="reportes" class="nav-link">
                                                    <i class="fas fa-chart-line nav-icon"></i>
                                                    <p>
                                                        Reporte de Ventas
                                                    </p>
                                                </a>
                                            </li>
                                        ';
                                    }
                                echo '</ul>
                            </li>';          
                    }
                ?>
                <li class="nav-item">
                    <a href="salir" class="nav-link" role="button">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Salir
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
