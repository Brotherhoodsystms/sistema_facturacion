<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(CLIENTE); ?>

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Ingreso</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cliente</li>
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
          <?php if (!empty($_SESSION['permisos'][CLIENTE]['w']) || !empty($_SESSION['permisos'][CLIENTE]['u'])) { ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header">Registro de cliente</h5>
                <br>
                <div class="card-body">
                  <form action="javascript:void(0);" method="POST" id="clienteform" onsubmit="app.guardar()">
                    <div class="form-row">
                      <div class="form-group">
                        <input type="hidden" id="cliente_id" name="cliente_id">
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                        <div class="select-wrapper">
                          <div id="tipo_documentoC"></div>
                          <label for="dni"></label>
                          <span class="title" data-placeholder="Tipo de documento"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>


                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__identificacion">
                          <div class="input-field">

                            <input id="cliente_ruc" type="text" name="cliente_ruc" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="cliente_ruc" class="formulario-label formulario__label">Identificacion:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo identificacion solo puede contener numeros</p>

                        </div>

                      </div>
                      <div class="col-md-6 mb-2">
                        <div class="formulario__grupo" id="grupo__razon">
                          <div class="input-field">
                            <input id="cliente_razonsocial" type="text" name="cliente_razonsocial" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="cliente_razonsocial" class="formulario-label formulario__label">Razon social:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>

                          </div>
                          <p class="formulario__input-error">El campo razon social solo puede contener letras</p>

                        </div>
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__telefono">
                          <div class="input-field">
                            <input id="cliente_telefono" type="text" name="cliente_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="cliente_telefono" class="formulario-label formulario__label">Telefono:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>

                          </div>
                          <p class="formulario__input-error">El campo telefono solo puede contener numeros</p>

                        </div>
                      </div>


                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__contacto">
                          <div class="input-field">
                            <input id="cliente_contacto" type="text" name="cliente_contacto" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="cliente_contacto" class="formulario-label formulario__label">Nombre contacto:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo nombre contacto solo puede contener letras</p>

                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__email">
                          <div class="input-field">
                            <input id="cliente_email" type="text" name="cliente_email" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input"></input>
                            <label for="cliente_email" class="formulario-label formulario__label">Email:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>

                          </div>
                          <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>

                        </div>
                      </div>

                      <div class="col-md-6 mb-2">
                        <div class="formulario__grupo" id="grupo__direccion">
                          <div class="input-field">
                            <input id="cliente_direccion" name="cliente_direccion" class="form-control formulario__input"></input>
                            <label for="cliente_direccion" class="formulario-label formulario__label">Direccion</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">La dirección tiene que ser de 4 a 40 dígitos y solo puede contener números, letras y guiones.</p>
                        </div>
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
            <br>

            <div class="card">
              <h5 class="card-header"> Listado de cliente</h5>
              <div class="card-body">
                <div id="clientes" class="table-responsive"></div>
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
      <?php require_once "../plantilla/lower.php" ?>
      <script src="../src/cliente.js"></script>
      <script src="../src/formulariocliente.js"></script>

</body>

</html>