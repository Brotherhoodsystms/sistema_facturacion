<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(CODIGO_BARRAS); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Código barra</li>
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
              <h5 class="card-header" id="titulocardheader">Crear código o serial</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="codigoform" onsubmit="app.generar()">
                  <div class="form-group"><br>
                    <div class="select-wrapper">
                    <label for="descripcion"></label>
                    <input id="codigo_serial" type="text" name="codigo_serial" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                    <span class="title" data-placeholder="Codigo o serial"></span>
                  </div>
                  </div>

                  <div class="form-group"><br>
                    <div class="select-wrapper">
                    <label for="descripcion"></label>
                    <select class="form-control" name="tipo_codigo" id="tipo_codigo" autofocus>
                      <option disabled selected="selected" value="0">Seleccione</option>
                      <!-- <option value="code128">Code 128</option> -->
                      <option value="code39">Code 39</option>
                      <option value="codabar">Codabar</option>
                    </select>
                    <span class="title" data-placeholder="Tipo codigo"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                  </div>
                  </div>
<br>
                  <div class="form-group row text-right">
                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-3">
                      <button type="submit" class="btn btn-space btn-primary" title="Generar código" style="border-radius: 50%; width:50px; height:50px"><i class="fa fa-barcode"></i></button>
                      <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
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
              <h5 class="card-header">Mostrar código de barra</h5>
              <div class="card-body text-center">
                <svg id="codigoNuevo"></svg>
                <div id="botonImprimir" onclick="app.imprimir()"></div>
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
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/generarcodigo.js"></script>
</body>

</html>