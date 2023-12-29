<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../templates/header.php";
getpermisos(VENDEDOR); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Vendedor</li>
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
     <?php if (!empty($_SESSION['permisos'][VENDEDOR]['w']) || !empty($_SESSION['permisos'][VENDEDOR]['u'])) { ?>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de vendedor</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="vendedorform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="vendedor_id" name="vendedor_id">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="dni">Dni:</label>
                      <input id="vendedor_dni" type="text" name="vendedor_dni" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="nombres">Nombres:</label>
                      <input id="vendedor_nombres" type="text" name="vendedor_nombres" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="telefono">Telefono:</label>
                      <input id="vendedor_telefono" type="text" name="vendedor_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="direccion">Dirección:</label>
                      <textarea id="vendedor_direccion" name="vendedor_direccion" class="form-control"></textarea>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                      <button type="submit" class="btn btn-space btn-primary" title="Guardar" style="border-radius: 50%; width:50px; height:50px"><i class="fa fa-save"></i></button>
                      <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      <?php } ?>
          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de vendedor</h5>
              <div class="card-body">
                <div id="vendedores" class="table-responsive"></div>
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
    <script src="../src/vendedor.js"></script>
</body>

</html>