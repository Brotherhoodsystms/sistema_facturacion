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
                    <li class="breadcrumb-item active" aria-current="page">Costo</li>
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
          <!-- ============================================================== -->
          <!-- total revenue  -->
          <!-- ============================================================== -->


          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- category revenue  -->
          <!-- ============================================================== -->
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de costo</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="costoform" onsubmit="app.guardar()">

                  <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input id="gasto_descripcion" type="text" name="gasto_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                  </div>
                  <div class="form-group row text-right">
                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-3">
                      <button type="submit" class="btn btn-space btn-primary">Crear</button>
                      <button type="reset" class="btn btn-space btn-secondary" onclick="app.limpiarInputs()">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->

          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Listado de costo</h5>
              <div class="card-body">
                <div id="costos" class="table-responsive"></div>
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
    <script src="../src/costo.js"></script>
</body>

</html>