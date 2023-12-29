<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(COMPRAS); ?>

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Contabilidad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Compras - Gastos</li>
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
          <!-- ============================================================== -->
      <?php if (!empty($_SESSION['permisos'][COMPRAS]['w'])) { ?>
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de Gastos</h5>
              <div class="card-body"><br>
                <form action="javascript:void(0);" method="POST" id="gastosFrom" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                    <input type="hidden" id="emisor_identificador" name="emisor_identificador" value=" <?php echo $_SESSION['emisor_id']; ?>">
                      <input type="hidden" id="gastosid" name="gastosid">
                    </div>
                    <div class="col-md-6 mb-2">
                      <div class="select-wrapper">
                      <label for="tipo_gasto"></label>
                      <select name="tipo_gasto" id="tipo_gasto" class="form-control">
                        <option value="Selected">Seleccione</option>
                        <option value="COMPRA">COMPRA</option>
                        <option value="GASTO">GASTO</option>
                      </select>
                      <span class="title" data-placeholder="Tipo Gasto"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                    </div>
                    </div>
                    <div class="col-md-6 mb-2">
                      <div class="select-wrapper">
                      <label for="factura"></label>
                      <input id="gasto_factura" type="text" name="gasto_factura" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                      <span class="title" data-placeholder="Numero de factura"></span>
                      
                    </div>
                    </div>

                    <div class="form-group col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12"><br>
                    <div class="formulario__grupo" id="grupo__gd">
                      <div class="select-wrapper">
                      <label for="gastos_descripcion"></label>
                      <input id="gastos_descripcion" type="text" name="gastos_descripcion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      <span class="title" data-placeholder="Descripcion"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Descripcion solo puede contener numeros,letras y guiones.</p>
                    </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                    <div class="formulario__grupo" id="grupo__gt">
                      <div class="select-wrapper">
                      <label for="gastos_total"></label>
                      <input id="gastos_total" type="text" name="gastos_total" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      <span class="title" data-placeholder="Total"></span>
                      <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                      </div>
                      <p class="formulario__input-error">El campo Total solo puede contener numeros.</p>
                    </div>
                    </div>
                <!--
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="tipo_gasto">Emisor</label>
                     <div id='selectEmisor'></div>
                    </div>
                  -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-2">
                      <button type="submit" class="btn btn-space btn-primary" title="Guardar" style="border-radius: 50%; width:50px; height:50px"><i class="fa fa-save"></i></button>
                      <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
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

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br>
            <div class="card">
              <h5 class="card-header"> Listado de Gastos</h5>
              <div class="card-body">
                <div id="gastos" class="table-responsive"></div>
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
    <br><br>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/gastos.js"></script>
    <script src="../src/formularioventa.js"></script>
    
</body>

</html>