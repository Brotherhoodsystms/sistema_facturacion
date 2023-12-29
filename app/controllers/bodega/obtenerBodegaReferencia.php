<?php
include dirname(dirname(__FILE__)) . "../../models/bodega.php";

$id_sucursal = Bodega::obtenerSucursal($_POST['id']);
//TODO::valida si  el controlador es usado por el punto de emision o
//todo::por la bodega
if (empty($id_sucursal)) {
  $data = Bodega::obtenerBodegaReferencia($_POST['id']);
  echo json_encode($data);
} else {
  $data = Bodega::obtenerBodegaReferencia($id_sucursal['id_sucursal']);
  echo json_encode($data);
}
