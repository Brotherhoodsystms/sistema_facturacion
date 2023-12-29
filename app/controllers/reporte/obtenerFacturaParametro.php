<?php
include dirname(dirname(__FILE__)) . "../../models/reporte.php";
session_start();
$emisor_id=$_SESSION['emisor_id'];

if ($_POST["valor"] == 1) {
  echo json_encode(Reporte::obtenerReservaProducto($_POST["parametro"]));
} else if ($_POST["valor"] == 2) {
  if($_SESSION['id_rol']==1){
    $data=Reporte::obtenerFacturaClienteTotal($_POST["parametro"],$_POST['sucursal']);
    $totales=Reporte::obtenerFacturaClienteTotals($_POST["parametro"],$_POST["sucursal"]);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
  }else{
   $data=Reporte::obtenerFacturaCliente($_POST["parametro"],$_POST['sucursal']);
   $totales=Reporte::obtenerFacturaClienteTotals($_POST["parametro"],$_POST["sucursal"]);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
  }
} else if ($_POST["valor"] == 3) {
  echo json_encode(Reporte::obtenerReservaVendedor($_POST["parametro"]));
} else if ($_POST["valor"] == 4) {

  $data=Reporte::obtenerFacturaNumero($_POST["parametro"],$_POST['sucursal']);
  $totales=Reporte::obtenerFacturaNumeroSuma($_POST["parametro"],$_POST["sucursal"]);
  $datos=array('busqueda'=>$data,
  'totales'=>$totales);
  echo json_encode($datos);
} else if ($_POST["valor"] == 5) {
  echo json_encode(Reporte::obtenerReservaFormaPago($_POST["parametro"]));
} else {
  echo 0;
}

// echo json_encode($_POST);
