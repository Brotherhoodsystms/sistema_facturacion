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
                    <li class="breadcrumb-item active" aria-current="page">Ubicación</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <div class="">
          <!-- Modal -->
          <div class="modal fade" id="exampleModalUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ubicación</h5>
                  <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </a>
                </div>
                <div class="modal-body">
                  <form action="javascript:void(0);" method="POST" id="ubicacionform">
                    <div class="form-row">
                      <div class="form-group">
                        <input type="hidden" id="ubicacion_id" name="ubicacion_id">
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                        <label for="sucursal">Sucursal ubicada:</label>
                        <input id="ubicacion_sucursal" type="text" name="ubicacion_sucursal" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                        <label for="sucursal">Sucursal reubicar:</label>
                        <div id="ubicacion_sucursal_r"></div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                        <label for="bodega">Bodega ubicada:</label>
                        <input id="ubicacion_bodega" type="text" name="ubicacion_bodega" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                        <label for="bodega">Bodega reubicar:</label>
                        <select id="ubicacion_bodega_r" name="ubicacion_bodega_r" class='form-control'>
                          <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        </select>
                        <!-- <div id="ubicacion_bodega_r"></div> -->
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                        <label for="ubicacion">Ubicación ubicada:</label>
                        <input id="ubicacion_descripcion" type="text" name="ubicacion_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                        <label for="ubicacion">Ubicación reubicar:</label>
                        <input id="ubicacion_descripcion_r" type="text" name="ubicacion_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button class="btn btn-primary" onclick="app.actualizarUbicacion()">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de ubicación</h5>
              <div class="card-body">
                <div id="ubicacion" class="table-responsive"></div>
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
  <script src="../src/ubicacion.js"></script>
</body>

</html>