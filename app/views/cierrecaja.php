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
                    <li class="breadcrumb-item active" aria-current="page">Cierre Caja</li>
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
            <div class="cierrecaja" style="width: 100%;">
              <div class="card">
                <h5 class="card-header">Cierre Caja</h5>
                <div class="card-body">
                  <form action="javascript:void(0);" method="POST" id="cierreform" onsubmit="app.guardar()">
                    <input type="hidden" id="usuario_id" name="usuario_id" value=" <?php echo $_SESSION['idUser']; ?>">
                    <input type="hidden" id="cierrecaja_id" name="cierrecaja_id">
                    <div class="informacioncierre" style="width: 100%; float:left;">
                      <div class="listamovimientoscierrecaja" style="width: 50%; float:left;">
                        <div id="listamovimientos" class="listamovimientos" class="table-responsive"></div>
                      </div>
                      <div class="totalventascierrecaja" style="width: 50%; float:left">
                        <table style="margin-left: 25%; margin-top:5%;">
                          <tbody>
                            <tr>
                              <td> <label for="ventas" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Ventas </label></td>
                              <td><label for=""></label></td>
                              <td style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body"> $</td>
                              <td><input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="total_ventas_cierrecaja" id="total_ventas_cierrecaja" readonly></td>
                            </tr>
                            <tr>
                              <td><label for="movimientos" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Caja Inicial </label></td>
                              <td><input type="text" style="border-color: transparent; width:1%" readonly></td>
                              <td style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body"> $</td>
                              <td><input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="caja_inicial_cierrecaja" id="caja_inicial_cierrecaja" readonly></td>
                            </tr>
                            <tr>
                              <td><label for="movimientos" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Movimientos </label></td>
                              <td><input type="text" style="border-color: transparent; width:1%" readonly></td>
                              <td style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body"> $</td>
                              <td><input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="total_movimientos_cierrecaja" id="total_movimientos_cierrecaja" readonly></td>
                            </tr>
                            <tr>
                              <td><label for="total" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Total </label></td>
                              <td><label for=""></label></td>
                              <td style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body"> $</td>
                              <td><input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="total_cierrecaja" id="total_cierrecaja" readonly></td>
                            </tr>
                          </tbody>
                        </table>
                        <!--
                      <div class="totalventas" style="margin-left: 25%;">
                          <label for="ventas" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Ventas: </label>
                          <input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="total_ventas_cierrecaja" id="total_ventas_cierrecaja" value="$ 11.00" readonly>
                      </div>
                        <br>
                      <div class="totalmovimientos" style="margin-left: 25%;">
                        <label for="movimientos" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Movimientos: </label>
                        <input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="total_movimientos_cierrecaja" id="total_movimientos_cierrecaja" value="$ 1.00" readonly>
                      </div>    
                        <br>
                    <div class="totalcierrecaja" style="margin-left: 25%;">
                        <label for="total" style="margin: 0% 2%; font-size:x-large; font-family:-webkit-body">Total: </label>
                        <input type="text" style="border-color: transparent; font-size:x-large; width:50%" name="total_cierrecaja" id="total_cierrecaja" value="$ 10.00" readonly>
                    </div>
                    -->
                      </div>
                    </div>
                    <br>
                    <div class="entregadocierrecaja" style="width: 100%; float:left; margin:2% 0% 0% 0%">
                      <hr>
                      <center><label for="entrega" style=" font-size: large;"><i class="fa fa-user"></i> Información Entrega</label></center>
                      <hr>
                      <div class="fechacaja" style="width: 22%; float:left; margin: 0% 1%"><br>
                        <div class="select-wrapper">
                          <label for="fechaentrega"></label>
                          <input type="datetime-local" class="form-control" name="fecha_entregada_cierrecaja" id="fecha_entregada_cierrecaja">
                          <span class="title" data-placeholder="Fecha cierre"></span>

                        </div>
                      </div>

                      <div class="usuariocaja" style="width: 22%; float:left; margin: 0% 1%"><br>
                        <div class="formulario__grupo" id="grupo__entre">
                          <div class="select-wrapper">
                            <label for="usuario_entregado_cierrecaja"></label>
                            <input type="text" name="usuario_entregado_cierrecaja" class="form-control" id="usuario_entregado_cierrecaja">
                            <span class="title" data-placeholder="Entregado a"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Entregado a solo puede contener letras.</p>
                        </div>
                      </div>

                      <div class="efectivocaja" style="width: 22%; float:left; margin: 0% 1%"><br>
                        <div class="formulario__grupo" id="grupo__efec">
                          <div class="select-wrapper">
                            <label for="efectivo_entregado_cierrecaja"></label>
                            <input type="text" name="efectivo_entregado_cierrecaja" class="form-control" id="efectivo_cierrecaja_cierrecaja">
                            <span class="title" data-placeholder="Efectivo de"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Efectivo de solo puede contener numeros.</p>
                        </div>
                      </div>

                      <div class="observacioncaja" style="width: 22%; float:left; margin: 0% 1%"><br>
                      <div class="formulario__grupo" id="grupo__obs">
                          <div class="select-wrapper">
                            <label for="observacion_entregado_cierrecaja"></label>
                            <input type="text" name="observacion_entregado_cierrecaja" class="form-control" id="observacion_cierrecaja_cierrecaja">
                            <span class="title" data-placeholder="Observación"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Observación solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>
                      <br>
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                        <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; float:right; width:50px; height:50px;margin-top:8px;margin-left:6px;" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
                        <button type="submit" class="btn btn-space btn-primary" title="Guardar" style="border-radius: 50%; float:right; width:50px; height:50px;margin-top:8px;"><i class="fa fa-save"></i></button>
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
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->

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
      <script src="../src/cierrecaja.js"></script>
      <script src="../src/formularioegresoBodega.js"></script>

</body>

</html>