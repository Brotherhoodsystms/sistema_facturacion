<?php
include dirname(dirname(__FILE__)) . "../../models/bodega.php";

$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'bodega_descripcion' => strtoupper($_POST["bodega_descripcion"]),
  'bodega_id' => $_POST["bodega_id"]
);

$sucursal_nombre = Bodega::obtenerNombreSucursal($_POST["sucursal_id"]);

if (Bodega::validarDescripcionActualizarBodega(strtoupper($_POST["bodega_descripcion"]), $sucursal_nombre['sucursal_nombre'], $_POST["bodega_id"])['COUNT(*)'] >= 2) {
  echo 0;
} else {
  echo json_encode(Bodega::actualizarBodega($arrayName));
}
