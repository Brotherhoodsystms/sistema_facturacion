<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(USUARIOS);

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
                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Administración</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuario</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

          <?php if (!empty($_SESSION['permisos'][USUARIOS]['w']) || !empty($_SESSION['permisos'][USUARIOS]['u'])) { ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header">Registro de usuario</h5>
                <br>
                <div class="card-body">
                  <form action="javascript:void(0);" method="POST" id="usuarioform" onsubmit="app.guardar()">
                    <div class="form-row">
                    <input type="text" id="usuario_identificador" name="usuario_identificador" hidden>
                      <div class="col-md-4 mb-2">
                        <div class="formulario__grupo" id="grupo__ci">
                          <div class="input-field">
                            <div class="formulario__grupo-input">
                              <input id="usuario_dni" type="text" name="usuario_dni" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="usuario_dni" class="formulario-label formulario__label">Dni o CI:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo CI solo puede contener numeros y el maximo son 10</p>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4 mb-2">
                        <div class="formulario__grupo" id="grupo__nombres">
                          <div class="input-field">

                            <input id="usuario_nombres" type="text" name="usuario_nombres" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                            <label for="usuario_nombres" class="formulario-label formulario__label">Nombres:</label>
                            <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                          </div>
                          <p class="formulario__input-error">El campo nombre solo puede contener letras</p>
                        </div>
                      </div>
                      <div class="col-md-4 mb-2">
                        <div class="formulario__grupo" id="grupo__telefono">
                          <div class="input-field">
                            <div class="formulario__grupo-input ">
                              <input id="usuario_telefono" type="text" name="usuario_telefono" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="usuario_telefono" class="formulario-label formulario__label">Telefono:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El campo telefono solo puede contener numeros y el maximo son 10</p>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4 mb-2">
                        <div class="formulario__grupo" id="grupo__email">
                          <div class="input-field">
                            <div class="formulario__grupo-input ">
                              <input id="usuario_email" type="text" name="usuario_email" data-parsley-trigger="change" autocomplete="off" class="form-control formulario__input">
                              <label for="usuario_email" class="formulario__label formulario-label">Email:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 mb-2">
                        <div class="input-field">
                          <div class="formulario__grupo" id="grupo__password">
                            <div class="formulario__grupo-input ">
                              <input id="password" name="password" type="password" class="form-control formulario__input">
                              <label for="password" class="formulario__label formulario-label">Password:</label>

                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-2">
                        <div class="input-field">
                          <div class="formulario__grupo" id="grupo__repassword">
                            <div class="formulario__grupo-input ">
                              <input id="usuario_password" name="usuario_password" data-parsley-equalto="#inputPassword" type="password" class="form-control formulario__input">
                              <label for="usuario_password" class="formulario__label formulario-label">Repetir Password:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                          </div>
                        </div>
                      </div>


                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                        <div class="select-wrapper">

                          <div id="selectorAcceso"></div>
                          <label for="selectorAcceso" class=""></label>

                          <span class="title" data-placeholder="Acceso o rol"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>


                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                        <div class="select-wrapper">

                          <div id="selectorSucursal"></div>
                          <label for="selectorSucursal" class=""></label>

                          <span class="title" data-placeholder="Sucursal"></span>
                          <i class="fa-solid fa-chevron-down icon"></i>
                        </div>
                      </div>

                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2s">
                        <div class="input-field">
                          <div class="formulario__grupo" id="grupo__repassword">
                            <div class="formulario__grupo-input ">

                              <div id="ubicacion_bodega_o">

                                <input id="" type="text" name="producto_comprar" autocomplete="on" class="form-control">
                                <label for="bodega" class="formulario__label formulario-label">Bodega :</label>


                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6 mb-2">
                        <div class="input-field">
                          <div class="" id="grupo__direccion">
                            <div class="formulario__grupo-input">
                              <input id="usuario_direccion" name="usuario_direccion" class="form-control formulario__input"></input>
                              <label for="usuario_direccion" class="formulario__label formulario-label">Direccion:</label>
                              <i class="formulario__validacion-estado fa-solid fa-circle-xmark"></i>
                            </div>
                            <p class="formulario__input-error">La dirección tiene que ser de 4 a 40 dígitos y solo puede contener números, letras y guion bajo.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Quinta Fila -->
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-space btn-primary" title="Guardar" style="border-radius: 8%;">Guardar</button>
                      <button type="reset" class="btn btn-space btn-secondary" title="Cancelar" style="border-radius: 8%; margin-left:14px" onclick="app.limpiarInputs()">Cancelar</button>
                    </div>
                    <br>
                </div>
                </form>
              </div>
            </div>
        </div>
      <?php } ?>


      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <br>
        <div class="card">
          <h5 class="card-header"> Listado de usuario</h5>
          <div class="card-body">
            <div id="usuarios" class="table-responsive"></div>
          </div>
        </div>
      </div>
      </div>

      <br><br>



      <?php require_once "../plantilla/lower.php" ?>
      <script src="../src/usuario.js"></script>
      <script src="../src/formulario.js"></script>


</body>

</html>