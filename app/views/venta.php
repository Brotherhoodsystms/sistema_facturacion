<?php
session_start();
if (empty($_SESSION['login'])) {
    header('Location: ./login.php');
    die();
}
require_once '../plantilla/header.php';
getpermisos(PUNTO_VENTA);
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
  
  <input id="cliente_id" value="497" hidden>
  <input type="text" id="sucursal_identificador" value="<?php echo $_SESSION['sucursal_id']; ?>" hidden>
  <input type="text" id="bodega_identificador" value="<?php echo $_SESSION['bodega_id'] ?>" hidden>
  <input type="hidden" id="factura_id" name="factura_id" value="0" hidden>
  <input type="hidden" id="forma_pago" name="forma_pago" value="1" hidden>
  <input type="hidden" id="comprobanteidentificador" value="2" >
  <div hidden id="selector_vendedor"></div>
  <input id="comision_vende" type="number" name="comision_vende" autocomplete="on" class="form-control" value="0" hidden>
  <input id="id_establecimiento" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" hidden>
  <input id="pto_emision_id" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" hidden>
  <input id="reserva_numero" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" hidden>
  <input id="reserva_abono" type="text" name="reserva_abono" data-parsley-trigger="change" autocomplete="off" class="form-control text-success" onkeyup="app.asignarAbono()" hidden>
  <input id="reserva_saldopendiente" type="text" name="reserva_saldopendiente" data-parsley-trigger="change" autocomplete="off" class="form-control text-danger" value="0.00" hidden>
  <input id="reserva_fechafinal" type="date" name="reserva_fechafinal" data-parsley-trigger="change" autocomplete="off" class="form-control" hidden>
    <div class="dashboard-wrapper" id="containerbody" style="min-height: 740px !important;">
      <div class="container-fluid ">
        <div class="row">
          <div class="detalleproductosventa" style="width: 46%; float:left; margin:0% 1%" >
            <div class="card" style="width: 100%; float:left;">
                <div class="card-body" id="div_producto_venta">
                  <div class="card">
                    <div class="listadoproducto" style="width: 100%;">
                      <div class="listado" style="width: 48%; float: left">
                        <h5 class="card-header"> Listado de productos</h5>
                      </div>
                      <div class="ventacliente" style="width: 48%; float: left">
                      <button id="guardar_cliente" type="submit" class="btn btn-space btn-primary" onclick="location.href='../views/reporteVentaProducto.php'" style="float: right; margin: 5% 0%; "><i class="fa fa-search"></i> Venta por cliente</button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div id="productosListado" class="table-responsive"></div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="detallefacturaventa" id='detallefactura' style="width: 50%; float:left; margin:0% 1%">
          <div class="card">
              <div class="contenedordatos" style="width: 100%;">
                <div class="totalventa" style="width: 43%; float:right;">
                  <div class="acciones" style="width: 100%; float:right">
                    <button id="btn-guardarFact" class="btn btn-space btn-primary btn-sm" style="width:95%; margin-top: 5%; font-size:15pt;background: #0bac0b;border-color: #0bac0b;" title="Cobrar" data-target='#exampleModalMetodoPago'  data-toggle='modal'"><i class="icon fas fa-money-bill-alt"></i> Cobrar</button>
                    <button id="btn-editarFact" class="btn btn-space btn-success btn-sm" style="width: 95%;margin-top: 14%;" onclick="app.procesarFactura()">Editar</button>
                    <button id="btn-enviarSRI" class="btn btn-space btn-warning btn-sm" style="width: 95%;margin-top: 14%;" onclick="app.firmarEnviar()">Enviar SRI</button><br>
                    <button id="btn-abrircaja" class="btn btn-space btn-primary btn-sm" style="width:95%; margin-top: 5%; font-size:15pt;background: #25a4aa;border-color: #25a4aa;" title="Abrir Caja" hidden><i class="fa fa-inbox"></i> Abrir caja</button>
                  </div>
                </div>
                <div class="datoscliente" id="div_cliente" style="width: 56%; float: left; margin: 1% 0% 1% 1%">
                  <div class="buscar" style="width: 20%; float:left"> 
                    <button type="button" class="btn btn-warning btn-xs" data-toggle='modal' style="border-radius: 50%; width: 50px;height: 50px; background: #ffc107; border-color: #ffc107;" data-target='#exampleModalNuevoCliente' title='Nuevo' data-toggle='modal'><i class="fas fa-plus" style="color: white;"></i></button>
                    <button type="button" class="btn btn-warning btn-xs" data-toggle='modal' style="border-radius: 50%; margin-top:10%; width: 50px;height: 50px; background: #5969ff; border-color: #5969ff;" data-target='#exampleModalClientes' title='Lista' data-toggle='modal' onclick="app.modallistaCliente()"><i class="fas fa-search" style="color: white;"></i></button> 
                    <div id="clientesVenta" class="table-responsive"></div>  
                  </div>
                  <div class="cliente" style="width: 80%; float:right">
                    <label for="">Razon Social: </label><input id="razonSocialClienteVenta" value="Consumidor Final" style="border-color: transparent; font-weight:bold;" readonly><br/>
                    <label for="">RUC: </label><input id="rucClienteVenta" value="9999999999" style="border-color: transparent; font-weight:bold;" onkeyup="app.obtenerCliente();" placeholder="Ingresar ruc" ><br/>
                    <label for="">Dirección: </label><input id="direccionClienteVenta" value="Consumidor Final" style="border-color: transparent; font-weight:bold;" readonly><br/>
                    <label for="">Correo: </label><input id="cliente_email" style="border-color: transparent;font-weight:bold;" value="selisistemd@gmail.com" readonly>
                  </div>
                </div>
              </div>
              <hr style="margin: 0% 0% 1% 0%;">
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
                      <label for="comprar" >Total:</label>
                      <input id="factura_total" type="number" name="factura_total" autocomplete="on" class="form-control" placeholder="0.00" style="font-size:25pt; background:green; color:white" readonly>
                  </div>
              </div>
              <input type="text" class="productocodigobarra" id="productocodigobarra" placeholder="Producto directo" onchange="app.obtenerProductoCodigo();" style="border-color: #20a3b0;width:26%; margin:0% 0% 0% 3%">
                <input type="text" id="producto_codigobarra_id" hidden>
                <input type="text" id="producto_codigobarra_codigoserial" hidden>
                <input type="text" id="producto_codigobarra_preciomayor" hidden>
                <input type="text" id="producto_codigobarra_stock" hidden>
      <!-- Detalle factura temporal -->
              <div id='compraProducto' >
                  <div class="table table-responsive" style="font-size: 9pt;text-align: center;" id="tbody"></div>
              </div>
              <div id='compraProducto' >
                  <div class="table table-responsive" style="font-size: 9pt;" id="tbodyR"></div>
              </div>
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
  <!-- Modal -->
        <!-- Modal Venta metodo pago -->
        <div class="modal fade" id="exampleModalMetodoPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Forma pago</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" style="width: 30%; float: right;" hidden>
                          <label for="descripcion">Fecha:</label>
                          <input id="factura_fechagenerada" type="date" name="factura_fechagenerada" class="form-control" value="<?php echo date('Y-m-d');?>">
                    </div>
                    <div class="tipocomprobante" style="width: 100%;">
                     <br>
                       <div class="comprobante" style="width: 48%; margin:0% 5%; float:left">
                          <label>Tipo de comprobante:</label>
                          <div id="selector_comprobante" style="width: 60%;"></div>
                       </div>
                       <div class="seriecomprobante" style="width: 40%; float:left">
                       <label>Serie :</label>
                          <input id="factura_serie" type="text" name="factura_serie" data-parsley-trigger="change" autocomplete="on" class="form-control" style="width: 60%;">
                       </div>
                    </div>
                    <div class="tipopago" style="width: 100%;">
                    <br>
                       <div class="pago" style="width: 48%; margin:0% 5%; float:left">
                          <button value = 1  onclick="app.tipospagoventa(1);" style="width: 100%; text-align:center;"><i class="icon fas fa-money-bill-alt fa-3x" style="float: left; color:#0db75a;"></i> Efectivo</button><br>
                          <button  style="width: 100%; text-align:center;" hidden><i class="fa fa-user fa-3x" style="float: left; color:#a22;"></i> Cuenta por pagar</button>
                          <button value = 5 onclick="app.tipospagoventa(5);" style="width: 100%; text-align:center;"><i class="icon fas fa-dollar-sign fa-3x" style="float: left; color:#116c09;"></i> Dinero Electónico</button><br>
                          <button value = 2 onclick="app.tipospagoventa(2);" style="width: 100%; text-align:center;"><i class="fa fa-mobile fa-3x" style="float: left; color:#e8b210;"></i> Transferencias bancarias</button><br>
                          <button value = 4 onclick="app.tipospagoventa(4);" style="width: 100%; text-align:center;"><i class="icon fas fa-credit-card fa-3x" style="float: left; color:#4a9f10;"></i> Tarjeta Débito</button><br>
                          <button value = 7 onclick="app.tipospagoventa(7);" style="width: 100%; text-align:center;"><i class="icon fas fa-credit-card fa-3x" style="float: left; color:#1bd0e4;"></i> Tarjeta Crédito</button><br>
                       </div>
                       <div class="totalVenta" style="width: 40%; float:left">
                          <label>Total:</label>
                          <input id="factura_total_pago" type="text" name="factura_total_pago" autocomplete="on" class="form-control" placeholder="0.00" style="font-size:25pt; background:green; color:white" readonly>
                       </div>
                       <div class="calculadoraEfectivo" style="width: 40%; float:left; margin:3% 0% 0% 0%;">
                        <div class="cambios" id="cambios">
                          <div class="entregaformapago" style="width: 45%; float:left; margin: 0% 5% 0% 0%;">
                            <label for="entrega">Entrega:</label>
                            <input id="efectivo_entrega" type="number"  name="efectivo_entrega" onkeyup="app.calcularCambio()"placeholder="0.00" style="font-size:17pt;" data-parsley-trigger="change" class="form-control">
                          </div>
                          <div class="cambioformapago" style="width: 45%; float:left; margin: 0% 0% 0% 5%;">
                            <label for="cambio">Cambio:</label>
                            <input id="efectivo_cambio" type="number"  name="efectivo_cambio"  placeholder="0.00" style="font-size:17pt; color:red;" data-parsley-trigger="change" class="form-control" readonly>
                          </div>
                        </div>
                       </div>
                       <div class="venta" style="width: 40%; float:left">
                         <button id="btn-guardarFact" class="btn btn-space btn-primary btn-sm" style="margin-top: 15%; font-size:15pt;background: #5969ff;border-color: #5969ff; float:right" title="Cobrar" onclick="app.procesarFactura()"><i class="icon fas fa-money-bill-alt"></i> Finalizar venta</button>
                       </div>
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2" hidden>
                          <label for="cliente_ruc">Forma pago:</label>
                          <div id="selector_formapago"></div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
      <!-- Modal Venta Sucursal -->
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
        <!-- Modal Venta nuevo stock -->
        <div class="modal fade" id="exampleModalNuevoStock" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stock Producto</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </a>
                  </div>
                  <div class="modal-body">
                    <form action="javascript:void(0)" method="POST" id="stockformnuevacantidad">
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
      <!-- Modal lista productos por combo -->
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
      <!-- Modal nuevo cliente -->
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
                          <div class="formulario__grupo" id="rsv">
                          <div class="select-wrapper">
                            <label for="razonsocialclientenuevo"></label>
                            <input id="razonsocialclientenuevo" type="text" name="razonsocialclientenuevo"  autocomplete="off" class="form-control formulario__input" autofocus>
                            <span class="title" data-placeholder="Razon Social"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Razon Social solo puede contener letras.</p>

                        </div>

                        </div>
                        </div>

                        <div class="tipodocumentocliente" style="width: 100%;"><br>
                          <div class="tipodocumentocliente" style="width: 48%; margin:0% 1%; float:left">
                          <div class="select-wrapper">
                            <label for="tipodocumento"></label>
                            <div id="tipo_documentoC"></div>
                            <span class="title" data-placeholder="Tipo Documento"></span>
                            <i class="fa-solid fa-chevron-down icon"></i>
                          </div>
                          </div>

                          <div class="ruccliente" style="width: 48%; float:left">
                          <div class="formulario__grupo" id="ruc">
                          <div class="select-wrapper">
                            <label for="rucclientenuevo"></label>
                            <input id="rucclientenuevo" type="text"  name="rucclientenuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Ruc"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Razon Social solo puede contener letras.</p>
                        </div>
                        </div>
                        </div>

                        <div class="direccioncliente" style="width: 100%;"><br>
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1">
                            <div class="select-wrapper">
                            <label for="direccion"></label>
                            <input id="direccionclientenuevo" type="text" name="direccionclientenuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Dirección"></span>
                    
                          </div>
                        </div>
                        </div>

                        <div class="telefonocliente" style="width: 100%;"><br>
                          <div class="telefonoclienteregistro" style="width: 48%; margin:0% 1%; float:left">
                          <div class="select-wrapper">
                            <label for="telefono"></label>
                            <input id="telefonocliente_nuevo" type="text" name="telefonocliente_nuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Teléfono"></span>
                      
                          </div>
                          </div>

                          <div class="correoelectronico" style="width: 48%; margin: 0% 1%; float:left">
                          <div class="select-wrapper">
                            <label for="correo"></label>
                            <input id="correoelectroniconuevo" type="text"  name="correoelectroniconuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Correo Electrónico"></span>
                      
                          </div>
                        </div>
                        </div>

                        <div class="contactoreferencia" style="width: 100%;"><br>
                          <div class="contactoreferenciacliente" style="width: 48%; margin:0% 1%; float:left">
                          <div class="select-wrapper">
                            <label for="stock"></label>
                            <input id="contactoreferencia_nuevo" type="text"  name="contactoreferencia_nuevo" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Contacto Referencia"></span>
                      
                          </div>
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
      <!-- Modal listado clientes -->
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
                              <div id="clientesl" class="table-responsive"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
  <!-- Optional JavaScript -->
  <?php require_once '../plantilla/lower.php'; ?>
  <script src="../src/venta.js"></script>
  <script src="../src/formularioproducto.js"></script>
</body>

</html>