<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php" ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- ============================================================== -->
          <!-- profile -->
          <!-- ============================================================== -->
          <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- card profile -->
            <!-- ============================================================== -->
            <div class="card">
              <div class="card-body">
                <div class="user-avatar text-center d-block">
                  <img src="../../public/images/perfil.png" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                </div>
                <div class="text-center"style="margin-top: 10px;">
                  <h4 class="font-24 mb-0"id="usuario"style="font-size: 24px;"><?php echo $_SESSION['nomb_apelido']; ?></h4>
                  <p style="font-size: 13px;"><strong><?php echo $_SESSION['rol']; ?></p></strong>
                </div>
              </div>
              <div class="card-body border-top">
                <h4 class="font-16"style="font-weight: 500;">Información de usuario</h4>
                <div class="">
                  <ul class="list-unstyled mb-0">
                  <li class="mb-2"><i class="fa-solid fa-id-card mr-2" style="color:#4E73DF;"></i><?php echo $_SESSION['ci']; ?></li>
                    <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"style="color:#4E73DF;"></i><?php echo $_SESSION['email']; ?></li>
                    <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"style="color:#4E73DF;"></i><?php echo $_SESSION['telefono']; ?></li>
                  </ul>
                </div>
              </div>
              <div class="card-body border-top">
                <h3 class="font-16"style="font-weight: 500;">Rating</h3>
                <h1 class="mb-0"style="font-weight: 500;">5.0</h1>
                <div class="rating-star">
                  <i class="fa fa-fw fa-star"style="color: #f5d014;"></i>
                  <i class="fa fa-fw fa-star"style="color: #f5d014;"></i>
                  <i class="fa fa-fw fa-star"style="color: #f5d014;"></i>
                  <i class="fa fa-fw fa-star"style="color: #f5d014;"></i>
                  <i class="fa fa-fw fa-star"style="color: #f5d014;"></i>
                  <p class="d-inline-block text-dark">14 Reviews </p>
                </div>
              </div>
              <div class="card-body border-top">
                <h4 class="font-16"style="font-weight: 500;">Brotherhood System</h4>
                <div class="">
                  <ul class="mb-0 list-unstyled">
                    <li class="mb-2"><a href="#"><i class="fab fa-fw fa-facebook-square mr-1 facebook-color"></i>fb.me/brotherhoodecua</a></li>
                    <li class="mb-2"><a href="#"><i class="fab fa-fw fa-brands fa-x-twitter mr-1 twitter-color"style="color: #000;"></i>x.com/brotherhoodecua</a></li>
                    <li class="mb-2"><a href="#"><i class="fab fa-fw fa-instagram mr-1 instagram-color"style="color: #C50DB5;"></i>insta.com/brotherhoodecua</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- ============================================================== -->
            <!-- end card profile -->
            <!-- ============================================================== -->
          </div>
          <!-- ============================================================== -->
          <!-- end profile -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- campaign data -->
          <!-- ============================================================== -->
          <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- campaign tab one -->
            <!-- ============================================================== -->
            <div class="card">
              <h5 class="card-header">Perfil usuario</h5>
              <div class="card-body">
                <form action="javascript:void(0);" method="POST" id="usuarioperfilform">
                  <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12" style="margin-top: 10px;">
                      <div class="form-group">
                        <label for="usuario_dni"></label>
                        <div class="select-wrapper">
                          <input type="text" class="form-control form-control-lg" id="usuario_dni" autofocus>
                          <span class="title" data-placeholder="CI"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-12"style="margin-top: 10px;">
                      <div class="form-group">
                        <label for="usuario_nombres"></label>
                        <div class="select-wrapper">
                          <input type="text" class="form-control form-control-lg" id="usuario_nombres">
                          <span class="title" data-placeholder="Nombres"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-12"style="margin-top: 10px;">
                      <div class="form-group">
                        <label for="usuario_telefono"></label>
                        <div class="select-wrapper">
                          <input type="text" class="form-control form-control-lg" id="usuario_telefono">
                          <span class="title" data-placeholder="Teléfono"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-12"style="margin-top: 10px;">
                      <div class="form-group">
                        <label for="usuario_email"></label>
                        <div class="select-wrapper">
                          <input type="email" class="form-control form-control-lg" id="usuario_email">
                          <span class="title" data-placeholder="Email"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-12"style="margin-top: 10px;">
                      <div class="form-group">
                        <label for="usuario_direccion"></label>
                        <div class="select-wrapper">
                          <input class="form-control form-control-lg" id="usuario_direccion" rows="3"></input>
                          <span class="title" data-placeholder="Dirección"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12"style="margin-top: 10px;">
                      <button type="submit" class="btn btn-primary btn-sm float-right">Actualizar</button>
                    </div>
                  </div>
                </form>


              </div>
            </div>
            <!-- ============================================================== -->
            <!-- end campaign tab one -->
            <!-- ============================================================== -->
          </div>
          <!-- ============================================================== -->
          <!-- end campaign data -->
          <!-- ============================================================== -->

          <!-- ============================================================== -->
          <!-- end pageheader -->
          <!-- ============================================================== -->
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
    <br><br><br>
    <?php require_once "../plantilla/lower.php" ?>
    <script src="../src/perfil.js"></script>
</body>

</html>