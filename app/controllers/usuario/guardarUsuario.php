<?php
// include_once "../../models/usuario.php";
include dirname(dirname(__FILE__)) . "../../models/usuario.php";
// include dirname(dirname(__FILE__)) . "../../utils/encriptacion.php";
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
);
if (Usuario::validarDniUsuario($_POST["usuario_dni"])) {
  echo 1;
} else if (Usuario::validarEmailUsuario(strtolower($_POST["usuario_email"]))) {
  echo 2;
} else {
  echo json_encode(Usuario::guardarUsuarios($arrayName));
}
