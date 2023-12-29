<?php
include dirname(dirname(__FILE__)) . "../../models/reportes.php";
session_start();
if ($_POST["valor"] == 6){
  $data = Reportes::obtenerCierresFecha($_POST["fecha_i"].' 00:01:50', $_POST["fecha_f"].' 23:53:00',$_POST['sucursal']);
     $datos=array(
    'busqueda'=>$data);
    echo json_encode($datos);
}