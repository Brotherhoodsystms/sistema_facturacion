<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
require_once "../Helpers/Helpers.php"; 
getpermisos(RESERVA);
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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Facturación</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reserva</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
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
          <!-- ============================================================== 
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Detalle del producto</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST">
                  <div class="form-row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="producto">Código Producto:</label>
                      <input id="producto_codigoserial" type="text" name="producto_codigoserial" onkeyup="app.obtenerProducto()" data-parsley-trigger="change" autofocus autocomplete="on" class="form-control" autofocus>
                      <div id="codigoMensaje"></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="ubicacion">Ubicación:</label>
                      <input id="producto_ubicacion" type="text" name="producto_ubicacion" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="direccion">Descripción:</label>
                      <textarea id="producto_descripcion" name="producto_descripcion" class="form-control" readonly></textarea>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="stock">Stock:</label>
                      <input id="producto_stock" type="text" name="producto_stock" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="precio">Precio:</label>
                      <input id="producto_precio" type="text" name="producto_precio" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de reserva</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="reservaform" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="reserva_id" name="reserva_id">
                      <input type="hidden" id="producto_id" name="producto_id">
                      <input type="hidden" id="producto_stock_r" name="producto_stock_r">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="cliente">Cliente:</label>
                      <div id="selectorCliente"></div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="vendedor">Vendedor:</label>
                      <div id="selectorVendedor"></div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="pago">Forma pago:</label>
                      <div id="selectorFormapago"></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="numero">Reserva Nro:</label>
                      <input id="reserva_numero" type="text" name="reserva_numero" data-parsley-trigger="change" autocomplete="off" class="form-control text-dark" readonly>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="fecha">Fecha inicio:</label>
                      <input id="reserva_fechainicio" type="date" name="reserva_fechainicio" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="fecha">Fecha final:</label>
                      <input id="reserva_fechafinal" type="date" name="reserva_fechafinal" data-parsley-trigger="change" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <label for="cantidad">Cantidad a vender:</label>
                      <input id="reserva_cantidad" type="number" name="reserva_cantidad" data-parsley-trigger="change" autocomplete="off" class="form-control" onkeyup="app.totalReservaVender()">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <label for="comision">Comisión:</label>
                      <input id="reserva_comision" type="text" name="reserva_comision" data-parsley-trigger="change" autocomplete="off" class="form-control" value="1.00" readonly>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <label for="total">Total:</label>
                      <input id="reserva_total" type="text" name="reserva_total" data-parsley-trigger="change" autocomplete="off" class="form-control text-info" value="0.00" readonly>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <label for="total">Abono:</label>
                      <input id="reserva_abono" type="text" name="reserva_abono" data-parsley-trigger="change" autocomplete="off" class="form-control text-success" onkeyup="app.asignarAbono()">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 p-1">
                      <label for="total">Saldo pendiente:</label>
                      <input id="reserva_saldopendiente" type="text" name="reserva_saldopendiente" data-parsley-trigger="change" autocomplete="off" class="form-control text-danger" value="0.00" readonly>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                      <button type="submit" class="btn btn-space btn-primary">Crear</button>
                      <button type="button" class="btn btn-space btn-secondary" onclick="app.limpiarInputs()">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          -->
          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->


          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de reserva</h5>
              <div class="card-body">
                <div id="reservas" class="table-responsive"></div>
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
    <div class="">
      <!-- Modal -->
      <div class="modal fade" id="exampleModalAbonar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Abono</h5>
              <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
            <div class="modal-body">
              <form action="javascript:void(0);" method="POST" id="abonoform">
                <div class="form-row">
                  <div class="form-group">
                    <input type="hidden" id="reserva_id" name="reserva_id">
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                    <label for="sucursal">Valor abonar</label>
                    <input id="valor_abonar" type="number" min="1"pattern="^[0-9]+" name="valor_abonar" data-parsley-trigger="change" autocomplete="off" class="form-control">
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                    <label for="sucursal">Saldo pendiente</label>
                    <input id="saldo_pendiente" type="text" name="saldo_pendiente" data-parsley-trigger="change" autocomplete="off" class="form-control" readonly>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button class="btn btn-primary" onclick="app.actualizarReservaAbono()">Abonar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/reserva.js"></script>
</body>

</html>