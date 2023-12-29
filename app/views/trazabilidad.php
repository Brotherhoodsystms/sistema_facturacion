<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../templates/header.php";
getpermisos(TRAZABILIDAD); ?>

<body>
  <!-- ============================================================== -->
  <!-- main wrapper -->
  <!-- ============================================================== -->
  <div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <?php require_once "../templates/navbar.php" ?>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <?php require_once "../templates/sidebar.php" ?>
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

        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
          <!-- end category revenue  -->
          <!-- ============================================================== -->
          <div class="">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubicacion</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="ubicacionform">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="hidden" id="producto_id_ubicacion" name="producto_id_ubicacion">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="sucursal2">Sucursal:</label>
                          <div id="producto_sucursal2"></div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="bodega2">Bodega:</label>
                          <select id="producto_bodegas2" name="producto_bodegas2" class='form-control'>
                            <option value="0" disabled='selected' selected='selected'>seleccione</option>
                          </select>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="ubicacion2">Ubicación descripción:</label>
                          <input id="ubicacion_descripcion2" type="text" name="ubicacion_descripcion2" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="app.guardarUbicacion()">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalStocka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="stockforma">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="hidden" id="producto_id_stocka" name="producto_id_stocka">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="stock">Capacidad stock:</label>
                          <input id="producto_capacidadstocka" type="number" name="producto_capacidadstocka" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="stock">Aumentar stock:</label>
                          <input id="producto_aumentarstock" type="number" min="1" name="producto_aumentarstock" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="app.modificarStocka()">Aumentar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalStockd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="stockformd">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="hidden" id="producto_id_stockd" name="producto_id_stockd">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="stock">Capacidad stock:</label>
                          <input id="producto_capacidadstockd" type="number" name="producto_capacidadstockd" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="stock">Disminuir stock:</label>
                          <input id="producto_disminuirstock" type="number" name="producto_disminuirstock" min="1" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-danger" onclick="app.modificarStockd()">Disminuir</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- tabla detalle -->
          <div class="">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCodigoserial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Código serial</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="codigoform">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="hidden" id="codigo_serial" name="codigo_serial">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1 text-center">
                          <svg id="mostrarCodigo"></svg>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-warning text-white" onclick="app.imprimir()">Imprimir</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- tabla kardex -->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado trazabilidad de Producto</h5>
              <div class="card-body">
                <div id="productos4" class="table-responsive"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                Copyright © 2022 Sistema Inventario. Todo los derechos reservados. Creado por: <a href="#">SELI LOGISTICS</a>.
              </div>
            </div>
          </div>
        </div>
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
    <?php require_once "../templates/footer.php" ?>
    <script src="../src/trazabilidad.js"></script>
</body>

</html>