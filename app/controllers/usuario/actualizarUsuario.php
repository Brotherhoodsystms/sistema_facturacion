<?php
include dirname(dirname(__FILE__)) . "../../models/usuario.php";
 if ($_POST["password"] === ""){
    $usuario_password = Usuario::obtenerContraseniaUsuario($_POST["usuario_identificador"]);
    $contrasenia =  $usuario_password['usuario_password'];
 }else{
    $contrasenia = $_POST["password"];
 }

$arrayName = array(
  'usuario_dni' => $_POST["usuario_dni"],
  'usuario_nombres' => $_POST["usuario_nombres"],
  'usuario_telefono' => $_POST["usuario_telefono"],
  'usuario_direccion' => $_POST["usuario_direccion"],
  'usuario_email' => strtolower($_POST["usuario_email"]),
  'usuario_password' => $_POST["usuario_password"],
  'acceso_id' => $_POST["acceso_id"],
  'sucursal_id' => $_POST["sucursal_id"],
  'bodega_id' => $_POST["bodega_id"],
  'usuario_id' => $_POST["usuario_identificador"]
);

if (Usuario::validarRucActualizarUsuario($_POST["usuario_dni"])['COUNT(*)'] >= 2) {
  echo 1;
} else if (Usuario::validarEmailActualizarUsuario(strtolower($_POST["usuario_email"]))['COUNT(*)'] >= 2) {
  echo 2;
} else {
  echo json_encode(Usuario::actualizarUsuario($arrayName));
}