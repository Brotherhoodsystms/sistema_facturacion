<?php
include dirname(dirname(__FILE__)) . "../../models/reporte.php";
session_start();
if ($_POST["valor"] == 6){
  $data = Reporte::obtenerComisionFecha($_POST["fecha_i"].' 00:01:50', $_POST["fecha_f"].' 23:53:00',$_POST['sucursal']);
    $totales=Reporte::obtenerTotalFecha($_POST["fecha_i"].' 00:01:50', $_POST["fecha_f"].' 23:53:00',$_POST['sucursal']);
    $datos=array(
    'busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
}