<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(SUCURSAL); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Sucursal</li>
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
              <h5 class="card-header">Registro de sucursal</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="sucursalform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="sucursal_id" name="sucursal_id">
                    </div>
                    <!-- Primera fila -->
                    <div class="col-md-6 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__sp">
                        <div class="select-wrapper">
                          <div class="formulario__grupo-input">
                            <input id="sucursal_provincia" type="text" name="sucursal_provincia" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="sucursal_provincia" class=""></label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Surcusal provincia"></span>
                          </div>
                        </div>
                        <p class="formulario__input-error">El campo Surcusal provincia solo puede contener letras.</p>

                      </div>
                    </div>


                    <div class="col-md-6 mb-2">
                    <br>
                      <div class="formulario__grupo" id="grupo__sn">
                        <div class="select-wrapper">
                          <div class="formulario__grupo-input">
                            <input id="sucursal_nombre" type="text" name="sucursal_nombre" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="sucursal_nombre" class="" ></label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Sucursal nombre"></span>
                          </div>
                        </div>
                        <p class="formulario__input-error">El campo Surcusal nombre solo puede contener letras.</p>

                      </div>
                    </div>

                    <!-- Segunda fila -->
                    <div class="col-md-6 mb-2"><br>
                      <div class="formulario__grupo" id="grupo__st">
                        <div class="select-wrapper">
                          <div class="formulario__grupo-input">
                            <input id="sucursal_telefono" type="text" name="sucursal_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="sucursal_telefono" class="formulario-label"></label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Sucursal telefono"></span>
                          </div>
                        </div>
                        <p class="formulario__input-error">El campo Surcusal telefono solo puede contener numeros.</p>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2"><br>
                      <div class="formulario__grupo" id="grupo__sd">
                        <div class="select-wrapper">
                          <div class="formulario__grupo-input">
                            <input id="sucursal_direccion" name="sucursal_direccion" class="form-control formulario__input"></input>
                            <label for="sucursal_direccion" class="formulario-label"></label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Sucursal direccion"></span>
                          </div>
                        </div>
                        <p class="formulario__input-error">El campo Surcusal direccion solo puede contener numeros,letras y guiones.</p>
                      </div>
                    </div>

                    <!-- Botones -->
                    <div class="col-md-12 mb-2"><br>
                      <div class="p-2">
                        <button type="submit" class="btn btn-space btn-primary">Crear</button>
                        <button type="reset" class="btn btn-space btn-secondary"style="border-radius: 8%; margin-left:14px" onclick="app.limpiarInputs()">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br>
            <div class="card">
              <h5 class="card-header"> Listado de sucursal</h5>
              <div class="card-body">
                <div id="sucursal" class="table-responsive"></div>
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
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <br><br>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/sucursal.js"></script>
    <script src="../src/formulariosucursal.js"></script>

</body>

</html>