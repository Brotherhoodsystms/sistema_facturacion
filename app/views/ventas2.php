<?php
session_start();
if (empty($_SESSION['login'])) {
    header('Location: ./login.php');
    die();
}

require_once '../templates/header.php';
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
    <?php require_once '../templates/navbar.php'; ?>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <?php require_once '../templates/sidebar.php'; ?>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper" id="containerbody">
      <div class="container-fluid ">
        <div class="row">

          <div class="detalleproductosventa" style="width: 48%; float:left; margin:0% 1%" >
          <div class="card" style="width: 100%; float:left;">
            <div class="card-body" id="div_cliente">
            <div id="div_serie" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 35%; float: right;">
                      <label for="serie">Serie :</label>
                      <input id="factura_serie" type="text" name="factura_serie" data-parsley-trigger="change" autocomplete="on" class="form-control">
                    </div> 
             <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 35%; float: right;">
                      <label for="serie">Tipo de comprobante:</label>
                      <div id="selector_comprobante"></div>
             </div>
             <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float: right;">
                      <label for="descripcion">Fecha:</label>
                      <input id="factura_fechagenerada" type="date" name="factura_fechagenerada" data-parsley-trigger="change" autocomplete="on" class="form-control" value="<?php echo date(
                          'Y-m-d'
                      ); ?>">
             </div>
             <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="cliente_ruc">Forma pago:</label>
                      <div id="selector_formapago"></div>
            </div>
            </div>
          </div>
          <div class="numerocomprobante">
          
          
          <div class="card" style="width: 49%; float:right;" hidden>
             <div class="card-body" id="div_cliente">
             <div id="div_vendedor" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 45%; float: left;">
                      <label for="Vendedor_id">Vendedor:</label>
                      <div id="selector_vendedor"></div>

                    </div>
                    <div id="div_comision" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 45%; float: right;">
                      <label for="iva">Comision:</label>
                      <input id="comision_vende" type="number" name="comision_vende" autocomplete="on" class="form-control" value="0">
                    </div>
            </div>
          </div>
          </div>
            <div class="card" style="width: 100%; float:left;">
              <h5 hidden class="card-header">Producto a Vender<button  id='ocultarProductoVenta'onclick='app.ocultarProductoVenta()' class="btn btn-success btn-xs" hidden>-</button><button onclick='app.visualizarProductoVenta()' id='visualizarProductoVenta' class="btn btn-success btn-xs">+</button></h5>
              <div class="card-body" id="div_producto_venta">
                <form action="javascript:void(0);" method="POST" id="productoform" style="font-size: 9pt;">
                <label hidden>Id cliente: </label>
                <input id="cliente_id" value="497" hidden  readonly>
                  <div class="row">
                    <div class="form-group">
                      <input type="hidden" id="producto_id" name="producto_id">
                      <input type="hidden" id="bodega_id_o" name="bodega_id_o">
                    </div>
                    
                    <div class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="serie">Tipo:</label>
                      <select class='form-control' name='tipo_producto' id='tipo_producto' autofocus required onclick='app.ocultarInputsProducto()'>
                        <!-- <option disabled='selected' selected='selected'>Seleccione</option>; -->
                        <option value='P' selected='selected'>Producto</option>
                        <option value='S'>Servicio</option>
                      </select>
                    </div>

                    <div class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="codigoserial">Código:</label>
                      <button type="button" class="btn btn-warning btn-xs" data-toggle='modal' data-target='#exampleModalProductos' title='Lista' data-toggle='modal' onclick="app.modallistaProducto()"><i class="fas fa-search"></i></button>

                      <input id="producto_codigoserial" type="text" maxlength="25" name="producto_codigoserial" onkeyup="app.obtenerProducto()" data-parsley-trigger="change" class="form-control">
                      <div id="codigoMensaje"></div>
                    </div>
                    <div id="div_lote" class="form-group col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="codigoserial">Lote:</label>
                      <input id="producto_lote" type="text" name="producto_lote" data-parsley-trigger="change" autocomplete="on" class="form-control">
                    </div>
                    <div id="div_precioMod" class="col-xl-4 col-lg-4 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="precios">Modo de Venta :</label>
                      <select id="precio_xcantidad" name="precio_xcantidad" class='form-control' autofocus required>
                        <option value="1">Precio Compra</option>
                        <option value="2" selected='selected'>Precio Venta</option>

                      </select>
                    </div>


                    <div id="div_ubica_o" class="col-xl-4 col-lg-4 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="bodega">Ubicacion Origen:</label>
                      <select id="ubicacion_descripcion_o" name="ubicacion_descripcion_o" class=' form-control' onChange='app.obtenerCantidadUbicacion()'>
                        <option value="0" disabled='selected' selected='selected'>Seleccione</option>
                      </select>
                      <!-- <div id="ubicacion_bodega_r"></div> -->
                    </div>
                   
                    <div class="form-group col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="descripcion">Descripción:</label>
                      <input id="producto_descripcion" type="text" name="producto_descripcion" data-parsley-trigger="change" autocomplete="on" class="form-control">
                    </div>


                    <div id="div_precioCompra" class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="precio">Precio compra:</label>
                      <input id="producto_precioxMe" type="text" name="producto_precioxMe" autocomplete="on" class="form-control" readonly>
                    </div>
                    <div id="div_precioMay" class="form-group col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="precio2">P.venta:</label>
                      <input id="producto_precioxMa" type="text" name="producto_precioxMa" autocomplete="on" class="form-control">
                    </div>
                    <div class="form-group col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="stock">Stock:</label>
                      <input id="producto_stock" type="number" name="producto_stock" autocomplete="on" class="form-control" readonly>
                    </div>
                    <div id="div_tipo_impuesto" class=" col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="bodega">Impuesto</label>
                      <div id="tipo_impuesto"></div>
                    </div>
                    <div id="div_porcentaje_impuesto" class=" col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="bodega">Porcentaje %</label>
                      <select id="porcentaje_iva" name="porcentaje_iva" class='form-control' autofocus required>
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="stock">Descuento %:</label>
                      <input id="producto_descuento" type="number" min="0" max="100" value="0" name="producto_descuento" autocomplete="on" class="form-control text-dark">
                    </div>
                    <div class="form-group col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="comprar">Cantidad:</label>
                      <input id="producto_comprar" type="text" name="producto_comprar" autocomplete="on" class="form-control">
                    </div>
                    <div class="form-group col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="comprar"></label>
                      <button id="btn_producto" type="submit" class="btn btn-space btn-primary btn-sm" onclick="app.guardar()" hidden>Agregar</button>
                        <button id="btn_servicios" class="btn btn-space btn-secondary btn-sm" onclick="app.guardarServicio()">Agregar</button>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                    </div>
                    <div class="col-sm-6 pl-0 p-2">
                      <p class="text-right">
                        </p>
                    </div>
                  </div> -->
                </form>
            <div class="card">
              <h5 class="card-header"> Listado de productos</h5>
              <div class="card-body">
              <input type="text" hidden id="sucursal_identificador" value="<?php echo $_SESSION['sucursal_id']; ?>">
                <input type="text" hidden id="bodega_identificador" value="<?php echo $_SESSION['bodega_id'] ?>">
                <div id="productosListado" class="table-responsive"></div>
              </div>
            </div>
              </div>
              <!--/ /todo::detalle factura temporal/factura-->
              <!--  <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id='compraProducto'>
            <div class="card">
              <div class="table table-responsive" style="font-size: 10pt;text-align: center;" id="tbody">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id='compraProducto'>
            <div class="card">
              <div class="table table-responsive" style="font-size: 9pt;" id="tbodyR">
              </div>
            </div>
          </div>
        </div> -->
            </div>
          </div>
          <div class="detallefacturaventa" id='detallefactura' style="width: 48%; float:left; margin:0% 1%"> 
         
          <div class="card">
                  <div class="contenedordatos">
            <div class="reporteventacliente" style="width: 33%; float:right; margin:0% 1%">
            <div class="card-body" id="div_cliente">
             <img src="../utils/img/searchfile.png" alt="" style="width: 20%; margin: 0px 40px;">
             <br>
             <button id="guardar_cliente" type="submit" class="btn btn-space btn-primary" onclick="location.href='../views/reporteVentaProducto.php'" style="float: left; margin: 5% 0%; ">Venta por cliente</button>
            </div>
            </div>
            <div class="card-body" id="div_cliente" style="width: 65%; float: right;">
            <div class="buscar" style="width: 20%; float:left"> 
            <button type="button" class="btn btn-warning btn-xs" data-toggle='modal' style="border-radius: 50%; width: 50px;height: 50px; background: #ffc107; border-color: #ffc107;" data-target='#exampleModalNuevoCliente' title='Nuevo' data-toggle='modal'><i class="fas fa-plus" style="color: white;"></i></button>
            <button type="button" class="btn btn-warning btn-xs" data-toggle='modal' style="border-radius: 50%; margin-top:10%; width: 50px;height: 50px; background: #5969ff; border-color: #5969ff;" data-target='#exampleModalClientes' title='Lista' data-toggle='modal' onclick="app.modallistaCliente()"><i class="fas fa-search" style="color: white;"></i></button> 
            <div id="clientesVenta" class="table-responsive"></div>  
            </div>
            <div class="cliente" style="width: 80%; float:right">
             
              <label for="">Razon Social: </label><input id="razonSocialClienteVenta" value="Consumidor Final" style="border-color: transparent; font-weight:bold;"><br/>
              <label for="">RUC: </label><input id="rucClienteVenta" value="9999999999" style="border-color: transparent; font-weight:bold;" onkeyup="app.obtenerCliente()"placeholder="Ingresar ruc" ><br/>
              <label for="">Dirección: </label><input id="direccionClienteVenta" value="Consumidor Final" style="border-color: transparent; font-weight:bold;"><br/>
              <label for="correoelecttronico">Correo: </label><input id="cliente_email" style="border-color: transparent;font-weight:bold;" value="selisistemd@gmail.com">
              <!--  <label hidden>Tipo documento: </label><input id="tipo_documentoC" value="05" hidden readonly> -->
            </div>
            </div>
            </div>
          </div> 
          <div class="card">
                 <!--/ /todo::detalle factura temporal/factura-->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id='compraProducto'>
            <div class="card">
              <div class="table table-responsive" style="font-size: 10pt;text-align: center;" id="tbody">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id='compraProducto'>
            <div class="card">
              <div class="table table-responsive" style="font-size: 9pt;" id="tbodyR">
              </div>
            </div>
          </div>
        </div>
        
          </div>
          <div class="card">
              <h5 class="card-header">Detalle factura</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="facturaform">
                  <div class="row">
                    <div class="form-group">
                      <input type="hidden" id="factura_id" name="factura_id" value="0" hidden>
                    </div>

                    <div id="div_vendedor" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="Vendedor_id">Vendedor:</label>
                      <div id="selector_vendedor"></div>

                    </div>
                    <div id="div_comision" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"hidden>
                      <label for="iva">Comision:</label>
                      <input id="comision_vende" type="number" name="comision_vende" autocomplete="on" class="form-control" value="0">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="cliente_ruc">Forma pago:</label>
                      <div id="selector_formapago"></div>
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"hidden>
                      <label for="serie">Comprobante:</label>
                      <div id="selector_comprobante"></div>
                    </div>
                    <div id="div_serie" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2"hidden>
                      <label for="serie">Serie :</label>
                      <input id="factura_serie" type="text" name="factura_serie" data-parsley-trigger="change" autocomplete="on" class="form-control">
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" hidden>
                      <label for="descripcion">Fecha:</label>
                      <input id="factura_fechagenerada" type="date" name="factura_fechagenerada" data-parsley-trigger="change" autocomplete="on" class="form-control" value="<?php echo date(
                          'Y-m-d'
                      ); ?>">
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
                  <div class="detallefacturaventa">  
                    <div class="valoresapagar">
                  <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float:left; margin:0% 1%">
                      <label for="precio">Subtotal:</label>
                      <input id="factura_subtotal" type="number" name="factura_subtotal" autocomplete="on" class="form-control text-primary" placeholder="0.00" style="font-size:17pt;" readonly>
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float:left; margin:0% 1%">
                      <label for="impuestos">Impuestos:</label>
                      <input id="factura_iva" type="number" name="factura_iva" autocomplete="on" class="form-control text-primary" placeholder="0.00" style="font-size:17pt;" readonly>
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float:left; margin:0% 1%">
                      <label for="comprar" >TOTAL:</label>
                      <input id="factura_total" type="number" name="factura_total" autocomplete="on" class="form-control text-success" placeholder="0.00" style="font-size:17pt;" readonly>
                    </div>
                    </div>
                    <div class="cambios">
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 45%; float:left; margin:0% 1%">
                      <label for="entrega">Entrega:</label>
                      <input id="efectivo_entrega" type="number"  name="efectivo_entrega" onkeyup="app.calcularCambio()"placeholder="0.00" style="font-size:17pt;" data-parsley-trigger="change" class="form-control">
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 45%; float:left; margin:0% 1%">
                      <label for="cambio">Cambio:</label>
                      <input id="efectivo_cambio" type="number"  name="efectivo_cambio"  placeholder="0.00" style="font-size:17pt; color:red;" data-parsley-trigger="change" class="form-control" readonly>
                    </div>
                    </div>
                    </div>
                  </div>

                  <div class=" row">
                    <div class="col-sm-6 pb-6 pb-sm-4 pb-lg-0 pr-0">
                    </div>
                    <div class="col-sm-6 pl-0 p-2">
                      <p id="btn-guardarFac" class="text-right">
                        <button id="btn-guardarFact" class="btn btn-space btn-primary btn-sm" style="width: 50%;margin-top: 14%;"  onclick="app.procesarFactura()">Generar</button>
                        <button id="btn-editarFact" class="btn btn-space btn-success btn-sm" style="width: 50%;margin-top: 14%;" onclick="app.procesarFactura()">Editar</button>
                        <button id="btn-enviarSRI" class="btn btn-space btn-warning btn-sm" style="width: 50%;margin-top: 14%;" onclick="app.firmarEnviar()">Enviar SRI</button>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
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
          <div class="modal fade" id="exampleModalProductoStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Stock Productos</h5>
                          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="card">
                          <!-- <h5 class="card-header">Stock Producto</h5> -->
                            <div class="card-body">
                              <div id="productoStock" class="table-responsive"></div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
            
                  <div class="modal fade" id="exampleModalNuevoStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stock Producto</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="stockformnuevacantidad">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="hidden" id="producto_id_add_stock" name="producto_id_add_stock" >
                          <input type="hidden" id="bodegaid_add_stock" name="bodegaid_add_stock" >
                          <input type="hidden" id="ubicacion_descripcion_add_stock" name="ubicacion_descripcion_add_stock" >
                          <input type="hidden" id="temp_id" name="temp_id" >
                          <input type="hidden" id="temp_precio_add_stock" name="temp_precio_add_stock">
                        </div>
                        <div class="actualizarStockProducto" style="width: 100%;">
                        <div class="cantidadproducto" style="width: 48%; margin:0% 1%; float:left">
                          <label for="cantidad">Cantidad Actual</label>
                          <input id="cantidadactual_stock" type="text" name="cantidadactual_stock" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus readonly>
                        </div>
                        <div class="nuevaCantidadStockProducto" style="width: 48%; margin:0% 1%; float:left">
                          <label for="nuevacantidad">Nueva Cantidad</label>
                          <input id="cantidadnueva_stock" type="text" name="cantidadnueva_stock" placeholder="Ingresar nueva cantidad" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                        <div class="actualizarPrecioProducto" style="width: 100%;">
                        <div class="precioproducto" style="width: 48%; margin:0% 1%; float:left">
                          <label for="cantidad">Nuevo Precio</label>
                          <input id="precio_producto" type="text" name="precio_producto" data-parsley-trigger="change" placeholder="Ingresar precio" autocomplete="off" class="form-control" autofocus >
                        </div>
                        <div class="descuentoProductos" style="width: 48%; margin:0% 1%; float:left">
                          <label for="nuevodecuento">Descuento</label>
                          <input id="descuento_producto" type="text" name="descuento_producto" placeholder="Ingresar descuento" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
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

            <div class="modal fade" id="exampleModalCombosVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <div id="productosCombosVenta" class="table-responsive"></div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
        </div>

            <div class="modal fade" id="exampleModalNuevoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1900">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0);" method="POST" id="stockformclientes">
                      <div class="form-row">
                        <div class="form-group">
                          <input type="text" id="producto_id_stocka" name="producto_id_stocka" hidden>
                        </div>
                        <div class="razonSocialCliente" style="width: 100%;">
                        <div class="nombreCliente" style="width: 100%; margin:0% 1%; float:left">
                          <label for="razonsocial">Razon Social:</label>
                          <input id="razonsocialclientenuevo" type="text" name="razonsocialclientenuevo"  autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                        <div class="tipodocumentocliente" style="width: 100%;">
                        <div class="tipodocumentocliente" style="width: 48%; margin:0% 1%; float:left">
                          <label for="tipodocumento">Tipo Documento:</label>
                         
                              <div id="tipo_documentoC"></div>
                        
                        </div>
                        <div class="ruccliente" style="width: 48%; float:left">
                          <label for="ruc">Ruc:</label>
                          <input id="rucclientenuevo" type="text"  name="rucclientenuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                          </div>
                        <div class="direccioncliente" style="width: 100%;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                          <label for="direccion">Dirección:</label>
                          <input id="direccionclientenuevo" type="text" name="direccionclientenuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                        <div class="telefonocliente" style="width: 100%;">
                        <div class="telefonoclienteregistro" style="width: 48%; margin:0% 1%; float:left">
                          <label for="telefono">Teléfono</label>
                          <input id="telefonocliente_nuevo" type="text" name="telefonocliente_nuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        <div class="correoelectronico" style="width: 48%; margin: 0% 1%; float:left">
                          <label for="correo">Correo Electrónico:</label>
                          <input id="correoelectroniconuevo" type="text"  name="correoelectroniconuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                        <div class="contactoreferencia" style="width: 100%;">
                        <div class="contactoreferenciacliente" style="width: 48%; margin:0% 1%; float:left">
                          <label for="stock">Contacto Referencia:</label>
                          <input id="contactoreferencia_nuevo" type="text"  name="contactoreferencia_nuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                        </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" onclick="app.modalnuevoCliente()"><i class="fas fa-save"></i> Guardar</button>
                    <button class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
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
                  <div class="modal fade" id="exampleModalClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
                          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                          <div class="card">
                            <h5 class="card-header"> Listado de Clientes</h5>
                              <div class="card-body">
                              <div id="clientesl" class="table-responsive">
                                
                              </div>
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
  <?php require_once '../templates/footer.php'; ?>
  <script src="../src/venta.js"></script>
</body>

</html>