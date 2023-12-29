<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
session_start();
if($_POST["tipo_movimiento"] === "ENTRADA"){
  $arrayName = array(
    'sucursal_id' => $_POST["sucursal_id"],
    'tipo_movimiento' => strtoupper($_POST["tipo_movimiento"]),
    'movimiento_descripcion' => $_POST["movimiento_descripcion"],
    'movimiento_total' => $_POST["movimiento_total"],
    'usuario_id' => $_SESSION['idUser']
  );
}else{
$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'tipo_movimiento' => strtoupper($_POST["tipo_movimiento"]),
  'movimiento_descripcion' => $_POST["movimiento_descripcion"],
  'movimiento_total' => '-'.$_POST["movimiento_total"],
  'usuario_id' => $_SESSION['idUser']
);
}
echo json_encode(Cierrecaja::guardarMovimientoCaja($arrayName));
