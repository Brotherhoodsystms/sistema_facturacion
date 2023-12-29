<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}

date_default_timezone_set('America/Guayaquil');

$tiempo_en_segundos = time();
$fecha_actual = date("H:i:s", $tiempo_en_segundos);
//echo "La fecha actual es: $fecha_actual";

require_once "../plantilla/header.php";
getPermisos(COMERCIAL);
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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Comercial</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vendedoras</li>
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
          <?php if (!empty($_SESSION['permisos'][COMERCIAL]['w']) || !empty($_SESSION['permisos'][COMERCIAL]['u'])) { ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header">Registro de Actividades</h5>
                <div class="card-body"><br>
                  <form action="javascript:void(0);" method="POST" id="vendedorRegistroform" onsubmit="app.guardar()">
                    <div class="form-row">
                      <div class="form-group">
                        <input type="hidden" id="resgistro_idvendedor" name="resgistro_idvendedor">
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2" hidden>
                        <label for=" direccion">Hora Inicio:</label>
                        <input id="vendedora_horainicion" name="vendedora_horainicion" class="form-control" type="text" value='<?php echo $fecha_actual;  ?>'></input>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__vn">
                          <div class="select-wrapper">
                            <label for="vendedoras_nombre"></label>
                            <input id="vendedoras_nombre" type="text" name="vendedoras_nombre" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Nombre comercial"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">Nombre comercial solo puede contener letras.</p>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__vc">
                          <div class="select-wrapper">
                            <label for="vendedoras_contacto"></label>
                            <input id="vendedoras_contacto" type="text" name="vendedoras_contacto" data-parsley-trigger="change" autocomplete="off" class="form-control" autofocus>
                            <span class="title" data-placeholder="Contacto"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Contacto solo puede contener letras.</p>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <div class="formulario__grupo" id="grupo__vt">
                          <div class="select-wrapper">
                            <label for="vendedoras_telefono"></label>
                            <input id="vendedoras_telefono" type="text" name="vendedoras_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control">
                            <span class="title" data-placeholder="Telefono"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Telefono solo puede contener numeros.</p>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2" hidden>
                        <label for="nombres">Telefono 2:</label>
                        <input id="vendedoras_telefono2" type="text" name="vendedoras_telefono2" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2" hidden>
                        <label for="nombres">Correo</label>
                        <input id="vendedoras_correo" type="text" name="vendedoras_correo" data-parsley-trigger="change" autocomplete="off" class="form-control">
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="formulario__grupo" id="grupo__vs">
                          <div class="select-wrapper">
                            <label for="vendedora_sector"></label>
                            <input id="vendedora_sector" name="vendedora_sector" class="form-control"></input>
                            <span class="title" data-placeholder="Sector"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Sector solo puede contener letras.</p>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="select-wrapper">
                          <label for="telefono"></label>
                          <select class='form-control' name='vendedoras_estatus' id='vendedoras_estatus' autofocus required>
                            <option disabled='selected' selected='selected'>Seleccione</option>;
                            <option value='INTERESADO'>INTERESADO</option>
                            <option value='NO INTERESADO'>NO INTERESADO</option>
                            <option value='VOLVER A VISITAR'>VOLVER A VISITAR</option>
                            <option value='DEMO DEL SISTEMA'>DEMO DEL SISTEMA</option>
                            <option value='CIERRE DE VENTAS'>CIERRE DE VENTAS</option>
                          </select>
                          <span class="title" data-placeholder="Estatus"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2"><br>
                        <div class="formulario__grupo" id="grupo__vo">
                          <div class="select-wrapper">
                            <label for="vendedoras_observacion"></label>
                            <input id="vendedoras_observacion" type="text" name="vendedoras_observacion" data-parsley-trigger="change" autocomplete="off" class="form-control">
                            <span class="title" data-placeholder="Observacion"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Observacion solo puede contener letras.</p>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2"><br>
                        <div class="formulario__grupo" id="grupo__vdi">
                          <div class="select-wrapper">
                            <label for="vendedor_direccion"></label>
                            <input id="vendedor_direccion" name="vendedor_direccion" class="form-control"></input>
                            <span class="title" data-placeholder="Direccion"></span>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Direccion solo puede contener numeros,letras y guiones.</p>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2" hidden>
                        <label for="direccion">Detalle Visita:</label>
                        <textarea id="vendedoras_detalle" name="vendedoras_detalle" class="form-control"></textarea>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2"><br>
                        <div class="select-wrapper">
                          <div class="form-group">
                            <label for="vendedoras_coordenadas"></label>
                            <div class="input-group">
                              <input id="vendedoras_coordenadas" name="vendedoras_coordenadas" class="form-control">
                              <div class="input-group-append">
                                <button type="button" class="btn btn-warning" onclick="app.obtenerGPS()">GPS</button>
                              </div>
                            </div>
                            <span class="title" data-placeholder="Coordenadas gps"></span>
                            <small id="status" class="form-text text-muted"></small>
                          </div>
                        </div>
                      </div>


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
              <h5 class="card-header"> Listado de vendedor</h5>
              <div class="card-body">
                <div id="vendedores" class="table-responsive"></div>
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
    <br><br>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/vendedoras.js"></script>
    <script src="../src/formularioventa.js"></script>
</body>

</html>