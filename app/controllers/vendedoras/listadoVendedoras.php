<?php
include dirname(dirname(__FILE__)) . "../../models/vendedoras.php";
session_start();
$id_usuario = $_SESSION['idUser'];
$datosUsuario = Vendedoras::obtenerusuarioId('id_usuario');
//todo cambiar el modulo para que presente los datos por usuarios aun se debe modificar

$data = Vendedoras::obtenerReporteVendedoras();
for ($i = 0; $i < count($data); $i++) {
  $hora = date("H:i:s", strtotime($data[$i]['vendedoras_fechaI']));
  $fecha = date("Y-m-d", strtotime($data[$i]['vendedoras_fechaI']));
  $data[$i]['vendedoras_fechaI'] = $hora;
  $data[$i]['vendedoras_fecha'] = $fecha;
}

echo json_encode($data);
