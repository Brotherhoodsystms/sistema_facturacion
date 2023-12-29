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
                    <li class="breadcrumb-item active" aria-current="page">Tipo bodega</li>
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
              <h5 class="card-header">Registro de tipo bodega</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="tipobodegaform" onsubmit="app.guardarT()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="tipobodega_id" name="tipobodega_id">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="telefono">Nombre:</label>
                      <input id="tipobodega_especificacion" type="text" name="tipobodega_especificacion" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="capacidad">Descripción:</label>
                      <input id="tipobodega_capacidad" type="text" name="tipobodega_capacidad" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                      <button type="submit" class="btn btn-space btn-primary">Crear</button>
                      <button type="reset" class="btn btn-space btn-secondary" onclick="app.limpiarInputs()">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de tipo bodega</h5>
              <div class="card-body">
                <div id="tipobodega" class="table-responsive"></div>
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
  <script src="../src/tipobodega.js"></script>
</body>

</html>