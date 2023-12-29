<?php

session_start();
include dirname(dirname(__FILE__)) . "../../models/retencion.php";
$arrayDetalle=array(
    'id_emisor'=>$_SESSION['emisor_id'],
    'tipo_renta'=>$_POST['tipo_renta'],
    'porcentaje_retencion'=>$_POST['ubicacion_descripcion_o'],
    'base'=>$_POST['producto_descuento'],
    'total'=>$_POST['producto_comprar'],
    'id_usuario'=>$_SESSION['idUser'],


);
echo json_encode(Retencion::guardarDetalleTemporal($arrayDetalle));
///ar_dump($arrayDetalle);