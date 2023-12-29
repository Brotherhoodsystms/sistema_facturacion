<?php
include dirname(dirname(__FILE__)) . "../../models/vendedor.php";
$arrayName = array(
  'vendedor_dni' => $_POST["vendedor_dni"],
  'vendedor_nombres' => $_POST["vendedor_nombres"],
  'vendedor_telefono' => $_POST["vendedor_telefono"],
  'vendedor_direccion' => $_POST["vendedor_direccion"]
);
if (Vendedor::validarDniVendedor($_POST["vendedor_dni"])) {
  echo 0;
} else {
  echo json_encode(Vendedor::guardarVendedores($arrayName));
}  