<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";

  $movimientos=$_POST["total_movimientos_cierrecaja"];
  $faltante=$_POST["efectivo_entregado_cierrecaja"]-($_POST["caja_inicial_cierrecaja"]+$_POST["total_ventas_cierrecaja"] + $movimientos);

if(empty($_POST["observacion_entregado_cierrecaja"])){
  $observacion = "NINGUNA";
}else{
  $observacion=$_POST["observacion_entregado_cierrecaja"];
}

$arrayName = array(
  'cierrecaja_fecha_liquidacion' => $_POST["fecha_entregada_cierrecaja"],
  'cierrecaja_usuario_entregado' => $_POST["usuario_entregado_cierrecaja"],
  'cierrecaja_efectivo_entregado' => $_POST["efectivo_entregado_cierrecaja"],
  'cierrecaja_total_ventas' => $_POST["total_ventas_cierrecaja"],
  'cierrecaja_total_movimientos' => $movimientos,
  'cierrecaja_efectivo_faltante' => round($faltante,2),
  'cierrecaja_observacion' => $observacion,
  'cierrecaja_id' => $_POST["cierrecaja_id"]
);
//echo $arrayName;
if (Cierrecaja::actualizarCajaEntrega($arrayName)){
  echo json_encode(Cierrecaja::actualizarMovimientosCierreCaja($_POST["usuario_id"]));
}else{
  echo 1;
}
  
