<?php
include dirname(dirname(__FILE__)) . "../../models/establecimiento.php";
$arrayName = array(
  'nombre_establecimiento' => strtoupper($_POST["nombre_establecimiento"]),
  'codigo_establecimiento' => strtoupper($_POST["codigo_establecimiento"]),
  'nombre_comercial_estable' => $_POST["nombre_comercial_estable"],
  'direccion_establecimiento' => $_POST["direccion_establecimiento"],
  'estado_establecimiento' => $_POST["estado_establecimiento"],
  'emisor_establecimiento' => $_POST["emisor_establecimiento"]
);

echo json_encode(Establecimiento::guardarEstablecimiento($arrayName));
