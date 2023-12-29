<?php
include dirname(dirname(__FILE__)) . '../../models/reportec.php';
//$data = Factura::obtenerFacturasActivas();
session_start();
$comisiones = Reportec::obtenerCompras($_SESSION['emisor_id']);
$totales=Reportec::obtenerTotalCompras();
$datos=array('busqueda'=>$comisiones,
'totales'=>$totales,
'usuario'=>$_SESSION['nomb_apelido']);

echo json_encode($datos);
