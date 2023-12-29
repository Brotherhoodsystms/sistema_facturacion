<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(DASHBOARD); ?>


<?php require_once "../plantilla/sidebar.php" ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title"></h2>
        <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Estadistica por Día</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="../views/facturaA.php" style="text-decoration: none; color: inherit;">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Sin utilización Sistema Financiero</div>

                  <div id="ssisfinanciero" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                  <i class="fa-solid fa-file-invoice-dollar fa-2x" style="color: #4e73df;"></i>

                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="../views/reserva.php" style="text-decoration: none; color: inherit;">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Con utilización Sistema Financiero</div>
                  <div id="csisfinanciero" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                  <i class="fa-solid fa-cash-register fa-2x" style="color: #00c06c;"></i>

                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>

      <!-- Earnings (Annual) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="../views/notaventa.php" style="text-decoration: none; color: inherit;">

          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Compensación de Deuda</div>
                  <div id="cpdsisfinanciero" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                  <i class="fa-solid fa-hand-holding-dollar fa-2x" style="color: #4E73DF;"></i>

                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>


      <!-- Tasks Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="../views/facturaA.php" style="text-decoration: none; color: inherit;">

          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Tarjeta
                    de Debito
                  </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div id="tardebitofinaciero" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-auto">
                  <i class="fa-solid fa-credit-card fa-2x" style="color: #24b0c5;"></i>

                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="#" style="text-decoration: none; color: inherit;">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Tarjeta de Crédito</div>
                  <div id="tarcreditofinaciero" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                  <i class="fa-brands fa-cc-visa fa-2x fa-2x" style="color: #f6c23e;"></i>

                </div>
              </div>
            </div>
          </div>
      </div>
      </a>
  </div>
<?php } ?>


<!-- Page Heading -->
<br>
<!-- Content Row -->
<div class="row">
  <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>
    <!-- Primer diagrama en una fila -->
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-area me-1"></i> Gráfico de Área</h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart" width="100%"height="30"></canvas>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<div class="row">
  <?php if (!empty($_SESSION['permisos'][DASHBOARD]['r'])) { ?>
    <!-- Segundo diagrama en la misma fila que el tercero -->
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-bar me-1"></i> Gráfico de Barras</h6>
        </div>
        <div class="card-body">
          <div class="chart-bar">
            <canvas id="myBarChart"width="100%" height="57"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Tercer diagrama en la misma fila que el segundo -->
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie me-1"></i> Gráfico Circular</h6>
        </div>
        <div class="card-body"><canvas id="myPieChart" width="100%" height="57"></canvas></div>
      </div>
    </div>
  <?php } ?>
</div>


<!-- /.container-fluid -->

<!-- End of Main Content -->

</div>

<br><br>
<?php require_once "../plantilla/lower.php" ?>
<script src="../src/dashboard.js"></script>
</body>

</html>