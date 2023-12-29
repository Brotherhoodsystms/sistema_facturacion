<?php
include dirname(dirname(__FILE__)) . "../../models/reporte.php";
session_start();
if ($_POST["valor"] == 6) {
  if($_SESSION['id_rol']==1){
    $data=Reporte::obtenerFacturaFechaTotal($_POST["fecha_i"], $_POST["fecha_f"],$_POST["sucursal"]);
    $totales=Reporte::obtenerFacturaFechaTotalS($_POST["fecha_i"],$_POST["fecha_f"],$_POST["sucursal"]);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
  }else{
    $data = Reporte::obtenerFacturaFecha($_POST["fecha_i"], $_POST["fecha_f"],$_SESSION['emisor_id']);
    $totales=Reporte::obtenerFacturaFechaS($_POST["fecha_i"],$_POST["fecha_f"],$_POST["sucursal"]);
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
  }
} else {
  echo 0;
}
