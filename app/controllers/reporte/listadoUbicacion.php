<?php
include dirname(dirname(__FILE__)) . "../../models/reportes.php";
session_start();
$data = Reportes::obtenerProductosKardexID($_POST['id']);
$totales=Reportes::obtenerTotalKarx();
$datos = array(
    'busqueda' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido'],
    'totales'=>$totales
  );
echo json_encode($datos);