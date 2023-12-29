<?php
session_start();
set_time_limit(300);
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(REPORTE_FACTURA); ?>

<body>
  <!-- ============================================================== -->
  <!-- main wrapper -->
  <!-- ============================================================== -->
  <div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <?php require_once "../plantilla/sidebar.php" ?>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper" id="containerbody">
      <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
              <h2 class="pageheader-title"></h2>
              <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../views/index.php" class="breadcrumb-link">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Reportes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reporte Factura</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
          <?php if (!empty($_SESSION['permisos'][REPORTE_FACTURA]['w']) || !empty($_SESSION['permisos'][REPORTE_FACTURA]['u'])) { ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header">Reporte de factura</h5>
                <div class="card-body">
                  <div class="form-row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                      <div class="select-wrapper">
                        <label for="reporte"></label>
                        <select id="reporte_factura" name="reporte_factura" class='form-control' autofocus onchange="app.seleccionFecha()">
                          <option value="0" disabled='selected' selected='selected'>Seleccione</option>
                          <option value="2">Identificación de cliente</option>
                          <option value="4">Número de factura</option>
                          <option value="6">Fecha</option>
                        </select>
                        <span class="title" data-placeholder="Busqueda por"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p1" id="div_listarEmi">
                      <div class="select-wrapper">
                      <label for="formapago"></label>
                      <div id="formapago">
                        <div id="selectorEmisor"></div>
                        <span class="title" data-placeholder="Emisor"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>
                    </div>

                    <div class="col-md-4 mb-2"><br>
                      <div class="select-wrapper">
                      <label for="ingrese"></label>
                      <input id="reporte_buscar" type="text" name="reporte_buscar" placeholder="Ingresar información búsqueda" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      <span class="title" data-placeholder="Información búsqueda"></span>
                    </div>
                    </div>

                    <div class="col-md-4 mb-2"><br>
                      <div class="select-wrapper">
                      <label for="fecha inicio"></label>
                      <input id="reporte_fecha_i" type="date" name="reporte_fecha_i" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                      <span class="title" data-placeholder="Fecha inicio"></span>
                    </div>
                    </div>

                    <div class="col-md-4 mb-2"><br>
                    <div class="select-wrapper">
                      <label for="fecha final"></label>
                      <input id="reporte_fecha_f" type="date" name="reporte_fecha_f" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                      <span class="title" data-placeholder="Fecha final"></span>
                    </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 p-1" style=" margin: 2% 0% 0% 0%;">
                      <button type="button" class="btn btn-space btn-primary" title="Buscar" style="border-radius: 50%; width: 50px; height: 50px;" onclick="app.reporteBuscar()"><i class="fa fa-search"></i></button>
                      <a href="../views/reporteFactura.php" class="btn btn-space btn-danger" title="Limpiar" style="border-radius: 50%; width: 50px; height: 50px;"><i class="fa fa-eraser"></i></a>
                      <!-- 
                    <button type="button" class="btn btn-space btn-secundary" title="Pdf" style="border-radius: 50%; width: 50px; height: 50px; background: #139fc9; color: white;" onclick="app.generarPdf()"><i class="fa fa-file-pdf"></i></button>
                    <button type="button" class="btn btn-space btn-success" title="Excel" style="border-radius: 50%; width: 50px; height: 50px;" onclick="app.generarExcel()"><i class="fa fa-file-excel"></i></button>
                  -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-3">
            <div class="card">
              <h5 class="card-header"> Listado de Facturas</h5>
              <div class="card-body">
                <div id="tbody" class="table-responsive"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->

      <!-- ============================================================== -->
      <!-- end main wrapper -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/reporteFactura.js"></script>
</body>

</html>