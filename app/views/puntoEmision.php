<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(FACTURACION); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Punto de Emision</li>
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
              <h5 class="card-header">Registro de Punto de Emision</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="puntoemisionform" enctype="multipart/form-data" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="pto_emision_id" name="pto_emision_id">
                    </div>
                    <div class="col-md-4 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__nom">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="nombre_ptoemision" type="text" name="nombre_ptoemision" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="nombre_ptoemision" class="formulario-label formulario__label">Nombre:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Nombre solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-2">
                    <br>
                      <div class="formulario__grupo" id="grupo__cod">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="codigo_ptemision" type="text" name="codigo_ptemision" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="codigo_ptemision" class="formulario-label formulario__label">Codigo:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Codigo solo puede contener numeros.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-2">
                    <br>
                      <div class="formulario__grupo" id="grupo__sfac">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="secuenciaF_ptoemision" type="text" name="secuenciaF_ptoemision" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="secuenciaF_ptoemision" class="formulario-label formulario__label">Secuencia de Factura:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Secuencia de Factura solo puede contener numeros.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-2">
                      <div class="formulario__grupo" id="grupo__scs">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="secuecianotav_ptoemision" name="secuecianotav_ptoemision" class="form-control"></input>
                            <label for="secuecianotav_ptoemision" class="formulario-label formulario__label">Secuencia Comprobante de salida:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Secuencia Comprobante de salida solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-2">
                      <div class="formulario__grupo" id="grupo__sreser">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="secuencia_reserva" name="secuencia_reserva" class="form-control formulario__input"></input>
                            <label for="secuencia_reserva" class="formulario-label formulario__label">Secuencia Reserva:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Secuencia Reserva solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-2">
                    <div class="formulario__grupo" id="grupo__spro">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                      <input id="secuencial_proforma" name="secuencial_proforma" class="form-control formulario__input"></input>
                      <label for="secuencial_proforma"  class="formulario-label formulario__label">Secuencia Proforma:</label>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Secuencia Proforma solo puede contener letras.</p>

                    </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                      <label for="ambiente_ptoemision"></label>
                      <div id="ptoemision_establecimiento"></div>
                      <span class="title" data-placeholder="Establecimiento"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                    </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                      <label for="ambiente_bodega"></label>
                      <div id=""></div>
                      <select id="bodega_puntoemision" name="bodega_puntoemision" class='form-control'>
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                      </select>
                      <span class="title" data-placeholder="Bodega"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                    </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                      <label for="estado_ptroemision"></label>
                      <div>
                        <select id="estado_ptroemision" name="estado_ptroemision" required="required" class="form-control">
                          <option value="">Seleccione el Estado</option>
                          <option value="1" selected="selected">Activo</option>
                          <option value="2">Inactivo</option>
                        </select>
                        <span class="title" data-placeholder="Estado"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <button id="submit" type="submit" class=" btn btn-space btn-primary">Guardar </button>

                </form>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de Punto de Emisión</h5>
              <div class="card-body">
                <div id="ptoemision" class="table-responsive"></div>
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
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/puntoEmision.js"></script>
    <script src="../src/formulariopuntoEmision.js"></script>
</body>

</html>