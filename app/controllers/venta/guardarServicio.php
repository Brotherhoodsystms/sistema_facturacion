<?php

session_start();
include dirname(dirname(__FILE__)) . "../../models/venta.php";
//todo::modificar para guardado en detalle temporal de servicio
if (empty($_POST["producto_id"])) {

  $precio = $_POST["producto_precioxMa"];
  $descuento = $_POST["producto_descuento"] / 100;
  $total_descuento = ($_POST["producto_comprar"] * $precio) * $descuento;
  $arrayNameP = array(
    'temp_serialproducto' => strtoupper($_POST["producto_codigoserial"]),
    'temp_descripcion' => strtoupper(
      $_POST["producto_descripcion"]
    ),
    'temp_precioxMe' => $_POST["producto_precioxMa"],
    'temp_precioxMa' => $_POST["producto_precioxMa"],
    'producto_stock' => $_POST['producto_stock'],
    'temp_descuento' => $_POST["producto_descuento"],
    'temp_cantvender' => $_POST["producto_comprar"],
    'temp_total' => ((($_POST["producto_comprar"] * $precio)) - $total_descuento),
    'temp_idproducto' => $_POST["producto_id"],
    'producto_porcentaje' => $_POST["porcentaje_iva"],
    'producto_tipo_imp' => $_POST["tipo_impuesto_id"]

  );
  Venta::guardarProductoServ($arrayNameP);
  $id_producto = Venta::obtenerProductoBycodigo($_POST['producto_codigoserial']);
  if ($_POST["producto_comprar"] <= $_POST["producto_stock"]) {

    $arrayName = array(
      'temp_serialproducto' => strtoupper($_POST["producto_codigoserial"]),
      'temp_descripcion' => $_POST["producto_descripcion"],
      'temp_precio' => $precio,
      'temp_descuento' => $_POST["producto_descuento"],
      'temp_cantvender' => $_POST["producto_comprar"],
      'temp_total' => ((($_POST["producto_comprar"] * $precio)) - $total_descuento),
      'temp_idproducto' => $id_producto["producto_id"],
      'temp_idusuario' => $_SESSION['idUser']
    );
    if (Venta::guardarDetalleTempServicio($arrayName)) {
      echo 1;
    }
  } else {
    echo 2;
  }
} else {

  $precio = $_POST["producto_precioxMa"];
  $descuento = $_POST["producto_descuento"] / 100;
  $total_descuento = ($_POST["producto_comprar"] * $precio) * $descuento;

  $id_producto = Venta::obtenerProductoBycodigo(strtoupper($_POST["producto_codigoserial"]));
  $arrayName = array(
    'temp_serialproducto' => strtoupper($_POST["producto_codigoserial"]),
    'temp_descripcion' => $_POST["producto_descripcion"],
    'temp_precio' => $precio,
    'temp_descuento' => $_POST["producto_descuento"],
    'temp_cantvender' => $_POST["producto_comprar"],
    'temp_total' => ((($_POST["producto_comprar"] * $precio)) - $total_descuento),
    'temp_idproducto' => $id_producto["producto_id"],
    'temp_idusuario' => $_SESSION['idUser']
  );
  if ($_POST["producto_comprar"] <= $_POST["producto_stock"]) {
    $datos_temporales = Venta::validarTemporalServicio($_POST['producto_codigoserial']);
    //echo json_encode($datos_temporales);
    if ($datos_temporales !== false) {
      $arrayName['temp_total'] = $arrayName['temp_total'] + $datos_temporales['temp_total'];
      $arrayName['temp_id'] = $datos_temporales['temp_id'];
      $arrayName['temp_cantvender'] = $arrayName['temp_cantvender'] + $datos_temporales['temp_cantvender'];
      if (Venta::actualizarDetalleTempServicio($arrayName)) {
        echo 1;
      }
    } else {
      if (Venta::guardarDetalleTempServicio($arrayName)) {
        echo 1;
      }
    }
    exit;
  } else {
    echo 2;
  }
}
