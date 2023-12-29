<?php
include dirname(dirname(__FILE__)) . '../../models/reporte.php';
session_start();
$emisor_id = $_SESSION['emisor_id'];
switch ($_POST['valor']) {
case '1':echo json_encode(Reporte::obtenerReservaProducto($_POST['parametro']));
break;
case '2':
    $data = Reporte::obtenerComisionVendedor($_POST['parametro'],$_POST['sucursal']);
    $totales=Reporte::obtenerTotalVendedor($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
case '9':
    $data = Reporte::obtenerComisionSucursal($_POST['parametro']);
    $totales=Reporte::obtenerTotalSucursal($_POST['parametro']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
    break;
case '4':
    $data = Reporte::obtenerComisionFactura($_POST['parametro'],$_POST['sucursal']);
    $totales=Reporte::obtenerTotalFactura($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
case '8':
    $data = Reporte::obtenerComisionComprobante($_POST['parametro'],$_POST['sucursal']);
    $totales=Reporte::obtenerTotalComprobante($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
default:echo 0;
}


