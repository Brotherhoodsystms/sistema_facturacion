<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(REGISTRO_MOVIMIENTOS); ?>
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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Cierres Caja</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro Movimiento</li>
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
        <?php if (!empty($_SESSION['permisos'][REGISTRO_MOVIMIENTOS]['w']) || !empty($_SESSION['permisos'][REGISTRO_MOVIMIENTOS]['u'])) { ?>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro Movimiento Efectivo</h5>
              <div class="card-body"><br>
                <form action="javascript:void(0);" method="POST" id="movimientoFrom" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="movimientoid" name="movimientoid">
                    </div>
                    <div class="col-md-6 mb-2">
                      <div class="select-wrapper">
                      <label for="tipo_gasto"></label>
                     <div id='selectorSucursal'></div>
                     <span class="title" data-placeholder="Sucursal"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                    </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <div class="select-wrapper">
                      <label for="tipo_movimiento"></label>
                      <select name="tipo_movimiento" id="tipo_movimiento" class="form-control">
                        <option value="Selected">Seleccione</option>
                        <option value="ENTRADA">ENTRADA</option>
                        <option value="SALIDA">SALIDA</option>
                      </select>
                      <span class="title" data-placeholder="Tipo gasto"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                    </div>
                    </div>

                    <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"><br>
                    <div class="formulario__grupo" id="grupo__descrip">
                      <div class="select-wrapper">
                      <label for="movimiento_descripcion"></label>
                      <input id="movimiento_descripcion" type="text" name="movimiento_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      <span class="title" data-placeholder="Descripcion"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Descripción solo puede contener numeros , letras y guiones.</p>
                    </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__mt">
                      <div class="select-wrapper">
                      <label for="movimiento_total"></label>
                      <input id="movimiento_total" type="text" name="movimiento_total" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      <span class="title" data-placeholder="Total"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Total solo puede contener numeros.</p>
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

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br>
            <div class="card">
              <h5 class="card-header"> Listado de Movimientos</h5>
              <div class="card-body">
                <div id="listadoMovimientoCaja" class="table-responsive"></div>
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
    <br><br>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/movimientoefectivo.js"></script>
    <script src="../src/formularioegresoBodega.js"></script>

    
</body>

</html>