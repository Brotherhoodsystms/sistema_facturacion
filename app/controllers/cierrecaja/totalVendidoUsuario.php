<?php
include dirname(dirname(__FILE__)) . "../../models/dashboard.php";

session_start();
//$datos = 1;
date_default_timezone_set('America/Guayaquil');

$datos = $_POST['id_usuario'];
$emisor_id=$_SESSION['emisor_id'];

$facturasValor = Dashboard::totalVendidos($datos,$emisor_id);
$notaVenta=Dashboard::totalNotaVenta($datos,$emisor_id);
$reserva=Dashboard::totalReserva($datos,$emisor_id);

$data1['ventas_dia'] = round(($facturasValor[0]['total']+$reserva[0]['total']+$notaVenta[0]['total']),2);


echo json_encode($data1);
