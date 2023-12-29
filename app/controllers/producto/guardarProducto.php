<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
if (empty($_POST["producto_fechaelaboracion"])) {
  $fechainicial = '9999-09-09';
} else {
  $fechainicial = $_POST["producto_fechaelaboracion"];
}
if (empty($_POST["producto_fechaexpiracion"])) {
  $fechafinal = '9999-09-09';
} else {
  $fechafinal = $_POST["producto_fechaexpiracion"];
}
$arrayName = array(
  'producto_codigoserial' => strtoupper($_POST["producto_codigoserial"]),
  'producto_descripcion' => $_POST["producto_descripcion"],
  'producto_precioxMe' => $_POST["producto_precioxMe"],
  'producto_precioxMa' => $_POST["producto_precioxMa"],
  'producto_stock' => $_POST["producto_stock"],
  'producto_fechaelaboracion' => $fechainicial,
  'producto_fechaexpiracion' => $fechafinal,
  'categoria_id' => strtolower($_POST["categoria_id"]),
  'lote_id' => $_POST["lote_id"],
  'proveedor_id' => $_POST["proveedor_id"]
);

if (Producto::validarCodigoserialProducto($_POST["producto_codigoserial"])) {
  echo 1;
} else {
  $ingreso = Producto::guardarProductos($arrayName);
  $id_producto = Producto::obtenerIdproducto($arrayName['producto_codigoserial']);
  if ($id_producto) {
    $arrayNameUbicacion = array(
      'producto_id' => $id_producto['producto_id'],
      'bodega_id' => $_POST['producto_bodegas'],
      'producto_stock' => $_POST["producto_stock"],
      'ubicacion_descripcion' => strtoupper($_POST['ubicacion_descripcion'])
    );
    //echo json_encode($arrayNameUbicacion);
    echo json_encode(Producto::guardarUbicacion($arrayNameUbicacion));
  } else {
    echo 2;
  }
}
