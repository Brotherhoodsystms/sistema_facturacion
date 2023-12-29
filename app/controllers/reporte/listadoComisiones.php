<?php
include dirname(dirname(__FILE__)) . '../../models/reporte.php';
//$data = Factura::obtenerFacturasActivas();
session_start();
$comisiones = Reporte::obtenerComisiones($_SESSION['emisor_id']);
$totales=Reporte::obtenerTotalComisiones();
$datos=array('busqueda'=>$comisiones,
'totales'=>$totales,
'usuario'=>$_SESSION['nomb_apelido']);

echo json_encode($datos);
