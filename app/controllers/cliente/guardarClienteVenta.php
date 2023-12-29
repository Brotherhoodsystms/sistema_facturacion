<?php
include dirname(dirname(__FILE__)) . "../../models/cliente.php";
$arrayName = array(
  'cliente_razonsocial' => $_POST["razonsocialclientenuevo"],
  'cliente_ruc' => $_POST["rucclientenuevo"],
  'cliente_telefono' => $_POST["telefonocliente_nuevo"],
  'cliente_direccion' => $_POST["direccionclientenuevo"],
  'cliente_email' => strtolower($_POST["correoelectroniconuevo"]),
  'cliente_contacto' => $_POST["contactoreferencia_nuevo"],
  'tipo_documentoC' => $_POST["id_tipodocumentov"]
);
//if (Cliente::validarRucCliente($_POST["cliente_ruc"])) {
//  echo 1;
//} else if (Cliente::validarEmailCliente(strtolower($_POST["cliente_email"]))) {
//  echo 2;
//} else {
//  echo json_encode(Cliente::guardarClientes($arrayName));
//}
if (Cliente::validarRucCliente($_POST["rucclientenuevo"])){
  echo 1;
} else{
  echo json_encode(Cliente::guardarClientesVenta($arrayName));
}