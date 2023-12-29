<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(PROVEEDOR); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Proveedor</li>
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
      <?php if (!empty($_SESSION['permisos'][PROVEEDOR]['w']) || !empty($_SESSION['permisos'][PROVEEDOR]['u'])) { ?>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de proveedor</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="proveedorform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="proveedor_id" name="proveedor_id">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <br>
                    <div class="formulario__grupo" id="grupo__rs">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                      <input id="proveedor_razonsocial" type="text" name="proveedor_razonsocial" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                      <label for="proveedor_razonsocial"class="formulario-label formulario__label">Razon social:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Razon social solo puede contener letras.</p>
                    </div>
                    </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                    <br>
                    <div class="formulario__grupo" id="grupo__ruc">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                      <input id="proveedor_ruc" type="text" name="proveedor_ruc" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <label for="proveedor_ruc"class="formulario-label formulario__label">Ruc:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Ruc solo puede contener numeros.</p>
                    </div>
                    </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                    <br>
                    <div class="formulario__grupo" id="grupo__tel">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                      <input id="proveedor_telefono" type="text" name="proveedor_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <label for="proveedor_telefono"class="formulario-label formulario__label">Telefono:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Telefono solo puede contener numeros.</p>
                    </div>
                    </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__email">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                      <input id="proveedor_email" type="text" name="proveedor_email" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <label for="proveedor_email"class="formulario-label formulario__label">Email:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                    </div>
                    </div>
                    </div>

                    <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="formulario__grupo" id="grupo__dire">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                      <input id="proveedor_direccion" name="proveedor_direccion" class="form-control formulario__input"></input>
                      <label for="proveedor_direccion"class="formulario-label formulario__label">Direccion:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Direccion solo puede contener letras, numeros, guiones.</p>
                    </div>
                    </div>
                    </div>

                   


                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                    <div class="formulario__grupo" id="grupo__nc">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                      <input id="proveedor_contacto" type="text" name="proveedor_contacto" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <label for="proveedor_contacto"class="formulario-label formulario__label">Nombre contacto:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Nombre contacto solo puede contener letras.</p>
                    </div>
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
              <h5 class="card-header"> Listado de proveedor</h5>
              <div class="card-body">
                <div id="proveedores" class="table-responsive"></div>
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
    <br><br><br>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/proveedor.js"></script>
    <script src="../src/formularioproveedor.js"></script>
</body>

</html>