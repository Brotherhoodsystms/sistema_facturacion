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
            <div class="card-body">
              <form action="javascript:void(0);" method="POST" id="clienteVform" onsubmit="app.guardarCliente()">
                <div class="form-row">
                  <div class="form-group">
                    <input type="hidden" id="cliente_id" name="cliente_id">
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                    <label for="dni">Razon social:</label>
                    <input id="cliente_razonsocial" type="text" name="cliente_razonsocial" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                    <label for="nombres">Identificación:</label>
                    <input id="cliente_ruc" type="text" name="cliente_ruc" maxlength="20" data-parsley-trigger="change" autocomplete="on" class="form-control" onkeyup="app.obtenerCliente()">
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                    <label for="telefono">Telefono:</label>
                    <input id="cliente_telefono" type="text" name="cliente_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control">
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2">
                    <label for="dni">Tipo de documento:</label>
                    <div id="tipo_documentoC"></div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <label for="direccion">Direccion:</label>
                    <input id="cliente_direccion" name="cliente_direccion" class="form-control"></input>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                    <label for="email">Email:</label>
                    <input id="cliente_email" type="text" name="cliente_email" data-parsley-trigger="change" autocomplete="off" class="form-control">
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1">
                    <label for="contacto">Nombre contacto:</label>
                    <input id="cliente_contacto" type="text" name="cliente_contacto" data-parsley-trigger="change" autocomplete="off" class="form-control">
                  </div>

                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                    <button id="guardar_cliente" type="submit" class="btn btn-space btn-primary">Guardar</button>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- fin de ingreso cliente -->
        <!-- ============================================================== -->

        <div class="row">

          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Producto a Retener</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="productoform">
                  <div class="row">
                    <div class="form-group">
                      <input type="hidden" id="producto_id" name="producto_id">
                      <input type="hidden" id="bodega_id_o" name="bodega_id_o">
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="serie">Tipo:</label>
                      <select class='form-control' name='tipo_renta' id='tipo_renta' autofocus required onclick='app.listarporcentajesRenta()'>
                        <option disabled='selected' selected='selected'>Seleccione</option>;
                        <option value='1'>IVA</option>
                        <option value='2'>RENTA</option>
                        <option value='3'>ISD</option>
                      </select>
                    </div>

                    <div id="div_ubica_o" class="col-xl-6 col-lg-6 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="bodega">Porcentaje de Retencion:</label>
                      <select id="ubicacion_descripcion_o" name="ubicacion_descripcion_o" class=' form-control' >
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                      </select>
                      <!-- <div id="ubicacion_bodega_r"></div> -->
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="stock">Base Imponible</label>
                      <input id="producto_descuento" type="number" name="producto_descuento" autocomplete="on" class="form-control text-dark" onChange='app.obtenerTotal()'>
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="comprar">Total</label>
                      <input id="producto_comprar" type="text" name="producto_comprar" autocomplete="on" class="form-control">
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
              <h5 class="card-header">Detalle Retención</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="facturaform">
                  <div class="row">
                    <div class="form-group">
                      <input type="hidden" id="factura_id" name="factura_id" value="0">
                    </div>



                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="cliente_ruc">Forma pago:</label>
                      <div id="selector_formapago"></div>
                    </div>

                    <div id="div_serie" class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="serie">Serie :</label>
                      <input id="factura_serie" type="text" name="factura_serie" data-parsley-trigger="change" autocomplete="on" class="form-control">
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
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

                    <!-- <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="iva">Impuesto %:</label>
                      <!--input id="factura_iva" type="number" name="factura_iva" autocomplete="on" class="form-control"-->
                    <!--<select id="factura_ivas" name="factura_ivas" class='form-control' onclick="app.sumarSubTotal()">
                        <option value="0" disabled='selected' selected='selected'>seleccione</option>
                        <option value="0">0</option>
                        <option value="12">12</option>

                      </select>
                  </div>-->
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="precio">Periodo Fiscal(mm/yyyy)</label>
                      <input id="factura_subtotal" type="text" name="factura_subtotal" autocomplete="on" class="form-control text-primary" placeholder="02/2023" >
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="precio">Numero Factura</label>
                      <input id="factura_subtotal" type="text" name="factura_subtotal" autocomplete="on" class="form-control text-primary" placeholder="02/2023" >
                    </div>
                    <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="precio">Fecha Factura</label>
                      <input id="factura_subtotal" type="text" name="factura_subtotal" autocomplete="on" class="form-control text-primary" placeholder="02/2023" >
                    </div>
                    <div class=" form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
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
        <!--/ /todo::detalle factura temporal/factura-->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Detalle del producto a Retener</h5>
              <div class="table table-responsive">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Base</th>
                      <th>Tipo Impuesto</th>
                      <th>Porcentaje</th>
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


    </div>
  <!-- Optional JavaScript -->
  <?php require_once '../templates/footer.php'; ?>
  <script src="../src/retencion.js"></script>
</body>

</html>