<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(ESTABLECIMIENTO); ?>

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Administración</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Establecimiento</li>
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
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de Establecimiento</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="formEstablecimiento" enctype="multipart/form-data" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="estableciminto_id" name="estableciminto_id">
                    </div>
                    <div class="col-md-6 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__nom">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="nombre_establecimiento" type="text" name="nombre_establecimiento" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="nombre_establecimiento" class="formulario-label formulario__label">Nombre:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Nombre solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__cod">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="codigo_establecimiento" type="text" name="codigo_establecimiento" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="codigo_establecimiento" class="formulario-label formulario__label">Codigo:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Codigo solo puede contener numeros.</p>

                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <div class="formulario__grupo" id="grupo__nc">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="nombre_comercial_estable" type="text" name="nombre_comercial_estable" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="nombre_comercial_estable" class="formulario-label formulario__label">Nombre Comercial:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Nombre Comercial solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <div class="formulario__grupo" id="grupo__dire">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="direccion_establecimiento" name="direccion_establecimiento" class="form-control formulario__input"></input>
                            <label for="direccion_establecimiento" class="formulario-label formulario__label">Direccion:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">La dirección tiene que ser de 4 a 40 dígitos y solo puede contener números, letras y guiones.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <div class="select-wrapper">
                        <label for="ambiente"></label>
                        <div>
                          <select id="estado_establecimiento" name="estado_establecimiento" required="required" class="form-control">
                            <!-- <option value="">Seleccione el Estado</option> -->
                            <option value="1" selected="selected">Activo</option>
                            <option value="2">Inactivo</option>
                          </select>
                          <span class="title" data-placeholder="Estado"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-6 mb-2">
                    
                      <div class="select-wrapper">
                      <label for="ambiente"></label>
                      <div id="lista_emisor"></div>
                      <span class="title" data-placeholder="Seleccion de emisor"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                    </div>

                    </div>

                </form>
              </div>
              <button id="submit" type="submit" class=" btn btn-space btn-primary">Guardar </button>

            </div>
          </div>
          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <br>
            <div class="card">
              <h5 class="card-header"> Listado de Establecimientos</h5>
              <div class="card-body">
                <div id="establecimiento" class="table-responsive"></div>
              </div>
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
      <!-- ============================================================== -->
      <!-- end main wrapper -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <br><br>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/establecimiento.js"></script>
    <script src="../src/formularioestablecimiento.js"></script>

</body>

</html>