<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
session_start();
$id_usuario=$_SESSION['idUser'];
$datos = array(
  'bodega_id' => $_POST['temp_bodegaid_origen'],
  'description' => $_POST['tem_ubica_descripcion'],
  'producto_codigo' => $_POST['temp_ubica_productoid'],
  'bodega_origen' => $_POST['temp_bodegaid_origen'],
  'descriptiono' => $_POST['tem_ubica_descripciono'],
  'id_temp_productoid' => $_POST['tem_ubica_id']
);
echo json_encode(Producto::eliminarDetalletempId($_POST['tem_ubica_id'],$id_usuario));
