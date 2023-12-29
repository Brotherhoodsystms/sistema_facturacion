<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../templates/header.php" ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Reporte reserva</li>
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
              <h5 class="card-header">Reporte de reserva</h5>
              <div class="card-body">
                <div class="form-row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="reporte">Reporte de:</label>
                    <select id="reporte_reserva" name="reporte_reserva" class='form-control' autofocus onchange="app.seleccionFecha()">
                      <option value="0" disabled='selected' selected='selected'>Seleccione</option>
                      <option value="2">Ruc cliente</option>
                      <option value="3">CI vendedor</option>
                      <option value="4">Numero de reserva</option>
                      <option value="6">Fecha</option>
                    </select>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="ingrese">Ingrese dato:</label>
                    <input id="reporte_buscar" type="text" name="reporte_buscar" data-parsley-trigger="change" autocomplete="off" class="form-control">
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="fecha inicio">Fecha inicio:</label>
                    <input id="reporte_fecha_i" type="date" name="reporte_fecha_i" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="fecha final">Fecha final:</label>
                    <input id="reporte_fecha_f" type="date" name="reporte_fecha_f" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <button type="button" class="btn btn-space btn-primary" onclick="app.reporteBuscar()">Buscar</button>
                    <a href="../views/reporteReserva.php" class="btn btn-space btn-danger">Limpiar</a>
                    <button type="button" class="btn btn-space btn-success" onclick="app.generarPdf()">Pdf</button>
                  </div>
                </div>

                <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-3">
                  <div class=" table table-responsive">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Numero reserva</th>
                          <th>Forma de pago</th>
                          <th>Cliente</th>
                          <th>Usuario</th>
                          <th>Abono</th>
                          <th>Total</th>
                          <!-- <th style="width: 40px">Opciones</th> -->
                        </tr>
                      </thead>
                      <tbody id="tbody">
                      </tbody>
                    </table>
                  </div>
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
              Copyright © 2022 Sistema Inventario. Todo los derechos reservados. Creado por: <a href="#">SELI LOGISTICS</a>.
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
  <?php require_once "../templates/footer.php" ?>
  <script src="../src/reporteReserva.js"></script>
</body>

</html>