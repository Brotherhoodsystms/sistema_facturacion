<?php
include dirname(dirname(__FILE__)) . "../../models/cliente.php";
$arrayName = array(
  'cliente_razonsocial' => $_POST["cliente_razonsocial"],
  'cliente_ruc' => $_POST["cliente_ruc"],
  'cliente_telefono' => $_POST["cliente_telefono"],
  'cliente_direccion' => $_POST["cliente_direccion"],
  'cliente_email' => strtolower($_POST["cliente_email"]),
  'cliente_contacto' => $_POST["cliente_contacto"],
  'tipo_documentoC' => $_POST["id_tipodocumentov"]
);
if (Cliente::validarRucCliente($_POST["cliente_ruc"])){
  echo 1;
} else{
  echo json_encode(Cliente::guardarClientes($arrayName));
}
