<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$datos = array(
  'bodega_id' => $_POST['temp_bodegaid_origen'],
  'description' => $_POST['tem_ubica_descripcion'],
  'producto_codigo' => $_POST['temp_ubica_productoid'],
  'bodega_origen' => $_POST['temp_bodegaid_origen'],
  'descriptiono' => $_POST['tem_ubica_descripciono']
);
$ubicacion = Ubicacion::obtenerUbicacionParametrosbpdes($datos);
/*
if (!empty($ubicacion)) {
  echo  "1"; //borrar solo del temporal
} else {
  echo  "2";
}*/
$producto_id = $_POST['temp_ubica_productoid'];
$producto_stocknuevo = $_POST['tem_ubica_cantidad'] + $ubicacion['ubicacion_cantidad'];
//echo json_encode($producto_stocknuevo);
if (Ubicacion::actualizarUbicacionStockId($ubicacion['ubicacion_id'], $producto_stocknuevo)) {
  if (Ubicacion::eliminarDetalletempId($_POST['tem_ubica_id'])) {
    echo 1;
  }
}
