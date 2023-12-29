<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(INGRESO_PRODUCTO); ?>


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
          <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
              <h2 class="pageheader-title">SELI LOGISTICS </h2>
              <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Página</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Producto</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div> -->
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
          <?php if (!empty($_SESSION['permisos'][INGRESO_PRODUCTO]['w']) || !empty($_SESSION['permisos'][INGRESO_PRODUCTO]['u'])) { ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header">Registro de producto</h5>
                <div class="card-body">
                  <form action="javascript:void(0);" method="POST" id="productoform" onsubmit="app.guardar()" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group">
                        <input type="hidden" id="producto_id" name="producto_id">
                        <input type="hidden" id="sucursal_identificador" name="sucursal_identificador" value=" <?php echo $_SESSION['sucursal_id']; ?>">
                        <input type="hidden" id="bodega_identificador" name="bodega_identificador" value=" <?php echo $_SESSION['bodega_id']; ?>">
                      </div>
                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="select-wrapper">
                          <div class="formulario__grupo-input ">
                            <input id="producto_fechaelaboracion" type="date" name="producto_fechaelaboracion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                            <label for="stock" class="formulario__label formulario-label"></label>
                            <span class="title" data-placeholder="Fecha elaboración"></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="select-wrapper">
                          <input id="producto_fechaexpiracion" type="date" name="producto_fechaexpiracion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                          <label for="stock"></label>
                          <span class="title" data-placeholder="Fecha expiración"></span>

                        </div>
                      </div>

                      <div class="col-md-4 mb-2"><br>
                        <div class="select-wrapper">
                          <div id="proveedor"></div>
                          <label for="proveedor"></label>
                          <span class="title" data-placeholder="Proveedor"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="col-md-4 mb-2"><br>
                        <div class="select-wrapper">
                          <div id="categoria"></div>
                          <label for="categoria"></label>
                          <span class="title" data-placeholder="Categoria"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="input-field">
                          <div class="" id="grupo__cp">
                            <div class="formulario__grupo-input">
                              <input id="producto_codigoserial" type="text" name="producto_codigoserial" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="producto_codigoserial" class="formulario__label formulario-label">Código producto:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo Código producto solo puede contener numeros.</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 mb-2"><br>
                        <div class="input-field">
                          <div class="" id="grupo__des">
                            <div class="formulario__grupo-input">
                              <input id="producto_descripcion" name="producto_descripcion" class="form-control formulario__input"></input>
                              <label for="producto_descripcion" class="formulario__label formulario-label">Descripción:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo Descripción solo puede contener letras,numeros y guion.</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="input-field">
                          <div class="" id="grupo__st">
                            <div class="formulario__grupo-input">
                              <input id="producto_stock" type="text" name="producto_stock" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="producto_stock" class="formulario__label formulario-label">Stock:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo Stock solo puede contener numeros enteros.</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2" hidden>
                        <label for="lote">Lote:</label>
                        <div id="lote"></div>
                      </div>
                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2" hidden>
                        <label for="Ubicaciones">Aumentar Stock en:</label>
                        <div id="ubicaciones"></div>
                      </div>
                      <!-- <div id="scanner-container"></div> -->

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="input-field">
                          <div class="formulario__grupo" id="grupo__pc">
                            <div class="formulario__grupo-input ">
                              <input id="producto_precio_compra" type="text" name="producto_precio_compra" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="producto_precio_compra" class="formulario__label formulario-label">Precio Compra:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo Precio Compra solo puede contener numeros.</p>
                          </div>
                        </div>
                      </div>


                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="input-field">
                          <div class="formulario__grupo" id="grupo__pv">
                            <div class="formulario__grupo-input ">
                              <input id="producto_precio_venta" type="text" name="producto_precio_venta" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="producto_precio_venta" class="formulario__label formulario-label">Precio Venta:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo Precio Venta solo puede contener numeros.</p>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6 mb-2">
                        <div class="select-wrapper">
                          <label for="bodega"></label>
                          <div id="tipo_impuesto"></div>
                          <span class="title" data-placeholder="Tipo Impuesto"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>
                      <div class="col-md-6 mb-2">
                        <div class="select-wrapper">
                          <label for="bodega"></label>
                          <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                            <option disabled='selected' selected='selected'>Seleccione</option>
                          </select>
                          <span class="title" data-placeholder="Porcentaje %"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                          <input type="text" id="porcentaje_iva_producto" name="porcentaje_iva_producto" hidden>
                        </div>
                      </div>

                      <div class="col-md-12 mb-2">

                        <input type="text" id="producto_imagenes" name="producto_imagenes" hidden>
                        <div class="imagen" style="width: 50%; float:left; margin-left:0%;">
                          <div class="file-field input-field">
                            <label for="foto" class="btn-small amber darken-l" style="margin-top: 10px; cursor: pointer;">
                              <span>Elige una imagen</span>
                              <div><img alt="" src="../utils/img/imagen.png" style="width: 25%; margin-top: 6px;" id="img-foto"></div>
                            </label>
                            <input type="file" name="foto" id="foto" style="display: none;" onchange="app.vista_preliminar(event)">
                            <div class="file-path-wrapper" hidden>
                              <input type="text" class="file-path" validate>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                        <button type="submit" class="btn btn-space btn-primary" title="Guardar" style="border-radius: 50%; width:50px; height:50px;margin-top:-15px;"><i class='fas fa-save'></i></button>
                        <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px;margin-top:-15px;" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
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
                          <label for="sucursal">Sucursal:</label>
                          <div id="producto_sucursal"></div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="bodega">Bodega:</label>
                          <select id="producto_bodegas" name="producto_bodegas" class='form-control'>
                            <option value="0" disabled='selected' selected='selected'>seleccione</option>
                          </select>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="ubicacion">Ubicación descripción:</label>
                          <input id="ubicacion_descripcion" type="text" name="ubicacion_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control">
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

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <br>
            <div class="card">
              <h5 class="card-header"> Listado de producto</h5>
              <div class="card-body">
                <div id="productos" class="table-responsive"></div>
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
    <br><br>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/productos.js"></script>
    <script src="../src/formularioproductos.js"></script>
</body>

</html>