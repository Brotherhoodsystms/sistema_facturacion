<?php
include dirname(dirname(__FILE__)) . "../../models/bodega.php";
$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'bodega_descripcion' => strtoupper($_POST["bodega_descripcion"])
);
$sucursal_nombre = Bodega::obtenerNombreSucursal($_POST["sucursal_id"]);

if(Bodega::validarDescripcionBodega(strtoupper($_POST["bodega_descripcion"]), $sucursal_nombre['sucursal_nombre'])){
  echo 0;
}else{
  echo json_encode(Bodega::guardarBodega($arrayName));
}
