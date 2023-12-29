<?php
include dirname(dirname(__FILE__)) . "../../models/proveedor.php";

$arrayName = array(
  'proveedor_razonsocial' => $_POST["razonsocialproveedornuevo"],
  'proveedor_ruc' => $_POST["rucproveedornuevo"],
  'proveedor_telefono' => $_POST["telefonoproveedor_nuevo"],
  'proveedor_direccion' => $_POST["direccionproveedornuevo"],
  'proveedor_email' => strtolower($_POST["correoelectroniconuevoproveedor"]),
  'proveedor_contacto' => $_POST["contactoreferenciaproveedor_nuevo"]
);
echo json_encode(Proveedor::guardarProveedores($arrayName));