<?php
session_start();

if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}

require_once "../plantilla/header.php";
getpermisos(ROLES);
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
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <?php if (!empty($_SESSION['permisos'][ROLES]['w']) || !empty($_SESSION['permisos'][ROLES]['u'])) { ?>
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="card">
                <h5 class="card-header">Registro de Roles</h5>
                <div class="card-body">
                  <form action="javascript:void(0);" method="POST" id="rolform" onsubmit="app.guardarRol()">
                    <div class="form-row">
                      <div class="form-group">
                        <input type="hidden" id="rol_id" name="rol_id">
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">

                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-lg-12">
                              <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <label for="rol_descripcion">Descripción:</label>
                        <textarea id="descripcion_rol" name="descripcion_rol" class="form-control"></textarea>
                      </div> -->

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

        <!-- Modal para los permisos -->
        <div class="">
          <!-- Modal -->
          <form action="javascript:void(0);" method="POST" id="permisosform">
                <div class=" form-row">
            <div class="form-group">
              <div class="modal fade" id="exampleModalPermiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Permisos</h5>
                      <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </a>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="card">
                        <h5 class="card-header"> Listado de Permisos</h5>
                        <div class="card-body">
                          <div id="permisos1" class="table-responsive"></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" title="Guardar" style="border-radius: 50%; width:50px; height:50px" onclick="app.actualizarPermisos()"><i class='fas fa-save'></i></button>
                      <button class="btn btn-secondary" title="Cancelar" style="border-radius: 50%; width:50px; height:50px" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </form>
      </div>

      <?php if (!empty($_SESSION['permisos'][ROLES]['w']) || !empty($_SESSION['permisos'][ROLES]['u'])) { ?>
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <h5 class="card-header"> Listado de permisos</h5>
              <div class="card-body">
                <div id="roles" class="table-responsive"></div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <br><br><br>
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formAccesos">
            <div class="modal-body">
              <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/rol.js"></script>
    <script src="../src/formulariorol.js"></script>
  </div>
  </div>
</body>

</html>