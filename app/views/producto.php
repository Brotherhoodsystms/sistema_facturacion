<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once '../plantilla/header.php';
getpermisos(INGRESO_PRODUCTOS);
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
            <div class="card" style="width: 50%; float:left">
              <div class="tipoFacturaProductos">
                <div class="card-body ingresoProducto-card" style="width: 50%; float: left; background-color: #f8f9fa;  border-radius: 5px; padding: 10px;">
                  <h5 class="card-header ingresoProducto-header" style="background-color: #007bff; color: #fff; border-bottom: 0; border-radius: 5px 5px 0 0;">Ingreso de Producto</h5>
                </div>

                <div class="card-body" style="width: 50%; float:right">
                  <a type="button" class="btn btn-space btn-success" style="float: right;" href="../views/servicios.php">Servicios</a>
                </div>
              </div>
              <div class="card-body">
                <form action="javascript:void(0);" enctype="multipart/form-data" method="POST" id="productoform" onsubmit="app.guardar()" style="margin-top: -30px;">
                  <label hidden>Id proveedor: </label>
                  <input id="proveedor_identificador" name="proveedor_identificador" value="20" hidden readonly>
                  <div class="form-row">
                    <div class="form-group" hidden>
                      <input type="hidden" id="producto_id" name="producto_id">
                      <input type="input" id="historial_id" name="historial_id" hidden>
                      <input type="text" id="producto_imagenes" name="producto_imagenes" value="Sin Imagen" hidden>
                    </div>
                    <hr>
                    <div class="descripciondatos" style="width: 100%; margin: 0% 0% 2%;"><br>
                      <div class="CodigoproductoAuto" style="width: 50%; float:left">

                        <label for="codigo">Código Barras:</label>
                        <input type="checkbox" id="codAutomatico" name="codAutomatico" onclick="app.validarCheck()">
                      </div>
                      <div class="ubicacionProductoIngreso" style="width: 50%; float:left">
                        <div class="select-wrapper">
                          <label for="ubicacion"></label>
                          <input id="ubicacion_descripcion" value="PUNTO-VENTA" placeholder="Ubicación producto" type="text" maxlength="20" name="ubicacion_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                          <span class="title" data-placeholder="Ubicación"></span>
                        </div>
                      </div>
                    </div>

                    <div class="encabezadosucursal" hidden>
                      <div class="sucursalProductoIngreso" style="width: 32%; margin:0% 1%; float:left">
                        <label for="sucursal">Sucursal:</label>
                        <input type="text" id="sucursal_identificador" name="sucursal_identificador" value=" <?php echo $_SESSION['sucursal_id']; ?>">
                        <div hidden id="sucursal"></div>
                      </div>
                      <div class="bodegaProductoIngreso" style="width: 32%; margin:0% 1%; float:left">
                        <label for="bodega">Bodega:</label>
                        <input type="text" id="bodega_identificador" name="bodega_identificador" value=" <?php echo $_SESSION['bodega_id']; ?>">

                        <select hidden id="producto_bodegas" name="producto_bodegas" class='form-control' autofocus required>
                          <option value="0" disabled='selected' selected='selected'>Seleccione</option>
                        </select>
                      </div>

                    </div>
                    <br>
                    <div class="encabezadoproducto" style="width: 100%;margin: 0% 0% 2%;"><br>

                      <div class="categoriaProductoIngreso" style="width: 32%; margin:0% 1%; float:left">
                        <div class="select-wrapper">
                          <label for="categoria"></label>
                          <div id="categoria"></div>
                          <span class="title" data-placeholder="Categoria"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>

                        </div>
                      </div>

                      <div class="codigoProductoIngreso" style="width: 32%; margin:0% 1%; float:left">
                        <div class="select-wrapper">
                          <label for="serial"></label>

                          <div class="input-group">
                            <input id="producto_codigoserial" type="text" onkeyup="app.obtenerProducto()" name="producto_codigoserial" maxlength="30" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                            <div class="input-group-append">
                              <button type="button" class="btn btn-warning" data-toggle='modal' data-target='#exampleModalProductos' title='Lista' onclick="app.modallistaProducto()">
                                <i class="fas fa-search" style="color:white;"></i>
                              </button>
                            </div>
                          </div>
                          <span class="title" data-placeholder="Código producto"></span>
                        </div>
                      </div>

                      <div class="codigoReferenciaProductoIngreso" style="width: 30%; float:left">

                        <div class="formulario__grupo" id="grupo__cr">
                          <div class="select-wrapper">
                            <label for="codigoReferenciaProducto"></label>
                            <input id="codigoReferenciaProducto" placeholder="Código opcional" type="text" name="codigoReferenciaProducto" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Código Referencia"></span>
                          </div>
                          <p class="formulario__input-error">El campo Código Referencia solo puede contener numeros.</p>
                        </div>
                      </div>
                    </div>

                    <br>
                    <div class="descripcionproducto" style="width: 100%;margin: 0% 0% 2%;"><br>


                      <div class="descripcionProductoIngreso" style="width: 70%; margin:0% 1%; float:left">
                        <div class="formulario__grupo" id="grupo__des">
                          <div class="select-wrapper">
                            <label for="producto_descripcion"></label>
                            <input id="producto_descripcion" name="producto_descripcion" class="form-control formulario__input"></input>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Descripción"></span>
                          </div>
                          <p class="formulario__input-error">El campo Descripción solo puede contener letras,numeros y guiones.</p>

                        </div>

                      </div>


                      <div class="cantidadProductoIngreso" style="width: 25%; float:left">
                        <div class="formulario__grupo" id="grupo__cant">
                          <div class="select-wrapper">
                            <label for="producto_stock"></label>
                            <input id="producto_stock" type="text" name="producto_stock" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Cantidad"></span>
                          </div>
                          <p class="formulario__input-error">El campo Cantidad solo puede contener numeros enteros.</p>
                        </div>
                      </div>
                    </div>
                    <br>

                    <div class="costosProductos" style="width: 100%;margin: 0% 0% 2%;"><br>

                      <div class="precioCompraProductoIngreso" style="width: 23%; margin:0% 1%; float:left">
                        <div class="formulario__grupo" id="grupo__pc">
                          <div class="select-wrapper">
                            <label for="producto_precioxMe"></label>
                            <input id="producto_precioxMe" type="text" name="producto_precioxMe" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <span class="title" data-placeholder="Precio compra"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Precio compra solo puede contener numeros.</p>
                        </div>

                      </div>

                      <div class="precioVentaProductoIngreso" style="width: 23%; margin:0% 1%; float:left">
                        <div class="formulario__grupo" id="grupo__pv">
                          <div class="select-wrapper">
                            <label for="producto_precioxMa"></label>
                            <input id="producto_precioxMa" type="text" name="producto_precioxMa" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            <span class="title" data-placeholder="Precio venta"></span>
                          </div>
                          <p class="formulario__input-error">El campo Precio venta solo puede contener numeros.</p>
                        </div>
                      </div>

                      <div class="tipoImpuestoProductoIngreso" style="width: 23%; margin:0% 1%; float:left">
                        <div class="select-wrapper">
                          <label for="bodega"></label>
                          <div id="tipo_impuesto"></div>
                          <span class="title" data-placeholder="Tipo Impuesto"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="porcentajeProductoIngresos" style="width: 23%; float:left">
                        <div class="select-wrapper">
                          <label for="bodega"></label>
                          <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                            <option disabled='selected' selected='selected'>seleccione</option>
                          </select>
                          <span class="title" data-placeholder="Porcentaje %"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>

                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                    <div class="imagen" style="width: 50%; float:left; margin-left:2%">
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
                    <!--
                 <script>
                                function actualizarImg() {
                                    const $inputfile = document.querySelector("#selImg"),
                                        $imgProducto = document.querySelector("#imagen");
                                    // Escuchar cuando cambie
                                    $inputfile.addEventListener("change", () => {
                                        // Los archivos seleccionados, pueden ser muchos o uno
                                        const files = $inputfile.files;
                                        // Si no hay archivos salimos de la función y quitamos la imagen
                                        if (!files || !files.length) {
                                            $imgProducto.src = "";
                                            return;
                                        }
                                        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                                        const archivoInicial = files[0];
                                        // Lo convertimos a un objeto de tipo objectURL
                                        const Url = URL.createObjectURL(archivoInicial);
                                        // Y a la fuente de la imagen le ponemos el objectURL
                                        $imgProducto.src = Url;
                                        console.log($imgProducto.src);
                                    });
                                }
                            </script> 
                              -->

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="categoria">Total Factura:</label>
                      <input id="total_factura1" type="text" name="total_factura1" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="lote">Lote:</label>
                      <div id="lote"></div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="proveedor">Proveedor:</label>
                      <button type="button" class="btn btn-success btn-xs" data-toggle='modal' data-target='#exampleModalProveedor' title='Lista' data-toggle='modal' onclick='app.modallistaProveedor()'><i class="fas fa-search"></i></button>
                      <div id="proveedor"></div>

                    </div>

                    <!-- <div id="scanner-container"></div> -->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-2 p-1" hidden>
                      <label for="stock">Fecha elaboración:</label>
                      <input id="producto_fechaelaboracion" type="date" name="producto_fechaelaboracion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-2 p-1" hidden>
                      <label for="stock">Fecha expiración:</label>
                      <input id="producto_fechaexpiracion" type="date" name="producto_fechaexpiracion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                      <button type="submit" class="btn btn-space btn-primary" style="margin-top: -10%;float:right;background: #ffc107;border-radius:10%; border-color: ffc107; border-color:aliceblue"><i class='fas fa-plus'> </i> Añadir</button>
                      <!--<button type="reset" class="btn btn-space btn-secondary" onclick="app.limpiarInputs()">Cancelar</button> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row" style="width: 50%; float:right">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                  <div class="numeroFactura">
                    <br>

                    <div class="numeroFacturaIngreso" style="width: 70%; float:left">
                      <div class="select-wrapper">
                        <input id="id_facturaCompra" placeholder="Ingresar número factura" style="width: 80%; margin:0% 8%; " type="text" name="id_facturaCompra" data-parsley-trigger="change" autocomplete="off" class="form-control">
                        <span class="title" data-placeholder="Nº Factura"></span>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="proveedorNombre">
                    <div class="nombreEtiquetaProveedor" style="width: 30%; float: right; display: flex; align-items: center;">
                      <label for="proveedor" style="margin-left: -20px; margin-right: 6px; z-index: 1;">Proveedor:</label>
                      <div class="btn-group" role="group" aria-label="Botones de proveedor">
                        <button type="button" class="btn btn-warning btn-sm" style="border-radius: 50%; width: 30px; height: 30px; background: #ffc107; border-color: #ffc107;" data-toggle='modal' data-target='#exampleModalNuevoProveedor' title='Nuevo' data-toggle='modal'><i class="fas fa-plus" style="color: white; font-size: 12px;"></i></button>
                        <button type="button" class="btn btn-success btn-sm" style="border-radius: 50%; width: 30px; height: 30px; background: #5969ff; border-color: #5969ff; margin-left: 5px;" data-toggle='modal' data-target='#exampleModalProveedor' title='Lista' data-toggle='modal' onclick='app.modallistaProveedor()'><i class="fas fa-search" style="color: white; font-size: 12px;"></i></button>

                      </div>

                    </div>



                    <div class="proveedorIngreso" style="width: 70%; float:right">
                      <div class="proveedor" style="width: 92%; float:right">
                        <label for="">Razon Social: </label><input id="razonSocialProveedor" value="Consumidor Final" style="border-color: transparent; font-weight:bold;" readonly><br />
                        <label for="">RUC: </label><input id="rucProveedor" style="border-color: transparent;  font-weight:bold;" value="9999999999" readonly><br />
                        <label for="">Dirección: </label><input id="direccionProveedor" value="999999999" style="border-color: transparent; font-weight:bold;" readonly><br />
                        <label hidden>correo proveedor: </label><input id="emailProveedor" value="sistemas@selilogistics.com" hidden readonly>
                        <button id="btn-guardaringreso" class="btn btn-primary" onclick="app.guardar_historial_ubicacion()"><i class='fas fa-save' style="font-size: 18px;"></i></button>
                        <button id="btn-imprimir" class="btn btn-success" onclick="app.imprimirIngreso()"><i class='fas fa-print' style="font-size: 18px;"></i></button>

                        <br><br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="width: 50%; float:right">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br>
                <div class="card">
                  <div class="totalfacturaingresoproducto" style="width: 100%;">
                    <div class="totalfacturaproducto" style="width: 48%; margin: 0% 1%; float: right; background-color: #f8f9fa;  border-radius: 5px; padding: 10px;">
                      <div class="select-wrapper">
                        <label for="comprar" style="font-size: 14px; font-weight: bold; margin-top: 6px; color: #EA2C59;">TOTAL:</label>
                        <input type="number" id="total_factura" name="total_factura" autocomplete="on" class="form-control text-success" placeholder="0.00" style="font-size: 17pt; border-radius: 5px; padding: 5px; border-color: #EA2C59; font-weight:bold; background-color: #fff; color:#EA2C59 !important;" readonly>
                      </div>
                    </div>

                    <div class="etiquetaproducto" style="width: 48%; margin: 0% 1%; float: left; background-color: #f8f9fa; border-radius: 5px; padding: 10px;">
                      <h5 class="card-header ingresoDetalle-header" style="font-size: 18px; font-weight: bold; background-color: #007bff; color: #fff; border-bottom: 0; border-radius: 5px 5px 0 0;">Detalle de Ingreso Productos</h5>
                    </div>


                  </div>
                  <div class="table table-responsive" id="tableDetalleProductos">

                    <!-- <table class="table table-bordered text-center" id="tableDetalleProductos">
                      <thead>
                        <tr>
                          <th>Código producto</th>
                          <th>Descripción producto</th>
                          <th>Cantidad </th>
                          <th>Bodega Destino</th>
                          <th>Ubicacion Destino</th>
                          <th>Precio Compra</th>
                          <th>Total</th>
                          <th style="width: 40px">Opciones</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                      </tbody>
                      <tbody id="tbodydetalle">
                      </tbody>
                    </table> -->
                  </div>

                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button id="btn-guardaringreso" class="btn btn-primary" hidden onclick="app.guardar_historial_ubicacion()">Guardar</button>
            <button id="btn-imprimir" class="btn  btn-success" hidden onclick="app.imprimirIngreso()">Imprimir</button>
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

        <div class="modal fade" id="exampleModalNuevoProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <div class="modal-body">
                <form action="javascript:void(0);" method="POST" id="stockformproveedor">
                  <div class="form-row"><br>

                    <div class="razonSocialProveedor" style="width: 100%; margin: 0 0 2% 1%; float: left;">
                      <div class="nombreProveedor" style="width: 100%;">
                      <div class="formulario__grupo" id="grupo__rsp">
                        <div class="select-wrapper">
                          <label for="razonsocialproveedornuevo"></label>
                          <input id="razonsocialproveedornuevo" type="text" name="razonsocialproveedornuevo" autocomplete="off" class="form-control" autofocus>
                          <span class="title" data-placeholder="Razon Social"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">Razon Social solo puede contener letras.</p>
                      </div>
                    </div>
                    </div>

                    <div class="rucproveedor" style="width: 48%; margin: 0 1% 2% 1%; float: left;margin-top: 20px;">
                    <div class="formulario__grupo" id="grupo__rucp">
                      <div class="select-wrapper">
                        <label for="rucproveedornuevo"></label>
                        <input id="rucproveedornuevo" type="text" name="rucproveedornuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        <span class="title" data-placeholder="Ruc"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">Ruc solo puede contener numeros.</p>
                    </div>
                    </div>

                    <div class="correoelectronico" style="width: 48%; margin: 0 1% 2% 1%; float: left;margin-top: 20px;">
                    <div class="formulario__grupo" id="grupo__emailp">
                      <div class="select-wrapper">
                        <label for="correo"></label>
                        <input id="correoelectroniconuevoproveedor" type="text" name="correoelectroniconuevoproveedor" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        <span class="title" data-placeholder="Correo Electrónico"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                    </div>
                    </div>

                    <div class="contactoreferencia" style="width: 48%; margin: 0 1% 2% 1%; float: left;margin-top: 20px;">
                    <div class="formulario__grupo" id="grupo__crp">
                      <div class="contactoreferenciaproveedor">
                        <div class="select-wrapper">
                          <label for="contactoreferenciaproveedor_nuevo"></label>
                          <input id="contactoreferenciaproveedor_nuevo" type="text" name="contactoreferenciaproveedor_nuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                          <span class="title" data-placeholder="Contacto Referencia"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">Contacto Referencia solo puede contener letras.</p>
                      </div>
                    </div>
                    </div>




                    <div class="telefonoproveedorregistro" style="width: 48%; margin: 0 1% 2% 1%; float: left;margin-top: 20px;">
                    <div class="formulario__grupo" id="grupo__tp">
                      <div class="select-wrapper">
                        <label for="telefonoproveedor_nuevo"></label>
                        <input id="telefonoproveedor_nuevo" type="text" name="telefonoproveedor_nuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        <span class="title" data-placeholder="Teléfono"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">Teléfono solo puede contener numeros.</p>
                    </div>
                    </div>

                    <div class="direccionproveedor" style="width: 100%; margin: 0 0 2% 1%; float: left;">
                      <div class=""style="width: 100%;margin-top: 20px;">
                      <div class="formulario__grupo" id="grupo__dp">
                        <div class="select-wrapper">
                          <label for="direccionproveedornuevo"></label>
                          <input id="direccionproveedornuevo" type="text" name="direccionproveedornuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                          <span class="title" data-placeholder="Dirección"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">Dirección solo puede contener letras,numeros y guiones.</p>
                      </div>
                    </div>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" onclick="app.modalnuevoProveedorProducto()"><i class="fas fa-save"></i> Guardar</button>
                <button class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
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

        <!-- lista de clientes par listado -->
        <div class="">
          <!-- Modal -->
          <form action="javascript:void(0);" method="POST" id="permisosform" ">
                <div class=" form-row">
            <div class="form-group">
              <div class="modal fade" id="exampleModalProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Proveedores</h5>
                      <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </a>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header"> Listado de Proveedores</h5>
                        <div class="card-body">
                          <div id="clientesl" class="table-responsive"></div>
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
    <div class="">
      <!-- Modal -->
      <form action="javascript:void(0);" method="POST" id="permisosform">
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
  <?php require_once '../plantilla/lower.php'; ?>
  <script src="../src/producto.js"></script>
  <script src="../src/formularioproducto.js"></script>
</body>

</html>