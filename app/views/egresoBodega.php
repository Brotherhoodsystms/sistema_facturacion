<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(EGRESO_PRODUCTO); ?>

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Inventario</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Egreso Bodega</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <div class="">
          <!-- Modal -->
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Egreso de mercaderia</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="ubicacionform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12"><br>
                      <div class="formulario__grupo" id="grupo__cp">
                        <div class="select-wrapper">
                          <label for="producto_codigoserial" class="formulario__label formulario-label"></label>
                          <div class="input-group">
                            <input id="producto_codigoserial" name="producto_codigoserial" type="text" onkeyup="app.obtenerProducto()" data-parsley-trigger="change" autofocus autocomplete="off" class="form-control formulario__input">
                            <i class="formulario__validacion-estadocod fa-solid fa-circle-xmark"></i>

                            <div class="input-group-append">

                              <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModalProductos" title="Lista" onclick="app.modallistaProducto()">
                                <i class="fas fa-search"></i>

                              </button>
                            </div>
                          </div>
                          <span class="title" data-placeholder="Código producto"></span>
                          <p class="formulario__input-error">El campo Código producto solo puede contener letras y numeros.</p>
                          <div id="codigoMensaje"></div>
                        </div>
                      </div>
                    </div>


                    <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"><br>
                      <div class="formulario__grupo" id="grupo__dp">
                        <div class="select-wrapper">
                          <input id="descripcion_producto" type="text" name="descripcion_producto" autocomplete="on" class="form-control formulario__input">
                          <label for="descripcion_producto"></label>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          <span class="title" data-placeholder="Descripción del Producto"></span>
                        </div>
                        <p class="formulario__input-error">El campo Descripción del Producto solo puede contener letras y numeros.</p>
                      </div>
                    </div>

                    <!-- ... Otras secciones del formulario ... -->
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="producto_stock"></label>
                        <input id="producto_stock" type="number" name="producto_stock" autocomplete="on" class="form-control formulario__input" style="font-weight:bold; background-color: white;" readonly>
                        <span class="title" data-placeholder="Stock"></span>
                      </div>
                    </div>


                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__pc">
                      <div class="select-wrapper">
                        <label for="producto_comprar"></label>
                        <input id="producto_comprar" type="text" name="producto_comprar" autocomplete="on" class="form-control formulario__input">
                        <span class="title" data-placeholder="Cantidad"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Cantidad solo puede contener numeros enteros.</p>
                    </div>
                    </div>

                    <div class="col-md-4 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="sucursal"></label>
                        <div id="ubicacion_sucursal_o">
                          <input id="" type="text" name="producto_comprar" autocomplete="on" class="form-control">
                          <span class="title" data-placeholder="Sucursal Origen"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="sucursal"></label>
                        <div id="ubicacion_sucursal_r"></div>
                        <span class="title" data-placeholder="Sucursal Destino"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                      <div class="select-wrapper">
                        <label for="bodega"></label>
                        <div id="ubicacion_bodega_o">
                          <input id="" type="text" name="producto_comprar" autocomplete="on" class="form-control">
                          <span class="title" data-placeholder="Bodega Origen"></span>
                        </div>
                        <!-- <div id=" ubicacion_bodega_r"></div> -->
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                      <div class="select-wrapper">
                        <label for="bodega"></label>
                        <select id="ubicacion_bodega_r" name="ubicacion_bodega_r" class='form-control'>
                          <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        </select>
                        <span class="title" data-placeholder="Bodega Destino"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                        <!-- <div id="ubicacion_bodega_r"></div> -->
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                      <div class="select-wrapper">
                        <label for="bodega"></label>
                        <select id="ubicacion_descripcion_o" name="ubicacion_descripcion_o" class='form-control' onChange='app.obtenerCantidadUbicacion()'>
                          <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        </select>
                        <!-- <div id="ubicacion_bodega_r"></div> -->
                        <span class="title" data-placeholder="Ubicacion Origen"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                      <div class="select-wrapper">
                        <label for="ubicacion"></label>
                        <input id="ubicacion_descripcion" type="text" name="ubicacion_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        <span class="title" data-placeholder="Ubicacion Destino"></span>

                      </div>
                      _
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6 text-right">
                      <button type="submit" class="btn btn-primary" title="Guardar">
                        <i class="fa fa-save"></i> Guardar
                      </button>
                      <button type="reset" class="btn btn-secondary" title="Cancelar" src="../views/egresoBodega.php">
                        <i class="fa fa-times"></i> Cancelar
                      </button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
            <br>
            <div class="card">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="card">
                    <h5 class="card-header">Detalle del producto a vender</h5>
                    <div class="table table-responsive">
                      <table class="table table-bordered text-center">
                        <thead>
                          <tr>
                            <th>Código producto</th>
                            <th>Descripción </th>
                            <th>Cantidad </th>
                            <th>Bodega Destino</th>
                            <th>Ubicacion Destino</th>
                            <th style="width: 40px">Opciones</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                        <tbody id="tbodydetalle">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button id="btn_guardarE" class="btn btn-primary" onclick="app.guardar_historial_ubicacion()">Guardar</button>
              <button id="btn-imprimir" class="btn btn-success" onclick="app.imprimirEgresos()">Imprimir</button>

            </div>

          </div>
        </div>



        <!-- ============================================================== -->

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
      <!-- modulo de lista de productos -->
      <div class="">
        <!-- Modal -->
        <form action="javascript:void(0);" method="POST" id="permisosform" ">
                <div class=" form-row">
          <div class="form-group">
            <div class="modal fade" id="exampleModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                      <h5 class="card-header"> Listado de Productos</h5>
                      <div class="card-body">
                        <div id="productosl" class="table-responsive"></div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- end main wrapper -->
  <!-- ============================================================== -->
  <!-- Optional JavaScript -->
  <?php require_once "../plantilla/lower.php" ?>
  <script src="../src/egresoBodega.js"></script>
  <script src="../src/formularioegresoBodega.js"></script>
</body>

</html>