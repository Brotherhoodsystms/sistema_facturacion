<?php
include dirname(dirname(__FILE__)) . "../../models/bodega.php";
$datos = array(
  'sucursal_id' => $_POST['id'],
  'codigo_serie' => $_POST['codigo_serie']

);
$data = Bodega::obtenerBodegaReferenciaSucursal($datos);
echo json_encode($data);
