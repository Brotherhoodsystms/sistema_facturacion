<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(EMISOR); ?>

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Administración</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Emisor</li>
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
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header">Registro de emisor</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="emisorform" enctype="multipart/form-data" onsubmit="app.guardar()">
                  <div class="form-row">
                    <div class="form-group">
                      <input type="hidden" id="emisor_id" name="emisor_id">
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__ruc">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="emisor_ruc" type="text" name="emisor_ruc" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="emisor_ruc" class="formulario-label formulario__label">RUC:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Ruc solo puede contener numeros.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__rs">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="emisor_razon_social" type="text" name="emisor_razon_social" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input" autofocus>
                            <label for="emisor_razon_social" class="formulario-label formulario__label">Razon social:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Razon social solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__nc">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="emisor_ncomercial" type="text" name="emisor_ncomercial" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="emisor_ncomercial" class="formulario-label formulario__label">Nombre Comercial:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Nombre Comercial solo puede contener letras.</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <div class="formulario__grupo" id="grupo__dir">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input id="emisor_direcion" name="emisor_direcion" class="form-control formulario__input"></input>
                            <label for="emisor_direcion" class="formulario-label formulario__label">Direccion:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">La dirección tiene que ser de 4 a 40 dígitos y solo puede contener números, letras y guiones.</p>
                        </div>

                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                      <div class="select-wrapper">
                        <label for="ambiente"></label>
                        <div>
                          <select id="emisor_ambiente" name="emisor_ambiente" required="required" class="form-control">
                            <option value="">Seleccione el Ambiente</option>
                            <option value="1" selected="selected">Pruebas</option>
                            <option value="2">Producción</option>
                          </select>
                          <span class="title" data-placeholder="Ambiente"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label></label>
                        <div>
                          <select id="emisor_tipoEmision" name="emisor_tipoEmision" required="required" class="form-control">
                            <option value="">Seleccione el Tipo de Emisión</option>
                            <option value="1" selected="selected">Normal</option>
                            <option value="2">Indisponibilidad SRI</option>
                          </select>
                          <span class="title" data-placeholder="Tipo emision"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="select-wrapper">
                        <label></label>
                        <div>
                          <select id=" emisor_obligadoContabilidad" name="emisor_obligadoContabilidad" required="required" class="form-control">
                            <option value="">Obligado Contabilidad?</option>
                            <option value="SI">SI</option>
                            <option value="NO" selected="selected">NO</option>
                          </select>
                          <span class="title" data-placeholder="Obligado Contabilidad"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <div class="formulario__grupo" id="grupo__contri">
                        <br>
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input type="text" id="emisor_contribuyenteEspecial" name="emisor_contribuyenteEspecial" class="form-control formulario__input">
                            <label for="emisor_contribuyenteEspecial" class="formulario-label formulario__label">Contribuyente</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Contribuyente solo puede contener numeros.</p>
                        </div>
                      </div>
                    </div>


                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__rar">
                        <div class="input-field">
                          <div class="formulario__grupo-input">
                            <input type="text" id="emisor_resolucionAgenteRetencion" name="emisor_resolucionAgenteRetencion" class="form-control formulario__input">
                            <label for="emisor_resolucionAgenteRetencion" class="formulario-label formulario__label">Resolución agente retención</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo Resolucion solo puede contener numeros.</p>
                        </div>
                      </div>
                    </div>


                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                      <br>
                      <div class="formulario__grupo" id="grupo__cf">
                        <div class="input-field">
                          <div class="formulario__grupo-input">

                            <input type="password" id="emisor_passFirma_first" name="emisor_passFirma_first" required="required" class="form-control formulario__input">
                            <label for="emisor_passFirma_first" class="formulario-label formulario__label">Contraseña Firma</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>

                        </div>
                      </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2"><br>
                      <div class="formulario__grupo" id="grupo__rec">
                        <div class="input-field">
                          <div class="formulario__grupo-input">

                            <input type="password" id="emisor_passFirma_second" name="emisor_passFirma_second" required="required" class="form-control formulario__input">
                            <label for="emisor_passFirma_second" class="formulario-label formulario__label">Re-Contraseña</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>

                          </div>
                          <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                    <label>Tipo de regimen </label>
                    <div>
                      <select id="emisor_regimen" name="emisor_regimen" required="required" class="form-control">
                        <option value="">Seleccione el Tipo de Regimen</option>
                        <option value="1" selected="selected">Contribuyente régimen RIMPE</option>
                        <option value="2">Contribuyente Negocio Popular-RIMPE</option>
                        <option value="3">Contribuyente Mircroempresa-RIMPE</option>
                      </select>
                    </div>
              </div>
            -->


                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                      <div class="select-wrapper">
                        <label for="sucursal"></label>
                        <select class='form-control' name='emisor_regimenRimpe' id='emisor_regimenRimpe' autofocus required>";

                          <option disabled='selected' selected='selected'>Seleccione</option>";

                          <option value="1">RIMPE</option>
                          <option value="2">Negocio Popular-RIMPE</option>
                          <option value="3">Mircroempresa-RIMPE</option>
                        </select>
                        <span class="title" data-placeholder="Regimen"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1">
                      <div class="select-wrapper">
                        <label for="sucursal"></label>
                        <div id="sucursal_emisor"></div>
                        <span class="title" data-placeholder="Sucursal"></span>
                        <i class="fa-solid fa-chevron-down icon"></i>
                      </div>
                    </div>



                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                      <label>Logo</label>
                      <input type="file" id="emisor_logo" name="emisor_logo" required="required">

                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-1"><br>
                      <label>Firma</label>

                      <input type="file" id="emisor_firma" name="emisor_firma" required="required">
                    </div>


                    <input type="hidden" id="factelbundle_emisor__token" name="factelbundle_emisor[_token]" class="form-control" value="rvlS5pG_6QkekOcQKIN5Em1hfduzD97kwEBa000afOc">
                  </div>
                  <br>
                  <button id="submit" type="submit" class=" btn btn-space btn-primary">Guardar </button>

                </form>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- end category revenue  -->
          <!-- ============================================================== -->

          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <br>
            <div class="card">
              <h5 class="card-header"> Listado de Emisores</h5>
              <div class="card-body">
                <div id="emisor" class="table-responsive"></div>
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
    <script src="../src/emisor.js"></script>
    <script src="../src/formularioemisor.js"></script>
</body>

</html>