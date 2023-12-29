<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: ./login.php');
  die();
}
require_once "../plantilla/header.php";
getpermisos(DASHBOARD); ?>



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
                  <li class="breadcrumb-item active" aria-current="page">Estadistica</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Estadistica por Día<button id='ocultarDia' onclick='app.ocultarDia()' class="btn btn-success btn-xs">-</button><button onclick='app.visualizarDia()' id='visualizarDia' class="btn btn-success btn-xs">+</button></h5>
            <div class="card-body">
              <div id="estadistica_dia" class="table-responsive"></div>
            </div>
          </div>
        </div>

        <!-- toto los campos por mes  -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Estadistica por Mes<button id='ocultarMes' onclick='app.ocultarMes()' class="btn btn-success btn-xs">-</button><button onclick='app.visualizarMes()' id='visualizarMes' class="btn btn-success btn-xs">+</button></h5>
            <div class="card-body">
              <div id="estadistica_mes" class="table-responsive"></div>
            </div>
          </div>
        </div>


      </div>



      </main>



    </div>




  </div>

  <?php require_once "../plantilla/lower.php" ?>
  <script src="../src/dashboard_index.js"></script>

  </html>