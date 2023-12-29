<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'cierrecaja_serie' => $_POST["cierrecaja_serie"],
  'tipo_usuario_id' => $_POST["tipo_usuario_id"],
  'cierrecaja_fecha_asignacion' => $_POST["cierrecaja_fecha_asignacion"],
  'cierrecaja_efectivo_asignacion' => $_POST["cierrecaja_efectivo_asignacion"],
  'cierrecaja_id' => $_POST["cierrecaja_id"]
);

if (Cierrecaja::validarActualizarCaja($_POST['tipo_usuario_id'])['COUNT(*)'] >= 2) {
  echo 1;
} else {
  echo json_encode(Cierrecaja::actualizarCaja($arrayName));
}