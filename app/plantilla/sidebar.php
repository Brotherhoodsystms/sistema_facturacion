<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../views/index.php">
                <div class="sidebar-brand-icon rotate-n-4">
                    <i class="fa-brands fa-bimobject"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Brotherhood</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Dashboard
            </div>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwosa" aria-expanded="true" aria-controls="collapseTwosa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>

                <div id="collapseTwosa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Panel Dashboard</h6>
                        <a class="collapse-item" href="index.php">Punto de Venta</a>
                        <a class="collapse-item" href="dashboard-sales.php">Contabilidad</a>
                    </div>
                </div>


            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administración
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if (!empty($_SESSION['permisos'][ADMINISTRACION]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-warehouse"></i>
                        <span>Administración</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Administración</h6>
                            <?php if (!empty($_SESSION['permisos'][USUARIOS]['r'])) { ?>
                                <a class="collapse-item" href="../views/usuario.php">Usuarios</a><?php } ?>
                            <?php if (!empty($_SESSION['permisos'][ROLES]['r'])) { ?>
                                <a class="collapse-item" href="../views/rol.php">Roles</a><?php } ?>
                            <?php if (!empty($_SESSION['permisos'][SUCURSAL]['r'])) { ?>
                                <a class="collapse-item" href="../views/sucursal.php">Sucursal</a><?php } ?>

                            <?php if (!empty($_SESSION['permisos'][EMISOR]['r'])) { ?>
                                <a class="collapse-item" href="../views/emisor.php">Emisor</a><?php } ?>
                            <?php if (!empty($_SESSION['permisos'][ESTABLECIMIENTO]['r'])) { ?>
                                <a class="collapse-item" href="../views/establecimiento.php">Establecimiento</a><?php } ?>
                            <?php if (!empty($_SESSION['permisos'][PUNTO_EMISION]['r'])) { ?>
                                <a class="collapse-item" href="../views/puntoEmision.php">Punto Emision</a><?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>

            <!-- Nav Item - Utilities Collapse Menu -->
            <?php if (!empty($_SESSION['permisos'][INGRESO]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-people-carry"></i>
                        <span>Ingreso</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Ingreso</h6>
                            <?php if (!empty($_SESSION['permisos'][CLIENTE]['r'])) { ?>
                                <a class="collapse-item" href="../views/cliente.php">Clientes</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][INGRESO_PRODUCTO]['r'])) { ?>
                                <a class="collapse-item" href="../views/productos.php">Productos</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][PROVEEDOR]['r'])) { ?>
                                <a class="collapse-item" href="../views/proveedor.php">Proveedores</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][COMBOS]['r'])) { ?>
                                <a class="collapse-item" href="../views/combos.php">Combos</a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Inventario
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if (!empty($_SESSION['permisos'][INVENTARIO]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Inventario</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Inventario</h6>
                            <?php if (!empty($_SESSION['permisos'][INGRESO_PRODUCTOS]['r'])) { ?>
                                <a class="collapse-item" href="../views/producto.php">Ingreso Productos</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][EGRESO_PRODUCTO]['r'])) { ?>
                                <a class="collapse-item" href="../views/egresobodega.php">Egreso Productos</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][KARDEX]['r'])) { ?>
                                <a class="collapse-item" href="../views/kardex2.php">Kardex</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][BODEGA]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess" aria-expanded="true" aria-controls="collapsePagess">
                        <i class="fas fa-fw fa-truck"></i>
                        <span>Bodega</span>
                    </a>
                    <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Bodega</h6>
                            <?php if (!empty($_SESSION['permisos'][REGISTRO_BODEGA]['r'])) { ?>
                                <a class="collapse-item" href="../views/bodega.php">Registro de Bodega</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][CATEGORIA]['r'])) { ?>
                                <a class="collapse-item" href="../views/categoria.php">Categoria</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][CODIGO_BARRAS]['r'])) { ?>
                                <a class="collapse-item" href="../views/generarcodigo.php">Código de Barras</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>

            <!-- Nav Item - Charts -->
            <?php if (!empty($_SESSION['permisos'][CIERRES_CAJA]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
                        <i class="fa fa-suitcase"></i>
                        <span>Cierres Caja</span>
                    </a>
                    <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Caja</h6>
                            <?php if (!empty($_SESSION['permisos'][REGISTRO_CAJAS]['r'])) { ?>
                                <a class="collapse-item" href="../views/registrocaja.php">Registro Caja</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][REGISTRO_MOVIMIENTOS]['r'])) { ?>
                                <a class="collapse-item" href="../views/movimientoefectivo.php">Movimiento Efectivo</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][FINALIZACION_CAJA]['r'])) { ?>
                                <a class="collapse-item" href="../views/cierrecaja.php">Cierre Caja</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Factura
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if (!empty($_SESSION['permisos'][FACTURACION]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwow" aria-expanded="true" aria-controls="collapseTwow">
                        <i class="icon fas fa-money-bill-alt"></i>
                        <span>Facturación</span>
                    </a>
                    <div id="collapseTwow" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Facturación</h6>
                            <?php if (!empty($_SESSION['permisos'][PUNTO_VENTA]['r'])) { ?>
                                <a class="collapse-item" href="../views/venta.php">Punto de Venta</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][FACTURA]['r'])) { ?>
                                <a class="collapse-item" href="../views/facturaA.php">Factura</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][COMPROBANTE_SALIDA]['r'])) { ?>
                                <a class="collapse-item" href="../views/notaventa.php">Comprobante de Salida</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][RESERVA]['r'])) { ?>
                                <a class="collapse-item" href="../views/reserva.php">Reservas</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][PROFORMA]['r'])) { ?>
                                <a class="collapse-item" href="../views/proformaL.php">Proforma</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][CONTABILIDAD]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages12" aria-expanded="true" aria-controls="collapsePages12">
                        <i class="fa fa-calculator"></i>
                        <span>Contabilidad</span>
                    </a>
                    <div id="collapsePages12" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Contabilidad</h6>
                            <?php if (!empty($_SESSION['permisos'][COMPRAS]['r'])) { ?>
                                <a class="collapse-item" href="../views/gastos.php">Compra-Gastos</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][CAJA_CHICA]['r'])) { ?>
                                <a class="collapse-item" href="../views/cajachica.php">Caja Chica</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][COMERCIAL]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages123" aria-expanded="true" aria-controls="collapsePages123">
                        <i class="fa fa-university"></i>
                        <span>Comercial</span>
                    </a>
                    <div id="collapsePages123" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel Comercial</h6>
                            <?php if (!empty($_SESSION['permisos'][VISITAS]['r'])) { ?>
                                <a class="collapse-item" href="../views/vendedoras.php">Registro Visitas</a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Reporte
            </div>
            <?php if (!empty($_SESSION['permisos'][REPORTE]['r'])) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesre" aria-expanded="true" aria-controls="collapsePagesre">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Reportes</span>
                    </a>
                    <div id="collapsePagesre" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Panel de Reportes</h6>
                            <?php if (!empty($_SESSION['permisos'][REPORTE_FACTURA]['r'])) { ?>
                                <a class="collapse-item" href="../views/reporteFactura.php">Factura</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][REPORTE_VENTA]['r'])) { ?>
                                <a class="collapse-item" href="../views/reporteVentas.php">Ventas</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][REPORTE_PRODUCTO]['r'])) { ?>
                                <a class="collapse-item" href="../views/reporteVentaProducto.php">Productos por Venta</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][REPORTE_COMPRA]['r'])) { ?>
                                <a class="collapse-item" href="../views/reporteCompras.php">Compras</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][REPORTE_STOCK]['r'])) { ?>
                                <a class="collapse-item" href="../views/reporteStock.php">Stock</a>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][REPORTE_CIERRES]['r'])) { ?>
                                <a class="collapse-item" href="../views/reporteCierresCaja.php">Cierres Caja</a>
                            <?php } ?>

                        </div>
                    </div>
                </li>
            <?php } ?>
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline" id="sidebarToggleContainer">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class=""></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->


                        <!-- Nav Item - Messages -->


                        <div class="topbar-divider d-none d-sm-block"></div>




                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="contenedor">

                                    <span class="nombres"><?php echo $_SESSION['nomb_apelido']; ?></span>
                                    <span class="usuarios"><?php echo $_SESSION['email']; ?></span>
                                </div>

                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">

                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../views/perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="../views/perfil.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuración
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->