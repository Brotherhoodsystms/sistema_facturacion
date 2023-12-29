<?php
include dirname(dirname(__FILE__)) . "../../models/proveedor.php";
$arrayName = array(
  'proveedor_razonsocial' => $_POST["proveedor_razonsocial"],
  'proveedor_ruc' => $_POST["proveedor_ruc"],
  'proveedor_telefono' => $_POST["proveedor_telefono"],
  'proveedor_direccion' => $_POST["proveedor_direccion"],
  'proveedor_email' => strtolower($_POST["proveedor_email"]),
  'proveedor_contacto' => $_POST["proveedor_contacto"],
  'proveedor_id' => $_POST["proveedor_id"]
);
if (Proveedor::validarRucActualizarProveedor($_POST["proveedor_ruc"], $_POST['proveedor_id'])['COUNT(*)'] >= 2) {
  echo 1;
} else if (Proveedor::validarEmailActualizarProveedor(strtolower($_POST["proveedor_email"]), $_POST['proveedor_id'])['COUNT(*)'] >= 2) {
  echo 2;
} else {
  echo json_encode(Proveedor::actualizarProveedores($arrayName));
}
