<?php
include dirname(dirname(__FILE__)) . "../../models/rol.php";
session_start();
$data = Rol::obtenerRoles();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);

