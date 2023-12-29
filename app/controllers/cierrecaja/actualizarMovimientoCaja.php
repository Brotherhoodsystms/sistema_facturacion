<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
if ($_POST["tipo_movimiento"] === "ENTRADA"){
  $arrayName = array(
    'sucursal_id' => $_POST["sucursal_id"],
    'tipo_movimiento' => $_POST["tipo_movimiento"],
    'movimiento_descripcion' => $_POST["movimiento_descripcion"],
    'movimiento_total' => $_POST["movimiento_total"],
    'movimiento_id' => $_POST["movimientoid"]
  );
}else{
$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'tipo_movimiento' => $_POST["tipo_movimiento"],
  'movimiento_descripcion' => $_POST["movimiento_descripcion"],
  'movimiento_total' => '-'.$_POST["movimiento_total"],
  'movimiento_id' => $_POST["movimientoid"]
);
}
echo json_encode(Cierrecaja::actualizarMovimientoCaja($arrayName));
