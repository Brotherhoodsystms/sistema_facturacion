<?php
include dirname(dirname(__FILE__)) . "../../models/establecimiento.php";
$arrayName = array(
  'estableciminto_id' => $_POST["estableciminto_id"],
  'nombre_establecimiento' => strtoupper($_POST["nombre_establecimiento"]),
  'codigo_establecimiento' => $_POST["codigo_establecimiento"],
  'nombre_comercial_estable' => strtoupper($_POST["nombre_comercial_estable"]),
  'direccion_establecimiento' => strtoupper($_POST["direccion_establecimiento"]),
  'estado_establecimiento' => $_POST["estado_establecimiento"],
  'emisor_establecimiento' => $_POST["emisor_establecimiento"]
);
//$sucursal_nombre = Bodega::obtenerNombreSucursal($_POST["sucursal_id"]);
//if (Bodega::validarDescripcionActualizarBodega(strtoupper($_POST["bodega_descripcion"]), $sucursal_nombre['sucursal_nombre'], $_POST["bodega_id"])['COUNT(*)'] >= 2) {
//echo 0;
//} else {
echo json_encode(Establecimiento::actalizarEstablecimiento($arrayName));
//}
