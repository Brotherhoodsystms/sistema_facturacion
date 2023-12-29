<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(CATEGORIA); ?>

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Bodega</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categoria</li>
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
       <?php if (!empty($_SESSION['permisos'][CATEGORIA]['w']) || !empty($_SESSION['permisos'][CATEGORIA]['u'])) { ?>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de categoria</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="categoriaform" onsubmit="app.guardar()">
                  <div class="form-group">
                  <div class="formulario__grupo" id="grupo__ct">
                    <div class="select-wrapper">
                    <label for="categoria_descripcion"></label>
                    <input id="categoria_descripcion" placeholder="Ingresar nombre categoria" type="text" name="categoria_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                    <input type="text" id="categoria_identificador" name="categoria_identificador" hidden>
                    <span class="title" data-placeholder="Categoria"></span>
                    <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                  </div>
                  <p class="formulario__input-error">El campo nombre categoria solo puede contener letras.</p>
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
              <h5 class="card-header"> Listado de categoria</h5>
              <div class="card-body">
                <div id="categorias" class="table-responsive"></div>
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
    <br>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/categoria.js"></script>
    <script src="../src/formularioegresoBodega.js"></script>

</body>

</html>