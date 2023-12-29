<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(REGISTRO_BODEGA); ?>

<body>
  <!--==============================================================-->
  <!--main wrapper -->
  <!--==============================================================-->
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

      <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
              <h2 class="pageheader-title"></h2>
              <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../views/index.php" class="breadcrumb-link">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Bodega</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
          <!-- ============================================================== -->
          <!-- total revenue  -->
          <!-- ============================================================== -->


          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- category revenue  -->
          <!-- ============================================================== -->
         <?php if (!empty($_SESSION['permisos'][REGISTRO_BODEGA]['w']) || !empty($_SESSION['permisos'][REGISTRO_BODEGA]['u'])) { ?>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header" id="titulocardheader">Registro Bodega</h5>
              
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="bodegaform" onsubmit="app.guardar()">
                <div class="form-group">
                  <div class="select-wrapper">
                    <label for="descripcion"></label>
                    <div id="sucursal"></div>
                    <input type="text" id="bodega_id" name="bodega_id" hidden>
                    <span class="title" data-placeholder="Sucursal"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                  </div>
                  <br>
                </div>


                <div class="form-group">
                <div class="formulario__grupo" id="grupo__nb">
                  <div class="select-wrapper">
                    <label for="bodega_descripcion"></label>
                    <input id="bodega_descripcion" type="text" placeholder="Ingresar nombre bodega" name="bodega_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                    <span class="title" data-placeholder="Bodega"></span>
                    <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                  </div>                  
                  <p class="formulario__input-error">El campo Nombre bodega solo puede contener letras y numeros.</p>
                  </div>
                </div>

                  <div class="form-group row text-right">
                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-3">
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

          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Listado Bodegas</h5>
              <div class="card-body text-center">
                <div id="bodegas" class="table-responsive"></div>
              </div>
            </div>
          </div>
        </div>
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    
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
  <?php require_once "../plantilla/lower.php"; ?>
  <script src="../src/bodega.js"></script>
  <script src="../src/formularioegresoBodega.js"></script>
</body>

</html>