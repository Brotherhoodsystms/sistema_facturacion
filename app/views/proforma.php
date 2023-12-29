<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}

require_once '../plantilla/header.php';
getpermisos(PUNTO_VENTA);

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
      <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ==============================================================
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
              <h2 class="pageheader-title">SELI LOGISTICS </h2>
              <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Página</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Venta</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
         ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Detalle de cliente</h5>
            <div class="card-body"><br>
              <form action="javascript:void(0);" method="POST" id="clienteVform" onsubmit="app.guardarCliente()">
                <div class="form-row">
                  <div class="form-group">
                    <input type="hidden" id="cliente_id" name="cliente_id">
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="formulario__grupo" id="grupo__rs">
                    <div class="select-wrapper">
                      <label for="cliente_razonsocial"></label>
                      <input id="cliente_razonsocial" type="text" name="cliente_razonsocial" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                      <span class="title" data-placeholder="Razon social"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Razon social solo puede contener letras.</p>
                  </div>
                  </div>
                  

                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                  <div class="formulario__grupo" id="grupo__id">
                    <div class="select-wrapper">
                      <label for="cliente_ruc"></label>
                      <input id="cliente_ruc" type="text" name="cliente_ruc" maxlength="20" data-parsley-trigger="change" autocomplete="on" class="form-control formulario__input" onkeyup="app.obtenerCliente()">
                      <span class="title" data-placeholder="Identificacion"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Identificacion solo puede contener numeros.</p>
                  </div>
                  </div>

                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                    <div class="select-wrapper">
                      <label for="dni"></label>
                      <div id="tipo_documentoC"></div>
                      <span class="title" data-placeholder="Tipo de documento"></span>
                      <i class="fa-solid fa-chevron-down icon"></i>
                    </div>
                  </div>


                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2"><br>
                  <div class="formulario__grupo" id="grupo__tel">
                    <div class="select-wrapper">
                      <label for="cliente_telefono"></label>
                      <input id="cliente_telefono" type="text" name="cliente_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <span class="title" data-placeholder="Telefono"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Telefono solo puede contener numeros.</p>
                  </div>
                  </div>

                  

                  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12"><br>
                  <div class="formulario__grupo" id="grupo__dire">
                    <div class="select-wrapper">
                      <label for="cliente_direccion"></label>
                      <input id="cliente_direccion" name="cliente_direccion" class="form-control formulario__input"></input>
                      <span class="title" data-placeholder="Direccion"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El campo Direccion solo puede contener numeros,letras y guiones.</p>
                  </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                  <div class="formulario__grupo" id="grupo__email">
                    <div class="select-wrapper">
                      <label for="cliente_email"></label>
                      <input id="cliente_email" type="text" name="cliente_email" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <span class="title" data-placeholder="Email"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                    </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1"><br>
                  <div class="formulario__grupo" id="grupo__contacto">
                    <div class="select-wrapper">
                      <label for="cliente_contacto"></label>
                      <input id="cliente_contacto" type="text" name="cliente_contacto" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                      <span class="title" data-placeholder="Nombre contacto"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                    </div>
                    <p class="formulario__input-error">El Nombre contacto solo puede contener letras.</p>
                    </div>
                  </div>

                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                    <button id="guardar_cliente" type="submit" class="btn btn-space btn-primary">Guardar</button>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
        <!-- ============================================================== -->
        <!-- fin de ingreso cliente -->
        <!-- ============================================================== -->
        <div class="row">

          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Producto a Vender</h5>
              <div class="card-body"><br>
                <form action="javascript:void(0);" method="POST" id="productoform">
                  <div class="row">
                    <div class="form-group">
                      <input type="hidden" id="producto_id" name="producto_id">
                      <input type="hidden" id="bodega_id_o" name="bodega_id_o">
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label for="serie"></label>
                        <select class='form-control' name='tipo_producto' id='tipo_producto' autofocus required onclick='app.ocultarInputsProducto()'>
                          <!-- <option disabled='selected' selected='selected'>Seleccione</option>; -->
                          <option value='P' selected='selected'>Producto</option>
                          <option value='S'>Servicio</option>
                        </select>
                        <span class="title" data-placeholder="Tipo"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                    <div class="formulario__grupo" id="grupo__cp">
                      <div class="select-wrapper">
                        <label for="producto_codigoserial"></label>
                        <div class="input-group">
                          <input id="producto_codigoserial" type="text" maxlength="25" name="producto_codigoserial" onkeyup="app.obtenerProducto()" data-parsley-trigger="change" class="form-control">
                          <i class="formulario__validacion-estadocod fa-solid fa-circle-xmark"></i>
                          <div class="input-group-append">
                            <button id="lproducto" type="button" class="btn btn-warning" data-toggle='modal' data-target='#exampleModalProductos' title='Lista' onclick="app.modallistaProducto()">
                              <i class="fas fa-search"></i>
                            </button>
                            <button id="lservicio" type="button" class="btn btn-info" data-toggle='modal' data-target='#exampleModalProductos' title='Lista' onclick="app.modallistaServicio()">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                        <span class="title" data-placeholder="Codigo producto"></span>
                        <p class="formulario__input-error">El campo Código producto solo puede contener letras y numeros.</p>
                        <div id="codigoMensaje"></div>
                      </div>
                    </div>
                    </div>


                    <div id="div_ubica_o" class="col-xl-6 col-lg-6 col-lg-12 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="bodega"></label>
                        <select id="ubicacion_descripcion_o" name="ubicacion_descripcion_o" class=' form-control' onChange='app.obtenerCantidadUbicacion()'>
                          <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        </select>
                        <span class="title" data-placeholder="Ubicacion origen"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                        <!-- <div id="ubicacion_bodega_r"></div> -->
                      </div>
                    </div>

                    <div id="div_lote" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="codigoserial"></label>
                        <input id="producto_lote" type="text" name="producto_lote" data-parsley-trigger="change" autocomplete="on" class="form-control">
                        <span class="title" data-placeholder="Lote"></span>

                      </div>
                    </div>

                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__pd">
                      <div class="select-wrapper">
                        <label for="producto_descripcion"></label>
                        <input id="producto_descripcion" type="text" name="producto_descripcion" data-parsley-trigger="change" autocomplete="on" class="form-control">
                        <span class="title" data-placeholder="Descripcion"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Descripción solo puede contener numeros , letras y guiones.</p>

                      </div>
                    </div>

                    <div id="div_precioMod" class="col-xl-6 col-lg-6 col-lg-12 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="precios"></label>
                        <select id="precio_xcantidad" name="precio_xcantidad" class='form-control' autofocus required>
                          <option value="1">Precio Compra</option>
                          <option value="2" selected='selected'>Precio Venta</option>

                        </select>
                        <span class="title" data-placeholder="Modo de venta"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__pc">
                      <div class="select-wrapper">
                        <label for="producto_precioxMe"></label>
                        <input id="producto_precioxMe" type="text" name="producto_precioxMe" autocomplete="on" class="form-control">
                        <span class="title" data-placeholder="Precio compra"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Precio compra solo puede contener numeros.</p>
                    </div>
                    </div>

                    <div id="div_precioMay" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__pv">
                      <div class="select-wrapper">
                        <label for="producto_precioxMa"></label>
                        <input id="producto_precioxMa" type="text" name="producto_precioxMa" autocomplete="on" class="form-control">
                        <span class="title" data-placeholder="Precio venta"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Precio venta solo puede contener numeros.</p>
                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="stock"></label>
                        <input id="producto_stock" type="number" name="producto_stock" autocomplete="on" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                        <span class="title" data-placeholder="Stock"></span>

                      </div>
                    </div>

                    <div id="div_tipo_impuesto" class=" col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="bodega">Impuesto</label>
                      <div id="tipo_impuesto"></div>
                    </div>
                    <div id="div_porcentaje_impuesto" class=" col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="bodega">Porcentaje %</label>
                      <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="stock"></label>
                        <input id="producto_descuento" type="number" min="0" max="100" value="0" name="producto_descuento" autocomplete="on" class="form-control text-dark">
                        <span class="title" data-placeholder="Descuento %"></span>

                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__pco">
                      <div class="select-wrapper">
                        <label for="producto_comprar"></label>
                        <input id="producto_comprar" type="text" name="producto_comprar" autocomplete="on" class="form-control">
                        <span class="title" data-placeholder="Cantidad a vender"></span>
                        <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Cantidad a vender solo puede contener numeros enteros.</p>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                    </div>
                    <div class="col-sm-6 pl-0 p-2">
                      <p class="text-right">
                        <button id="btn_producto" type="submit" class="btn btn-space btn-primary btn-sm" onclick="app.guardar()">Agregar</button>
                        <button id="btn_servicios" class="btn btn-space btn-secondary btn-sm" onclick="app.guardarServicio()">Agregar</button>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Detalle Proforma</h5>
              <div class="card-body"><br>
                <form action="javascript:void(0);" method="POST" id="facturaform">
                  <div class="row">
                    <div class="form-group">
                      <input type="hidden" id="factura_id" name="factura_id" value="0">
                    </div>

                    <div id="div_vendedor" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label for="Vendedor_id"></label>
                        <div id="selector_vendedor"></div>
                        <span class="title" data-placeholder="Vendedor"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div id="div_comision" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label for="iva"></label>
                        <input id="comision_vende" type="number" name="comision_vende" autocomplete="on" class="form-control" value="0">
                        <span class="title" data-placeholder="Comision"></span>

                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="cliente_ruc"></label>
                        <div id="selector_formapago"></div>
                        <span class="title" data-placeholder="Forma pago"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="serie"></label>
                        <div id="selector_comprobante"></div>
                        <span class="title" data-placeholder="Comprobante"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>

                    <div id="div_serie" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="serie"></label>
                        <input id="factura_serie" type="text" name="factura_serie" data-parsley-trigger="change" autocomplete="on" class="form-control">
                        <span class="title" data-placeholder="Serie"></span>

                      </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="select-wrapper">
                        <label for="descripcion"></label>
                        <input id="factura_fechagenerada" type="date" name="factura_fechagenerada" data-parsley-trigger="change" autocomplete="on" class="form-control" value="<?php echo date(
                                                                                                                                                                                  'Y-m-d'
                                                                                                                                                                                ); ?>">
                        <span class="title" data-placeholder="Fecha"></span>
                        
                      </div>
                    </div>

                    <div id="div_ptoemisin_id" class=" form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="numero">Pto emision:</label>
                      <input id="pto_emision_id" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" readonly>
                    </div>
                    <div id="div_ptestablecimiento" class=" form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="numero">Establecimiento Nro:</label>
                      <input id="id_establecimiento" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" readonly>
                    </div>
                    <div id="div_reserva" class=" form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="numero">Reserva Nro:</label>
                      <input id="reserva_numero" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" readonly>
                    </div>
                    <div id="div_abono" class="for-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 ">
                      <label for="total">Abono:</label>
                      <input id="reserva_abono" type="text" name="reserva_abono" data-parsley-trigger="change" autocomplete="off" class="form-control text-success" onkeyup="app.asignarAbono()">
                    </div>
                    <div id="div_saldo_pen" class=" form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="total">Saldo pendiente:</label>
                      <input id="reserva_saldopendiente" type="text" name="reserva_saldopendiente" data-parsley-trigger="change" autocomplete="off" class="form-control text-danger" value="0.00" readonly>
                    </div>

                    <div id="div_fecha_fin" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="fecha">Fecha final:</label>
                      <input id="reserva_fechafinal" type="date" name="reserva_fechafinal" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <!-- <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="iva">Impuesto %:</label>
                      <!--input id="factura_iva" type="number" name="factura_iva" autocomplete="on" class="form-control"-->
                    <!--<select id="factura_ivas" name="factura_ivas" class='form-control' onclick="app.sumarSubTotal()">
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        <option value="0">0</option>
                        <option value="12">12</option>

                      </select>
                  </div>-->
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <label for="precio">Subtotal sin impuestos:</label>
                      <input id="factura_subtotal" type="text" name="factura_subtotal" autocomplete="on" class="form-control text-primary" placeholder="0.00" readonly>
                    </div>
                    <div class=" form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <label for="comprar">Total:</label>
                      <input id="factura_total" type="text" name="factura_total" autocomplete="on" class="form-control text-success" placeholder="0.00" readonly>
                    </div>

                  </div>

                  <div class=" row">
                    <div class="col-sm-6 pb-6 pb-sm-4 pb-lg-0 pr-0">
                    </div>
                    <div class="col-sm-6 pl-0 p-2">
                      <p id="btn-guardarFac" class="text-right">
                        <button id="btn-guardarFact" class="btn btn-space btn-primary btn-sm" onclick="app.procesarFactura()">Generar</button>
                        <button id="btn-editarFact" class="btn btn-space btn-success btn-sm" onclick="app.procesarFactura()">Editar</button>
                        <button id="btn-enviarSRI" class="btn btn-space btn-warning btn-sm" onclick="app.firmarEnviar()">Enviar SRI</button>

                      </p>

                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
        <br>
        <!--/ /todo::detalle factura temporal/factura-->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Detalle del producto a vender</h5>
              <div class="table table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Código producto</th>
                      <th>Descripción producto</th>
                      <th>Cantidad a vender</th>
                      <th>Precio unitario</th>
                      <th>Descuento %</th>
                      <th>Total</th>
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
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->

      <!-- ============================================================== -->
      <!-- end main wrapper -->
      <!-- ============================================================== -->
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
                        <div id="productos4" class="table-responsive"></div>
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

  <!-- Optional JavaScript -->
  <?php require_once '../plantilla/lower.php'; ?>
  <script src="../src/proforma.js"></script>
  <script src="../src/formularioventa.js"></script>
</body>

</html>