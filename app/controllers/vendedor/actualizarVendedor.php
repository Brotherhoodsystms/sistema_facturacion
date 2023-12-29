<?php
include dirname(dirname(__FILE__)) . "../../models/vendedor.php";
$arrayName = array(
  'vendedor_dni' => $_POST["vendedor_dni"],
  'vendedor_nombres' => $_POST["vendedor_nombres"],
  'vendedor_telefono' => $_POST["vendedor_telefono"],
  'vendedor_direccion' => $_POST["vendedor_direccion"],
  'vendedor_id' => $_POST["vendedor_id"]
);
if (Vendedor::validarDniActualizarVendedor($_POST["vendedor_dni"], $_POST['vendedor_id'])['COUNT(*)'] >= 2) {
  echo 0;
}else {
  echo json_encode(Vendedor::actualizarVendedores($arrayName));
}
