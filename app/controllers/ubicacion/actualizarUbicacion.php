<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$arrayName = array(
  'ubicacion_descripcion' => strtoupper($_POST["ubicacion_descripcion"]),
  'bodega_id' => $_POST["ubicacion_bodega_r"],
  'ubicacion_id' => $_POST["ubicacion_id"],
);
if (Ubicacion::validarDescripcionActualizarUbicacion($arrayName)['COUNT(*)'] >= 2) {
  echo 0;
} else {
  echo json_encode(Ubicacion::actualizarUbicacion($arrayName));
}
// echo json_encode($arrayName);
