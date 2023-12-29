<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(CAJA_CHICA); ?>

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
    <div class="dashboard-wrapper">
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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Contabilidad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Caja chica</li>
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
              <h5 class="card-header">Registro de caja chica</h5>
              <div class="card-body"><br>
                <form action="javascript:void(0);" method="POST" id="cajachicaform">
                  <div class="form-row">
                    <input id="cajachica_id" type="hidden" name="cajachica_id">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label for="sucursal"></label>
                        <div id="selectorSucursal" onchange="app.serieCajaChica()"> </div>
                        <span class="title" data-placeholder="Sucursal"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label for="serie"></label>
                        <input id="cajachica_serie" type="text" name="cajachica_serie" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                        <span class="title" data-placeholder="Serie"></span>

                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="formulario__grupo" id="grupo__ar">
                        <div class="select-wrapper">
                          <label for="cajachica_area"></label>
                          <input id="cajachica_area" type="text" name="cajachica_area" data-parsley-trigger="change" autocomplete="off" class="form-control">
                          <span class="title" data-placeholder="Area"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>

                        </div>
                        <p class="formulario__input-error">El campo Area solo puede contener letras,numeros y guion.</p>
                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="asignacion"></label>
                        <input id="cajachica_fechaasignacion" type="date" name="cajachica_fechaasignacion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        <span class="title" data-placeholder="Fecha de asignacion"></span>

                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="liquidacion"></label>
                        <input id="cajachica_fechaliquidacion" type="date" name="cajachica_fechaliquidacion" data-parsley-trigger="change" autocomplete="off" class="form-control" onchange="app.restarDiasFechaCajachica()">
                        <span class="title" data-placeholder="Fecha de liquidacion"></span>

                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="dias"></label>
                        <input id="cajachica_dias" type="text" name="cajachica_dias" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                        <span class="title" data-placeholder="Dias justificados"></span>
                      </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="formulario__grupo" id="grupo__adc">
                        <label for="cajachica_dineroasignacion_a">Asignar dinero caja:</label>
                        <input id="cajachica_dineroasignacion_a" type="text" name="cajachica_dineroasignacion_a" data-parsley-trigger="change" autocomplete="off" class="form-control" onchange="app.asignarDinero()">
                        <i class="formulario__validacion-estadof fa-solid fa-circle-xmark"></i>
                        <p class="formulario__input-error">Asignar dinero caja solo puede contener numeros.</p>
                        <span class="text-primary">Debe dar enter</span>
                      </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <label for="asignacion">Dinero de caja:</label>
                      <input id="cajachica_dineroasignacion" type="text" name="cajachica_dineroasignacion" data-parsley-trigger="change" autocomplete="off" class="form-control text-success" value="0.00" readonly>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <label for="egreso">Dinero egreso:</label>
                      <input id="cajachica_dineroegreso" type="text" name="cajachica_dineroegreso" data-parsley-trigger="change" autocomplete="off" class="form-control text-primary" value="0.00" readonly>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <label for="reposicion">Dinero reposición:</label>
                      <input id="cajachica_dineroreposicion" type="text" name="cajachica_dineroreposicion" data-parsley-trigger="change" autocomplete="off" class="form-control text-danger" value="0.00" readonly>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br>
            <div class="card">
              <h5 class="card-header">Registro detalle caja</h5>
              <div class="card-body"><br>
                <form action="javascript:void(0);" method="POST" id="detacajachicaform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <input id="detacajachica_id" type="hidden" name="detacajachica_id">
                    <input id="cajachica_id" type="hidden" name="cajachica_id">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                      <div class="select-wrapper">
                        <label for="gasto"></label>
                        <div id="selectorComprobante"> </div>
                        <span class="title" data-placeholder="Comprobante"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                      <div class="select-wrapper">
                        <label for="gasto"></label>
                        <div id="selectorCosto"></div>
                        <span class="title" data-placeholder="Servicio de costo"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                      <div class="select-wrapper">
                        <label for="val"></label>

                        <input id="detacajachicanumero" type="text" name="detacajachicanumero" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        <span class="title" data-placeholder="Numero serie"></span>

                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                      <div class="formulario__grupo" id="grupo__vd">
                        <div class="select-wrapper">
                          <label for="detacajachicavalor"></label>
                          <input id="detacajachicavalor" type="text" name="detacajachicavalor" data-parsley-trigger="change" autocomplete="off" class="form-control">
                          <span class="title" data-placeholder="Valor dinero"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">Valor dinero solo puede contener numeros.</p>
                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                    <div class="formulario__grupo" id="grupo__dcd">
                      <div class="select-wrapper">
                        <label for="detacajachicadescripcion"></label>
                        <input id="detacajachicadescripcion" name="detacajachicadescripcion" class="form-control"></input>
                        <span class="title" data-placeholder="Descripción"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">Descripcion solo puede contener letras,numeros y guion.</p>
                    </div>
                    </div>

                    <div class="form-group row text-right">
                      <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-3"><br>
                        <button type="submit" class="btn btn-space btn-primary">Agregar</button>
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
              <h5 class="card-header">Listado de los registros caja chica</h5>
              <div class="card-body">
                <button type="button" class="btn btn-space btn-success" onclick="app.guardarDetalleCaja()">Guardar</button>
                <div class="table table-responsive"><br>
                  <table class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>Comprobante</th>
                        <th>Numero</th>
                        <th>Descripción</th>
                        <th>Tipo de gasto</th>
                        <th>Valor $</th>
                        <!-- <th style="width: 40px">Opciones</th> -->
                      </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                  </table>
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
    </div><br><br>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/cajachica.js"></script>
    <script src="../src/formularioventa.js"></script>
</body>

</html>