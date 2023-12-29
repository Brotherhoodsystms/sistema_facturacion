<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
session_start();

date_default_timezone_set('America/Guayaquil');

$datos = $_POST['id'];
$emisor_id=$_SESSION['emisor_id'];

if (Cierrecaja::validarCajaIdUsuario($_POST["id"])['COUNT(*)'] === '1') {
  $facturasValor = Cierrecaja::totalVendidos($datos,$emisor_id);
  $notaVenta=Cierrecaja::totalNotaVenta($datos,$emisor_id);
  $reserva=Cierrecaja::totalReserva($datos,$emisor_id);
  $datacierrecajaid = Cierrecaja::obtenerCajaIdUsuario($_POST["id"]);
  $dataVentas = round(($facturasValor[0]['total']+$reserva[0]['total']+$notaVenta[0]['total']),2);
  $dataMovimientos = Cierrecaja::obtenerMovimientoTotal($datos);
  $datos = array(
    'cierrecajaid' => $datacierrecajaid,
    'totalVentas' => $dataVentas,
    'totalMovimientos' => $dataMovimientos[0]['movimientos'],
    'total'=>  $dataVentas + $dataMovimientos[0]['movimientos'] + $datacierrecajaid['cierrecaja_efectivo_asignacion']
  );
  echo json_encode($datos);
}else{
  echo 1;
}

