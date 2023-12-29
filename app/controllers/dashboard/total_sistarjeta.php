<?php
include dirname(dirname(__FILE__)) . "../../models/dashboard.php";

session_start();
//$datos = 1;
date_default_timezone_set('America/Guayaquil');
//todo::por usuario si desea de todo se debe modificar el campo para que sea el Administrador
//todo::el unico en
$datos = $_SESSION['idUser'];
$emisor_id=$_SESSION['emisor_id'];
$forma_pago=4;
if($_SESSION['id_rol'] == '1'){
    $facturas = Dashboard::totalsinSistemaFacturasAd($datos,$forma_pago,$emisor_id);
    $nota_venta=Dashboard::totalNotaVentaxSinsisFinancieroAd($datos,$forma_pago,$emisor_id);
    $reserva=Dashboard::totalReservasinSinsistefiAd($datos,$forma_pago,$emisor_id);

}else{
    $facturas = Dashboard::totalsinSistemaFacturas($datos,$forma_pago);
    $nota_venta=Dashboard::totalNotaVentaxSinsisFinanciero($datos,$forma_pago);
    $reserva=Dashboard::totalReservasinSinsistefi($datos,$forma_pago);
}


echo json_encode($facturas['total']+$nota_venta['total']+$reserva['total']);