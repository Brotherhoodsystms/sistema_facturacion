<?php
session_start();
$bodega_id = $_SESSION['bodega_id'];
include dirname(dirname(__FILE__)) . "../../models/venta.php";
if ($_POST['tipo_producto'] == 'P') {
  $data = Venta::obtenerProductoBycodigotodosinBodega(strtoupper($_POST["producto_codigoserial"]));
  echo json_encode($data);
} else if ($_POST['tipo_producto'] == 'S') {
  $data = Venta::obtenerProductoBycodigoServicio(strtoupper($_POST["producto_codigoserial"]));
  echo json_encode($data);
}else{
  
}
