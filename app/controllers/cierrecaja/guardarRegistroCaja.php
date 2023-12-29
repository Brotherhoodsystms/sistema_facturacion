<?php
// include_once "../../models/usuario.php";
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
// include dirname(dirname(__FILE__)) . "../../utils/encriptacion.php";
$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'cierrecaja_serie' => $_POST["cierrecaja_serie"],
  'usuario_id' => $_POST["tipo_usuario_id"],
  'cierrecaja_fecha_asignacion' => $_POST["cierrecaja_fecha_asignacion"],
  'cierrecaja_efectivo_asignacion' => $_POST["cierrecaja_efectivo_asignacion"]
);
  echo json_encode(Cierrecaja::guardarRegistroCaja($arrayName));
