<?php
include dirname(dirname(__FILE__)) . "../../models/rol.php";
$arrayName = array(
  'nombre_rol' => strtoupper($_POST["nombre_rol"]),
  'id_rol' => $_POST["rol_id"]
);
if ($data = Rol::validarNombreRol(strtoupper($_POST["nombre_rol"]))) {
  echo 1;
} else {
  echo json_encode(Rol::actualizarRol($arrayName));
}
