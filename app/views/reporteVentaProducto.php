<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php"; 

getpermisos(REPORTE_PRODUCTO);?>

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
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Reporte de productos por ventas</h5>
              <div class="card-body"><br>
                <div class="form-row">
                  <div class="col-md-4 mb-2">
                    <div class="select-wrapper">
                    <label for="ingrese"></label>
                    <input id="reporte_buscar" type="text" name="reporte_buscar" placeholder="Ingresar cédula cliente" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    <span class="title" data-placeholder="Cedula cliente"></span>
                  </div>
                  </div>

                  <div class="col-md-4 mb-2">
                    <div class="select-wrapper">
                    <label for="fecha inicio"></label>
                    <input id="reporte_fecha_i" type="date" name="reporte_fecha_i" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    <span class="title" data-placeholder="Fecha inicio"></span>
                  </div>
                  </div>

                  <div class="col-md-4 mb-2">
                    <div class="select-wrapper">
                    <label for="fecha final"></label>
                    <input id="reporte_fecha_f" type="date" name="reporte_fecha_f" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    <span class="title" data-placeholder="Fecha final"></span>
                  </div>
                  </div>

                  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 p-1" style="margin: 2% 0% 0% 0%;">
                    <button type="button" class="btn btn-space btn-primary" style="border-radius: 50%; width: 50px; height: 50px;" onclick="app.reporteBuscar()"><i class="fa fa-search"></i></button>
                    <a href="../views/reporteVentaProducto.php" class="btn btn-space btn-danger"title="Limpiar" style="border-radius: 50%; width: 50px; height: 50px;"><i class="fa fa-eraser"></i></a>
                   
                  </div>
                </div>
                <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-3">
                <div id="tbody" class="table-responsive"></div>
                </div>
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
  <script src="../src/reporteVentaProducto.js"></script>
</body>

</html>