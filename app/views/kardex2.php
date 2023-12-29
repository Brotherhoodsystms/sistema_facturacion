<?php
session_start();
set_time_limit(300);
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(KARDEX); ?>

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
          <!--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Ingreso de productos</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="productoform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="producto_id" name="producto_id">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="categoria">Categoria:</label>
                      <div id="categoria"></div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="lote">Lote:</label>
                      <div id="lote"></div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="proveedor">Proveedor:</label>
                      <div id="proveedor"></div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="sucursal">Sucursal:</label>
                      <div id="sucursal"></div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="bodega">Bodega:</label>
                      <select id="producto_bodegas" name="producto_bodegas" class='form-control' autofocus required>
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                      </select>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 nb-2 p-1">
                      <label for="ubicacion">Descripción Ubicación :</label>
                      <input id="ubicacion_descripcion" type="text" name="ubicacion_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
            <label for="serial">Código producto:</label>
            <input id="producto_codigoserial" type="text" name="producto_codigoserial" data-parsley-trigger="change" autocomplete="off" class="form-control">
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
            <label for="direccion">Descripción:</label>
            <textarea id="producto_descripcion" name="producto_descripcion" class="form-control"></textarea>
          </div>
          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 nb-2 p-1">
            <label for="precio">Precio x menor :</label>
            <input id="producto_precioxMe" type="text" name="producto_precioxMe" data-parsley-trigger="change" autocomplete="off" class="form-control">
          </div>
          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 nb-2 p-1">
            <label for="precio">Precio x mayor :</label>
            <input id="producto_precioxMa" type="text" name="producto_precioxMa" data-parsley-trigger="change" autocomplete="off" class="form-control">
          </div>
          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-2 p-1">
            <label for="stock">Stock:</label>
            <input id="producto_stock" type="number" name="producto_stock" data-parsley-trigger="change" autocomplete="off" class="form-control">
          </div>
          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-2 p-1">
            <label for="stock">Fecha elaboración:</label>
            <input id="producto_fechaelaboracion" type="date" name="producto_fechaelaboracion" data-parsley-trigger="change" autocomplete="off" class="form-control">
          </div>
          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-2 p-1">
            <label for="stock">Fecha expiración:</label>
            <input id="producto_fechaexpiracion" type="date" name="producto_fechaexpiracion" data-parsley-trigger="change" autocomplete="off" class="form-control">
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
            <button type="submit" class="btn btn-space btn-primary">Añadir</button>
          <button type="reset" class="btn btn-space btn-secondary" onclick="app.limpiarInputs()">Cancelar</button> 
        </div>
      </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <h5 class="card-header">Detalle de Ingreso Productos</h5>
        <div class="table table-responsive">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Código producto</th>
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
  <div class="modal-footer">
    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button class="btn btn-primary" onclick="app.guardar_historial_ubicacion()">Guardar</button>
  </div>
  </div>
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
            <div class="modal fade" id="exampleModalStocka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="stockforma1">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="hidden" id="producto_id_stocka1" name="producto_id_stocka1">
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
            <div class="modal fade" id="exampleModalProductoKardex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="stockforma">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="text" id="producto_id_stocka" name="producto_id_stocka" hidden>
                        </div>
                        <div class="descripcionKardex" style="width: 100%;">
                        <div class="categoriakardex" style="width: 32%; margin:0% 1%; float:left">
                          <label for="stock">Categoria:</label>
                          <div id="categoria"></div>
                          <input hidden id="categoria_kardex" type="text" name="categoria_kardex"  autocomplete="off" class="form-control" autofocus readonly>
                        </div>
                        <div class="codigoproductokardex" style="width: 32%; margin:0% 1%; float:left">
                          <label for="stock">Código Producto:</label>
                          <input id="codigoproducto_kardex" type="text" name="codigoproducto_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        </div>
                        <div class="codigoreferenciakardex" style="width: 32%; float:left">
                          <label for="stock">Código Referencia:</label>
                          <input id="codigoreferencia_kardex" type="text"  name="codigoreferencia_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                          </div>
                        </div>
                        <div class="descripcionkardex" style="width: 100%;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="stock">Descripción:</label>
                          <input id="descripcionproducto_kardex" type="text" name="descripcionproducto_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                        <div class="preciosKardex">
                        <div class="precioCompraKardex" style="width: 48%; margin:0% 1%; float:left">
                          <label for="stock">Precio compra:</label>
                          <input id="preciocompra_kardex" type="text" name="preciocompra_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        <div class="precioVentaKardex" style="width: 48%; margin: 0% 1%; float:left">
                          <label for="stock">Precio venta:</label>
                          <input id="precioventa_kardex" type="text"  name="precioventa_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                        <div class="tipoimpuestokardex">
                        <div class="tipodeImpuestoKardex" style="width: 32%; margin:0% 1%; float:left">
                          <label for="stock">Tipo impuesto:</label>
                          <div id="tipo_impuesto"></div>
                          <input hidden id="tipoimpuesto_kardex" type="text"  name="tipoimpuesto_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus readonly>
                        </div>
                        <div class="porcentajeImpuesto" style="width: 32%; margin:0% 1%; float:left">
                          <label for="stock">% Impuesto:</label>
                          <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                        <option disabled='selected' selected='selected'>Seleccione</option>
                         </select>
                          <input hidden id="valorimpuesto_kardex" type="text" name="valorimpuesto_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus readonly>
                        </div>
                        <div class="stockActualKardex" style="width: 32%; float:left">
                          <label for="stock">Stock Actual:</label>
                          <input id="stock_kardex" type="text" name="stock_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus readonly>
                        </div>
                        </div>
                        <div class="stockKardex">
                        <div class="stockTipoIngreso" style="width: 48%; margin:0% 1%; float:left">
                        <label for="stock">Tipo Ingreso:</label>
                        <select id="tipo_ingreso_stock" name="tipo_ingreso_stock" class='form-control' autofocus required>
                        <option disabled='selected' selected='selected'>Seleccione</option>
                        <option value="1">Aumentar Stock</option>
                        <option value="2">Disminuir Stock</option>
                        <option value="3">Ajustar Stock</option>
                         </select>
                        </div>
                        <div class="stockNuevoKardex" style="width: 48%; margin:0% 1%; float:left">
                          <label for="stock">Cantidad Ingresar:</label>
                          <input id="nuevoStock_kardex" type="text" name="nuevoStock_kardex" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" onclick="app.modificarProductoStock()"><i class="fas fa-save"></i> Actualizar</button>
                    <button class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalStockd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
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
          <!-- tabla detalle de ubicacionproducto -->
          <div class="">
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalDetalleUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1600">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kardex</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado kardex de Producto</h5>
              <div class="card-body">
                <div id="productosD4" class="table-responsive"></div>
              </div>
            </div>
          </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- tabla detalle -->
          <div class="">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCodigoserial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
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
                          <input type="hidden" id="barras_producto_id" name="barras_producto_id">
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
              <h5 class="card-header"> Listado kardex de Producto</h5>
              <div class="card-body">
                <div id="productos4" class="table-responsive"></div>
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
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/kardex2.js"></script> 
</body>

</html>