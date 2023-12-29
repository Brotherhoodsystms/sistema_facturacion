<?php
include dirname(dirname(__FILE__)) . "../../models/sucursal.php";
$arrayName = array(
  'sucursal_provincia' => strtoupper($_POST["sucursal_provincia"]),
  'sucursal_nombre' => strtoupper($_POST["sucursal_nombre"]),
  'sucursal_direccion' => $_POST["sucursal_direccion"],
  'sucursal_telefono' => $_POST["sucursal_telefono"],
  'sucursal_id' => $_POST["sucursal_id"]
);
if (Sucursal::validarNombreActualizarSucursal(strtoupper($_POST["sucursal_nombre"]), $_POST['sucursal_id'])['COUNT(*)'] >= 2) {
  echo 1;
} else {
  echo json_encode(Sucursal::actualizarSucursal($arrayName));
}
