<?php
include dirname(dirname(__FILE__)) . '../../models/reportes.php';
session_start();
$emisor_id = $_SESSION['emisor_id'];
switch ($_POST['valor']) {
case '1':echo json_encode(Reporte::obtenerReservaProducto($_POST['parametro']));
break;
case '2':
    $data = Reportes::obtenerStockCodigo($_POST['parametro'],$_POST['sucursal']);
    $totales=Reportes::obtenerTotalStock($_POST['parametro'],$_POST['sucursal']);
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
    $data = Reportes::obtenerStockUbicacion($_POST['parametro'],$_POST['sucursal']);
    $totales=Reportes::obtenerTotalubicacion($_POST['parametro'],$_POST['sucursal']);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
break;
default:echo 0;
}


