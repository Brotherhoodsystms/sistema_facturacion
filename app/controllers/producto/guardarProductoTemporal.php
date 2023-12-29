<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
session_start();

//Imagen guardar

$nombre_imagen = $_FILES['foto']['name'];
$temporal = $_FILES['foto']['tmp_name'];
$carpeta = "../../img";
$ruta = $carpeta.'/'.$nombre_imagen;
move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);
if(empty($nombre_imagen)){
    $imagen = $_POST['producto_imagenes'];
}else{
    $imagen = $ruta;
}

$id_usuario = $_SESSION['idUser'];

if (empty($_POST["codAutomatico"])) {
  $codigoAuto = '1';
}else{
  $codigoAuto = '0';
}

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
if (empty($_POST["codigoReferenciaProducto"])) {
  $codigoreferencia = 'Sin codigo';
} else {
  $codigoreferencia = $_POST["codigoReferenciaProducto"];
}

$arrayName = array(
  'producto_codigoserial' => strtoupper($_POST["producto_codigoserial"]),
  'producto_descripcion' => $_POST["producto_descripcion"],
  'producto_precioxMe' => $_POST["producto_precioxMe"],
  'producto_precioxMa' => ($_POST["producto_precioxMa"]),
  'producto_stock' => $_POST["producto_stock"],
  'producto_fechaelaboracion' => $fechainicial,
  'producto_fechaexpiracion' => $fechafinal,
  'categoria_id' => strtolower($_POST["categoria_id"]),
  'lote_id' => $_POST["lote_id"],
  'proveedor_id' => $_POST["proveedor_identificador"],
  'id_usuario' => $id_usuario,
  'bodega_id' => $_POST["bodega_identificador"],
  'descripcion_ubicacion' => $_POST["ubicacion_descripcion"],
  'total_factura' => $_POST["total_factura"],
  'id_tipo_impuesto' => $_POST["tipo_impuesto_id"],
  'id_porcentajeimpuesto' => $_POST["porcentaje_iva"],
  'codigoReferenciaProducto' => $codigoreferencia,
  'codigoAutomatico' => $codigoAuto,
  'producto_imagen'=> $imagen
);
echo json_encode(Producto::guardarProductosTemporales($arrayName));