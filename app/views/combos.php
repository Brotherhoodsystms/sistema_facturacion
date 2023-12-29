<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}

require_once '../plantilla/header.php';
getpermisos(COMBOS);

//dep($_SESSION);
?>


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
    <?php require_once '../plantilla/sidebar.php'; ?>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper" id="containerbody">
      <div class="container-fluid ">
        <div class="row">

          <div class="detalleproductosventa" style="width: 48%; float:left; margin:0% 1%">
            <div class="card" style="width: 100%;">
              <div class="categoriacombo" style="width: 100%; margin:2% 0% 2% 4%">
                <div class="categoria_combo" style="width: 45%; float: left; margin: 0% 1%"><br>
                  <div class="select-wrapper">
                    <label for="categoriacombo"></label>
                    <div id="categoria"></div>
                    <span class="title" data-placeholder="Categoria"></span>
                    <i class="fa-solid fa-chevron-down icon"></i>
                  </div>
                </div>


                <div id="codigo_combo" class="codigo_combo" style="width: 45%; float: left;"><br>
                <div class="formulario__grupo" id="grupo__cc">
                  <div class="select-wrapper">
                    <label for="codigo_combo"></label>
                    <input type="text" name="codigo_combo" id="codigo_combo" class="form-control formulario__input">
                    <span class="title" data-placeholder="Codigo combo"></span>
                    <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                  </div>
                  <p class="formulario__input-error">El campo Codigo combo solo puede contener numeros.</p>
                  </div>
                </div>
              </div>

              <div id="nombrecombo" class="nombrecombo" style="width: 91%; margin: 0% 0% 2% 5%;"><br>
                <div class="formulario__grupo" id="grupo__combo">
                  <div class="select-wrapper">
                    <label for="nombre_producto_combo"></label>
                    <input id="nombre_producto_combo" type="text" name="nombre_producto_combo" data-parsley-trigger="change" autocomplete="on" class="form-control formulario__input">
                    <span class="title" data-placeholder="Nombre combo"></span>
                    <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                  </div>
                  <p class="formulario__input-error">El campo Nombre combo solo puede contener letras.</p>
                </div>
              </div>


              <div class="impuestocombo" style="width: 100%; margin:0% 0% 4% 4%">
                <div class="tipo_impuesto" style="width: 45%; float: left; margin: 0% 1%"><br>
                  <div class="select-wrapper">
                    <label for="tipoimpuesto"></label>
                    <div id="tipo_impuesto"></div>
                    <span class="title" data-placeholder="Tipo impuesto"></span>
                    <i class="fa-solid fa-chevron-down icon"></i>
                  </div>
                </div>

                <div class="procentaje_impuesto" style="width: 45%; float: left;"><br>
                  <div class="select-wrapper">
                    <label for="porcentajeiva"></label>
                    <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                      <option disabled='selected' selected='selected'>Seleccione</option>
                    </select>
                    <span class="title" data-placeholder="Porcentaje %"></span>
                    <i class="fa-solid fa-chevron-down icon"></i>
                  </div>
                </div>
              </div>
              <br>
            </div>

            <br>
            <div class="card" style="width: 100%; float:left;">
              <h5 hidden class="card-header">Producto a Vender<button id='ocultarProductoVenta' onclick='app.ocultarProductoVenta()' class="btn btn-success btn-xs" hidden>-</button><button onclick='app.visualizarProductoVenta()' id='visualizarProductoVenta' class="btn btn-success btn-xs">+</button></h5>
              <div class="card-body" id="div_producto_venta">
                <div class="card">
                  <h5 class="card-header"> Listado de productos</h5>
                  <div class="card-body">
                    <input type="text" hidden id="sucursal_identificador" value="<?php echo $_SESSION['sucursal_id']; ?>">
                    <input type="text" hidden id="bodega_identificador" value="<?php echo $_SESSION['bodega_id'] ?>">
                    <div id="productosListado" class="table-responsive"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="detallefacturaventa" id='detallefactura' style="width: 48%; float:left; margin:0% 1%">
            <div class="card">
              <!--/ /todo::detalle factura temporal/factura-->
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id='comboProducto'>
                  <div class="card">
                    <h5 class="card-header"> Detalle productos combo</h5>
                    <div class="table table-responsive" style="font-size: 10pt;text-align: center;" id="tbody">
                    </div>
                  </div>
                  <hr>
                  <div class="card">
                    <h5 class="card-header">Detalle total combo</h5>
                    <div class="card-body">
                      <form action="javascript:void(0);" method="POST" id="facturaform">
                        <div class="row">
                          <div class="form-group">
                            <input type="hidden" id="factura_id" name="factura_id" value="0" hidden>
                          </div>
                          <div class="detallecomboproducto">
                            <div class="valoresapagar">
                              <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float:left; margin:0% 1%">
                                <label for="precio">Subtotal:</label>
                                <input id="combos_subtotal" type="number" name="combos_subtotal" autocomplete="on" class="form-control text-primary" placeholder="0.00" style="font-size:17pt;" readonly>
                              </div>
                              <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float:left; margin:0% 1%">
                                <label for="impuestos">Impuestos:</label>
                                <input id="combos_iva" type="number" name="combos_iva" autocomplete="on" class="form-control text-primary" placeholder="0.00" style="font-size:17pt;" readonly>
                              </div>
                              <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float:left; margin:0% 1%">
                                <label for="comprar">TOTAL:</label>
                                <input id="combos_total" type="number" name="combos_total" autocomplete="on" class="form-control text-success" placeholder="0.00" style="font-size:17pt;">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class=" row">
                          <div class="col-sm-6 pb-6 pb-sm-4 pb-lg-0 pr-0">
                          </div>
                          <div class="col-sm-6 pl-0 p-2">
                            <p id="btn-guardarFac" class="text-right">
                              <button id="btn-guardarFact" class="btn btn-space btn-primary btn-sm" title="Guardar" style="border-radius: 50%; width:50px; height:50px" onclick="app.guardar()"><i class="fa fa-save"></i></button>
                              <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
                            </p>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <br>
        <div class="card" style="width: 100%;">
          <h5 class="card-header"> Listado de combos</h5>
          <div class="card-body">
            <div id="productosListadoCombos" class="table-responsive"></div>
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
      <!-- ============================================================== -->
      <!-- end main wrapper -->
      <!-- ============================================================== -->

      <div class="modal fade" id="exampleModalCombos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Combos</h5>
              <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header"> Listado de Productos</h5>
                <div class="card-body">
                  <div id="productosCombos" class="table-responsive"></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <br><br>
      <div class="modal fade" id="exampleModalNuevaCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
              <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
            <div class="modal-body">
              <form action="javascript:void(0);" method="POST" id="stockformnuevacantidadcombos">
                <div class="form-row">
                  <div class="form-group">
                    <input type="hidden" id="temp_combos_id_add" name="temp_combos_id_add">
                    <input type="hidden" id="temp_combos_precio_add" name="temp_combos_precio_add">
                  </div>
                  <div class="actualizarCombosProducto" style="width: 100%;">
                    <div class="cantidadproducto" style="width: 48%; margin:0% 1%; float:left">
                      <label for="cantidad">Cantidad Actual</label>
                      <input id="cantidadactual_combos" type="text" name="cantidadactual_combos" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus readonly>
                    </div>
                    <div class="nuevaCantidadCombosProducto" style="width: 48%; margin:0% 1%; float:left">
                      <label for="nuevacantidad">Nueva Cantidad</label>
                      <input id="cantidadnueva_combos" type="text" name="cantidadnueva_combos" placeholder="Ingresar nueva cantidad" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" onclick="app.modalnuevaCantidadStock()"><i class="fas fa-save"></i> Guardar</button>
              <button class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Optional JavaScript -->
    <?php require_once '../plantilla/lower.php'; ?>
    <script src="../src/combos.js"></script>
    <script src="../src/formulariocombo.js"></script>
</body>

</html>