<?php
include dirname(dirname(__FILE__)) . '../../models/reportec.php';
session_start();
$emisor_id = $_SESSION['emisor_id'];
switch ($_POST['valor']) {
case '1'://echo json_encode(Reportec::obtenerReservaProducto($_POST['parametro']));
break;
case '2':
    $data = Reportec::obtenerComprasVendedor($_POST['parametro'],$_POST['sucursal']);
    $totales=Reportec::obtenerTotalVendedor($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
case '9':
    $data = Reportec::obtenerComprasSucursal($_POST['parametro']);
    $totales=Reportec::obtenerTotalSucursal($_POST['parametro']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
    break;
case '4':
    $data = Reportec::obtenerComprasFactura($_POST['parametro'],$_POST['sucursal']);
    $totales=Reportec::obtenerTotalFactura($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
case '8':
    $data = Reportec::obtenerComprasComprobante($_POST['parametro'],$_POST['sucursal']);
    $totales=Reportec::obtenerTotalComprobante($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
default:echo 0;
}
