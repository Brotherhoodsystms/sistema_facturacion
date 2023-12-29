<?php
include dirname(dirname(__FILE__)) . "../../models/rol.php";

$arrayName = array(
  'nombre_rol' => strtoupper($_POST["nombre_rol"]),
  'estatus_rol' => 1
);
if(Rol::validarNombreRol(strtoupper($_POST["nombre_rol"]))){
echo 1;
}else{
  echo json_encode(Rol::guardarRol($arrayName));
}
