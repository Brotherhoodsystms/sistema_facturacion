<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$arrayName = array(
  'ubicacion_descripcion' => strtoupper($_POST["ubicacion_descripcion"]),
  'bodega_id' => $_POST["producto_bodegas"],
  'producto_id' => $_POST["producto_id_ubicacion"]
);
if (Ubicacion::validarDescripcionUbicacion(strtoupper($_POST["ubicacion_descripcion"]), $_POST["producto_bodegas"])['COUNT(*)'] >= 1) {
  echo 0;
} else {
  echo json_encode(Ubicacion::guardarUbicacion($arrayName));
}
//echo json_encode($arrayName);
