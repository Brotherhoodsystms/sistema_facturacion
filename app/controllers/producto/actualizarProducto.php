<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$arrayName = array(
  'producto_codigoserial' => strtoupper($_POST["producto_codigoserial"]),
  'producto_descripcion' => $_POST["producto_descripcion"],
  'producto_precio' => $_POST["producto_precioxMe"],
  'producto_stock' => $_POST["producto_stock"],
  'producto_fechaelaboracion' => $_POST["producto_fechaelaboracion"],
  'producto_fechaexpiracion' => $_POST["producto_fechaexpiracion"],
  'categoria_id' => strtolower($_POST["categoria_id"]),
  'lote_id' => $_POST["lote_id"],
  'proveedor_id' => $_POST["proveedor_id"],
  'producto_id' => $_POST["producto_id"]
);
if (Producto::validarCodigoserialActualizarProducto(strtoupper($_POST["producto_codigoserial"]), $_POST['producto_id'])['COUNT(*)'] >= 2) {
  echo 1;
} else {
  echo json_encode(Producto::actualizarProductos($arrayName));
}
