<?php
include dirname(dirname(__FILE__)) . "../../models/servicios.php";
session_start();
$id_usuario = $_SESSION['idUser'];
$arrayName = array(
  'producto_codigoserial' => strtoupper($_POST["producto_codigoserial"]),
  'producto_descripcion' => strtoupper(
    $_POST["producto_descripcion"]
  ),
  'producto_precioxMa' => $_POST["producto_precioxMa"],
  'producto_stock' => $_POST["producto_stock"],
  'id_usuario' => $id_usuario,
  'id_tipo_impuesto' => $_POST["tipo_impuesto_id"],
  'id_porcentajeimpuesto' => $_POST["porcentaje_iva"]
);
echo json_encode(Servicios::guardarServicio($arrayName));
