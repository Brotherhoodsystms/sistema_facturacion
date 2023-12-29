<?php

include dirname(dirname(__FILE__)) . "../../models/productos.php";

$nombre_imagen = $_FILES['foto']['name'];
$temporal = $_FILES['foto']['tmp_name'];
$carpeta = "../../img";
$ruta = $carpeta.'/'.$nombre_imagen;
move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);


$arrayName = array(
  'proveedor_id'=>$_POST['proveedor_id'],
  'categoria_id'=>$_POST['categoria_id'],
  'codigo_producto'=>$_POST['producto_codigoserial'],
  'producto_descripcion'=> strtoupper($_POST['producto_descripcion']),
  'producto_precio_compra'=> $_POST['producto_precio_compra'],
  'producto_precio_venta'=> $_POST['producto_precio_venta'],
  'producto_fechaelaboracion'=> $_POST['producto_fechaelaboracion'],
  'producto_fechaexpiracion'=> $_POST['producto_fechaexpiracion'],
  'producto_stock'=> $_POST['producto_stock'],
  'tipo_impuesto_id'=> $_POST['tipo_impuesto_id'],
  'porcentaje_iva'=> $_POST['porcentaje_iva'],
  'producto_ca'=> '0',
  'producto_imagen'=> $ruta
);
if (Productos::validarCodigoserial($_POST['producto_codigoserial'])['COUNT(*)'] >= 1) {
  echo json_encode(false);
} else{ 
  
  echo json_encode(Productos::guardarProductos($arrayName));
}