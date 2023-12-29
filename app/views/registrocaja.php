<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php"; ?>
<?php
ob_start();
getpermisos(REGISTRO_CAJAS);
ob_end_clean();
?>

<body>

<div class="dashboard-main-wrapper">

<?php require_once "../plantilla/sidebar.php" ?>

<div class="dashboard-wrapper" id="containerbody">
    <div class="container-fluid dashboard-content">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title"></h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../views/index.php" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Cierres Caja</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Registro</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <?php if (!empty($_SESSION['permisos'][REGISTRO_CAJAS]['w']) || !empty($_SESSION['permisos'][REGISTRO_CAJAS]['u'])) { ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

              <div class="card">
                <h5 class="card-header">Registro de caja</h5>
                <div class="card-body"><br>
                  <form action="javascript:void(0);" method="POST" id="cierrecajaform" onsubmit="app.guardar()">
                    <div class="form-row" style=" margin: 0% 0% 1% 0%;">
                      <input type="text" id="cierrecaja_id" name="cierrecaja_id" hidden>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="select-wrapper">
                          <label for="sucursal"></label>
                          <div id="selectorSucursal" onchange="app.serieCajaChica()"> </div>
                          <span class="title" data-placeholder="Sucursal"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="select-wrapper">
                          <label for="serie"></label>
                          <input id="cierrecaja_serie" type="text" name="cierrecaja_serie" data-parsley-trigger="change" autocomplete="off" class="form-control" style="font-weight:bold; background-color: white;" readonly>
                          <span class="title" data-placeholder="Serie"></span>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="select-wrapper">
                          <label for="valor"></label>
                          <div id="selectorUsuario"></div>
                          <span class="title" data-placeholder="Usuario"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="select-wrapper">
                          <label for="asignacion"></label>
                          <input id="cierrecaja_fecha_asignacion" type="datetime-local" name="cierrecaja_fecha_asignacion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                          <span class="title" data-placeholder="Fecha de asignación"></span>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="formulario__grupo" id="grupo__adc">
                        <div class="select-wrapper">
                          <label for="cierrecaja_efectivo_asignacion"></label>
                          <input id="cierrecaja_efectivo_asignacion" type="text" name="cierrecaja_efectivo_asignacion" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                          <span class="title" data-placeholder="Asignar dinero caja"></span>
                          <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                        </div>
                        <p class="formulario__input-error">El campo Asignar dinero caja solo puede contener numeros.</p>
                      </div>
                      </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-space btn-primary" title="Guardar" style="border-radius: 50%; width:50px; height:50px"><i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px" onclick="app.limpiarInputs()"><i class="fa fa-times"></i></button>
                  </form>
                </div>
              </div>
            </div>
            <?php } ?>
            <br>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><br>
                <div class="card">
                    <h5 class="card-header">Listado de los registros caja</h5>
                    <div class="card-body">
                        <div class="table table-responsive" id="detalleCajas">
                            <!-- Contenido de la tabla -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php require_once "../plantilla/lower.php" ?>
<script src="../src/registrocaja.js"></script>
<script src="../src/formularioegresoBodega.js"></script>
</body>

</html>
