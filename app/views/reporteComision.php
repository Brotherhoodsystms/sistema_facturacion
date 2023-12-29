<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../templates/header.php";?>

<body>
  <!-- ============================================================== -->
  <!-- main wrapper -->
  <!-- ============================================================== -->
  <div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <?php require_once "../templates/navbar.php" ?>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <?php require_once "../templates/sidebar.php" ?>
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
              <h2 class="pageheader-title">SELI LOGISTICS </h2>
              <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Página</a></li>
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
              <h5 class="card-header">Reporte de Comsiones</h5>
              <div class="card-body">
                <div class="form-row">

                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="reporte">Reporte de:</label>
                    <select id="reporte_factura" name="reporte_factura" class='form-control' autofocus onchange="app.seleccionFecha()">
                      <option value="0" disabled='selected' selected='selected'>Seleccione</option>
                      <option value="2">Identificador del vendedor</option>
                      <option value="4">Numero de factura</option>
                      <!-- <option value="9">Sucursal</option> -->
                      <option value="8">Tipo de comprobante</option>
                      <option value="6">Fecha</option>
                    </select>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p1" id="div_listarEmi">
                    <label for="formapago">Sucursal</label>
                    <div id="formapago">
                    <div id="selectorEmisor"></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="ingrese">Ingrese dato:</label>
                    <input id="reporte_buscar" type="text" name="reporte_buscar" data-parsley-trigger="change" autocomplete="off" class="form-control">
                  </div>
                  
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p1" id="div_listatipop">
                    <label for="formapago">Tipo de comprobante</label>
                    <div id="formapago">
                    <div id="selectorComprobante"></div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="fecha inicio">Fecha inicio:</label>
                    <input id="reporte_fecha_i" type="date" name="reporte_fecha_i" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="fecha final">Fecha final:</label>
                    <input id="reporte_fecha_f" type="date" name="reporte_fecha_f" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                  </div>
                  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 p-1">
                    <button type="button" class="btn btn-space btn-primary" onclick="app.reporteBuscar()">Buscar</button>
                    <a href="../views/reporteComision.php" class="btn btn-space btn-danger">Limpiar</a>
                    <!-- <button type="button" class="btn btn-space btn-secundary" onclick="app.generarPdf()">Pdf</button>
                    <button type="button" class="btn btn-space btn-success" onclick="app.generarExcel()">Excel</button>
 -->
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
      <div class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              Copyright © 2022 Sistema Inventario. Todo los derechos facturados. Creado por: <a href="#">SELI LOGISTICS</a>.
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- end footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- end main wrapper -->
  <!-- ============================================================== -->
  <!-- Optional JavaScript -->
  <?php require_once "../templates/footer.php"; ?>
  <script src="../src/reportecomisiones.js"></script>
</body>

</html>