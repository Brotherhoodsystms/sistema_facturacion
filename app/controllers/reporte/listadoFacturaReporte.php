<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/reporte.php";
//$data = Factura::obtenerFacturasActivas();
//echo $_SESSION['emisor_id'];
if($_SESSION['id_rol']==1){
    $data=Reporte::obtenerFacturaTotal();
    $total=Reporte::obtenerTotalFacurasAdm();
}else{
    $data = Reporte::obtenerFacturasActivas($_SESSION['emisor_id']);
    $total=Reporte::obtenerTotalFacurasUsuario($_SESSION['emisor_id']);
}
$datos = array(
  'data' => $data,
  'permisosMod' => $_SESSION['permisosMod'],
  'nombre_apellido'=> $_SESSION['nomb_apelido'],
  'totales'=>$total
);
echo json_encode($datos);