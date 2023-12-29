<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/retencion.php";
$arrayDetalle=array(
    'base'=>$_POST['base'],
    'porcentaje'=>$_POST['porcentaje'],
);
$total=(($arrayDetalle['base']*$arrayDetalle['porcentaje'])/100)+$arrayDetalle['base'];
echo json_encode($total);
///ar_dump($arrayDetalle);