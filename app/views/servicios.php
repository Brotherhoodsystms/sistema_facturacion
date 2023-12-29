<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php" ?>

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
              <h5 class="card-header">Ingreso de Servicios</h5>
              <div class="card-body">
                <a type="button" class="btn btn-space btn-success" href="../views/producto.php">Producto</a>
              </div>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="productoform">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="producto_id" name="producto_id">
                      <input type="hidden" id="historial_id" name="historial_id">
                    </div>


                    <!-- <div id="scanner-container"></div> -->
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <div class="formulario__grupo" id="grupo__cps">
                        <div class="select-wrapper">
                          <label for="producto_codigoserial"></label>
                          <input id="producto_codigoserial" type="text" onkeyup="app.obtenerProducto()" name="producto_codigoserial" maxlength="30" data-parsley-trigger="change" autocomplete="off" class="form-control">
                          <span class="title" data-placeholder="Código producto"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">Código producto solo puede contener numeros,letras y guiones.</p>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2 p-1">
                      <div class="formulario__grupo" id="grupo__pd">
                        <div class="select-wrapper">
                          <label for="producto_descripcion"></label>
                          <input id="producto_descripcion" name="producto_descripcion" class="form-control"></input>
                          <span class="title" data-placeholder="Descripción"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">Descripción solo puede contener numeros,letras y guiones.</p>
                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <div class="select-wrapper">
                        <label for="producto_stock"></label>
                        <input id="producto_stock" type="number" name="producto_stock" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        <span class="title" data-placeholder="Cantidad"></span>
                      </div>

                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 nb-2 p-1">
                    <div class="formulario__grupo" id="grupo__pv">
                      <div class="select-wrapper">
                        <label for="producto_precioxMa"></label>
                        <input id="producto_precioxMa" type="text" name="producto_precioxMa" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        <span class="title" data-placeholder="Precio de venta"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">Precio de venta solo puede contener numeros.</p>
                    </div>
                    </div>



                    <div class="col-md-6 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="bodega"></label>
                        <div id="tipo_impuesto"></div>
                        <span class="title" data-placeholder="Tipo impuesto"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="bodega"></label>
                        <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                          <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        </select>
                        <span class="title" data-placeholder="Porcentaje %"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>

                      </div>
                    </div>


                  </div>
                </form>
              </div>
            </div>

            <div class="modal-footer">

              <button class="btn btn-primary" onclick="app.guardar()">Guardar</button>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- end category revenue  -->

          <!-- Modal -->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de Servicios</h5>
              <div class="card-body">
                <div id="tbody" class="table-responsive"></div>
              </div>
            </div>
          </div>

        </div>
        <!-- tabla kardex
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado kardex de Producto</h5>
              <div class="card-body">
                <div id="productos44" class="table-responsive"></div>
              </div>
            </div>
          </div>
        </div>
         -->
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
    <script src="../src/servicios.js"></script>
    <script src="../src/formulario.js"></script>

</body>

</html>